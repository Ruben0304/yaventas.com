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
use Illuminate\Support\Facades\Log;
use Twilio\Rest\Client;


class RegisteredUserController extends Controller
{
    public function create()
    {
        $color = Dato::where('nombre', 'color')->first()->valor;
        return view('auth.register', ['color' => $color]);
    }

    public static function store($full_number,$name,$password)
    {


        if (User::where('email', $full_number)->exists()) {
            return back()->withErrors([
                'phone' => 'El teléfono ya está registrado',
            ]);
        }

        try {
            // Generar código de verificación
            $verificationCode = rand(100000, 999999);

            $user = User::create([
                'name' => $name,
                'email' => $full_number,
                'password' => Hash::make($password),
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


            } catch (\Exception $e) {
                Log::error("Error al enviar SMS de verificación: " . $e->getMessage());
            }

        } catch (\Exception $e) {
            Log::error("Error en el registro de usuario: " . $e->getMessage());
            return back()->withErrors([
                'general' => 'Hubo un error durante el registro. Por favor, intente nuevamente.'
            ]);
        }
    }
}
