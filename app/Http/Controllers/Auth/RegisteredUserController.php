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
use Illuminate\Validation\Rules;
use Twilio\Rest\Client;


class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $color = Dato::where('nombre', 'color')->first()->valor;
        return view('auth.register', ['color' => $color]);
    }

    /**
     * Handle an incoming registration request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        // $request->validate([
        //     'name' => ['required', 'string', 'max:255'],
        //     'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
        //     'password' => ['required', 'confirmed', Rules\Password::defaults()],
        // ]);

        $request->validate([
            // El campo name debe ser obligatorio, de tipo string y tener como máximo 255 caracteres
            'name' => 'required|string|max:255',
            'country_code' => 'required|string',
            // El campo phone debe ser obligatorio, de tipo string, tener como máximo 15 caracteres y ser único en la tabla users
            // Asegurarse de que el número de teléfono completo no exista en la columna email de la tabla users
            'phone' => [
                'required',
                'string',
                'max:15',
            ],

            // Otras reglas de validación aquí...
            // El campo email debe ser opcional, de tipo string, tener como máximo 255 caracteres y ser único en la tabla users

            // El campo password debe ser obligatorio, de tipo string y tener como mínimo 8 caracteres. Además, debe coincidir con el campo password_confirm
            'password' => 'required|string|min:8|confirmed',
        ], [
            // Aquí se definen los mensajes personalizados para cada regla de validación y cada campo
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
        // Después, se crea el usuario usando el método create del modelo User
        if (User::where('email', $full_number)->exists()) {
            return back()->withErrors([
                'phone' => 'El teléfono ya está registrado',
            ]);
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $full_number,
            // Se usa el método make de la clase Hash para encriptar el password antes de guardarlo en la base de datos
            'password' => Hash::make($request->password),
            'last_code_sent_at' => now(),
            'code_attempts' => 1,
        ]);

        event(new Registered($user));



        $phoneNumber = $full_number;
        $channel = "sms";

        $sid = getenv("TWILIO_SID");
        $token = getenv("TWILIO_AUTH_TOKEN");
        $twilio = new Client($sid, $token);

        $verification = $twilio->verify->v2->services(getenv("TWILIO_VERIFICATION_SID"))
            ->verifications
            ->create($phoneNumber, $channel);




        // TODO: Respond with a success message or handle any errors
        return view('auth.verificar', ['phone' => $phoneNumber, 'enviado' => true])->with('status', 'Código de verificación enviado correctamente!');
    }
}
