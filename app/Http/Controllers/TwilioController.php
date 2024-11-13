<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Twilio\Rest\Client;
use Illuminate\Support\Facades\Log;

class TwilioController extends Controller
{
    /**
     * Enviar código de verificación por SMS.
     *
     * @return \Illuminate\View\View
     */
    public  function verificar()
    {
        $user = Auth::user();
        $phoneNumber = $user->email;

        // Validación de tiempo y límites de intentos
        $error = $this->checkSendRestrictions($user);
        if ($error) {
            return view('auth.verificar', ['phone' => $phoneNumber, 'enviado' => true])->with('error', $error);
        }

        // Generar un código de verificación aleatorio
        $verificationCode = rand(100000, 999999);

        try {
            $this->sendSmsVerificationCode($phoneNumber, $verificationCode);

            // Actualizar el último intento de envío y el número de intentos
            $user->update([
                'last_code_sent_at' => now(),
                'code_attempts' => $user->code_attempts + 1,
                'verification_code' => $verificationCode, // Guardar el código generado
            ]);
        } catch (\Exception $e) {
            Log::error("Error al enviar el código de verificación: " . $e->getMessage());
            return view('auth.verificar', ['phone' => $phoneNumber, 'enviado' => true])->with('error', 'Hubo un error al enviar el código.');
        }

        return view('auth.verificar', ['phone' => $phoneNumber, 'enviado' => true]);
    }

    /**
     * Enviar el código de verificación por SMS utilizando Twilio.
     *
     * @param  string  $phoneNumber
     * @param  int  $code
     * @return void
     */
    private  function sendSmsVerificationCode($phoneNumber, $code)
    {
        // Configuración de Twilio
        $sid = env("TWILIO_SID");
        $token = env("TWILIO_AUTH_TOKEN");
        $fromNumber = env("TWILIO_PHONE_NUMBER");

        // Crear una nueva instancia del cliente de Twilio
        $twilio = new Client($sid, $token);

        // Enviar el mensaje SMS con el código de verificación
        $message = "Su código para Yaventas es: $code";
        $twilio->messages->create($phoneNumber, [
            'from' => $fromNumber,
            'body' => $message,
        ]);
    }

    /**
     * Validar restricciones de tiempo y de intentos de envío de código.
     *
     * @param  User  $user
     * @return string|null
     */
    private  function  checkSendRestrictions($user)
    {
        if ($user && $user->last_code_sent_at && now()->diffInSeconds($user->last_code_sent_at) < 60) {
            return 'Debes esperar un minuto entre cada intento de envío de código.';
        }
        if ($user && $user->code_attempts >= 5 && now()->diffInHours($user->last_code_sent_at) < 24) {
            return 'Has excedido el límite de intentos de envío de código por hoy.';
        }
        return null;
    }


    public function check(Request $request)
    {
        // Validar la solicitud
        $request->validate([
            'phone_number' => 'required|string',
            'code' => 'required|string|size:6',
        ], [
            'code.required' => 'El código es obligatorio',
            'code.size' => 'El código debe tener 6 dígitos',
        ]);

        try {
            // Buscar el usuario por su número de teléfono (guardado en email)
            $user = User::where('email', $request->phone_number)->first();

            if (!$user) {
                return back()->withErrors([
                    'code' => 'Usuario no encontrado.'
                ]);
            }

            // Verificar si el código ha expirado (30 minutos)
            if ($user->last_code_sent_at && now()->diffInMinutes($user->last_code_sent_at) > 30) {
                return back()->withErrors([
                    'code' => 'El código ha expirado. Por favor, solicita uno nuevo.'
                ]);
            }

            // Verificar si el código es correcto
            if ($user->verification_code !== $request->code) {
                // Incrementar contador de intentos fallidos
                $user->increment('code_attempts');

                // Si hay demasiados intentos fallidos, bloquear temporalmente
                if ($user->code_attempts >= 5) {
                    return back()->withErrors([
                        'code' => 'Has excedido el número máximo de intentos. Por favor, espera 24 horas o contacta a soporte.'
                    ]);
                }

                return back()->withErrors([
                    'code' => 'El código ingresado no es correcto. Por favor, intenta nuevamente.'
                ]);
            }

            // Si el código es correcto, marcar al usuario como verificado
            $user->update([
                'verificado' => true, // Usar el campo verificado en lugar de phone_verified_at
                'verification_code' => null, // Limpiar el código usado
                'code_attempts' => 0 // Resetear los intentos
            ]);

            // Redirigir al usuario a la página principal o dashboard
            return redirect()->route('dashboard')
                ->with('status', '¡Número de teléfono verificado correctamente!');

        } catch (\Exception $e) {
            Log::error("Error en la verificación del código: " . $e->getMessage());
            return back()->withErrors([
                'code' => 'Hubo un error al verificar el código. Por favor, intenta nuevamente.'
            ]);
        }
    }
}
