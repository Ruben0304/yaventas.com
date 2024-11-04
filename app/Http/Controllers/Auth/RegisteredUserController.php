<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Dato;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\TwilioController;
use Twilio\Rest\Client;


class RegisteredUserController extends Controller
{
    public function create()
    {
        $color = Dato::where('nombre', 'color')->first()->valor;
        return view('auth.register', ['color' => $color]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'country_code' => 'required|string',
            'phone' => [
                'required',
                'string',
                'max:15',
            ],
            'password' => 'required|string|min:8|confirmed',
        ], [
            'name.required' => 'El nombre es obligatorio',
            'name.string' => 'El nombre debe ser una cadena de texto',
            'name.max' => 'El nombre no debe superar los 255 caracteres',
            'country_code.required' => 'El código de país es obligatorio.',
            'country_code.string' => 'El código de país debe ser una cadena de texto.',
            'phone.required' => 'El teléfono es obligatorio',
            'phone.string' => 'El teléfono debe ser una cadena de texto',
            'phone.max' => 'El teléfono no debe superar los 15 caracteres',
            'phone.unique' => 'El teléfono ya está registrado',
            'password.required' => 'La contraseña es obligatoria',
            'password.string' => 'La contraseña debe ser una cadena de texto',
            'password.min' => 'La contraseña debe tener al menos 8 caracteres',
            'password.confirmed' => 'La contraseña y la confirmación no coinciden',
        ]);

        $full_number = $request->country_code . $request->phone;

        if (User::where('email', $full_number)->exists()) {
            return back()->withErrors([
                'phone' => 'El teléfono ya está registrado',
            ]);
        }

        try {
            // Generar código de verificación
            $verificationCode = rand(100000, 999999);

            $user = User::create([
                'name' => $request->name,
                'email' => $full_number,
                'password' => Hash::make($request->password),
                'verification_code' => $verificationCode,
                'last_code_sent_at' => now(),
                'code_attempts' => 1,
            ]);

            event(new Registered($user));

            // Iniciar sesión con el usuario
            Auth::login($user);

            // Enviar SMS con el código de verificación
            try {
                // Configuración de Twilio
                $sid = env("TWILIO_SID");
                $token = env("TWILIO_AUTH_TOKEN");
                $fromNumber = env("TWILIO_PHONE_NUMBER");

                // Crear instancia del cliente de Twilio
                $twilio = new Client($sid, $token);

                // Enviar el mensaje SMS
                $message = "Su código para Yaventas es: $verificationCode";
                $twilio->messages->create($full_number, [
                    'from' => $fromNumber,
                    'body' => $message,
                ]);

                return view('auth.verificar', [
                    'phone' => $full_number,
                    'enviado' => true
                ])->with('status', 'Código de verificación enviado correctamente!');

            } catch (\Exception $e) {
                Log::error("Error al enviar SMS de verificación: " . $e->getMessage());
                return view('auth.verificar', [
                    'phone' => $full_number,
                    'enviado' => false
                ])->with('error', 'Hubo un error al enviar el código de verificación.');
            }

        } catch (\Exception $e) {
            Log::error("Error en el registro de usuario: " . $e->getMessage());
            return back()->withErrors([
                'general' => 'Hubo un error durante el registro. Por favor, intente nuevamente.'
            ]);
        }
    }
}
