<?php

namespace App\Http\Livewire\Auth;

use App\Http\Controllers\Auth\RegisteredUserController;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Livewire\Component;
use Twilio\Rest\Client;

class Register extends Component
{
    public $name = '';
    public $phone = '';
    public $country_code = '+53';
    public $password = '';
    public $password_confirmation = '';
    public $join_whatsapp = false;

    protected $rules = [
        'name' => 'required|min:3|max:255',
        'phone' => 'required|numeric|digits_between:8,10',
        'country_code' => 'required|string',
        'password' => 'required|min:8|confirmed',
        'join_whatsapp' => 'boolean'
    ];

    protected $messages = [
        'name.required' => 'Por favor, ingresa tu nombre completo.',
        'name.min' => 'El nombre debe tener al menos 3 caracteres.',
        'phone.required' => 'El número de teléfono es obligatorio.',
        'phone.numeric' => 'El número de teléfono debe contener solo números.',
        'phone.digits_between' => 'El número de teléfono debe tener entre 8 y 10 dígitos.',
        'password.required' => 'La contraseña es obligatoria.',
        'password.min' => 'La contraseña debe tener al menos 8 caracteres.',
        'password.confirmed' => 'Las contraseñas no coinciden.'
    ];

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function register()
    {
        $this->validate();

        $full_number = $this->country_code . $this->phone;

        // Verificar si el teléfono ya está registrado
        if (User::where('email', $full_number)->exists()) {
            $this->addError('phone', 'El teléfono ya está registrado');
            return;
        }

        try {
            // Generar código de verificación
            $verificationCode = rand(100000, 999999);

            $user = User::create([
                'name' => $this->name,
                'email' => $full_number,
                'password' => Hash::make($this->password),
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


                return redirect()->route('verificar');


            } catch (\Exception $e) {
                Log::error("Error al enviar SMS de verificación: " . $e->getMessage());
                $this->addError('general', 'Hubo un error al enviar el código de verificación. Por favor, intente nuevamente.');
                return;
            }

        } catch (\Exception $e) {
            Log::error("Error en el registro de usuario: " . $e->getMessage());
            $this->addError('general', 'Hubo un error durante el registro. Por favor, intente nuevamente.');
            return;
        }
    }

    public function render()
    {
        return view('livewire.auth.register');
    }
}
