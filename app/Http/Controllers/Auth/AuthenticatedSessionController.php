<?php

namespace App\Http\Controllers\Auth;

use App\Http\Livewire\DetallesComponent;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Models\Carrito;
use App\Models\Dato;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class AuthenticatedSessionController extends Controller
{


    /**
     * Display the login view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $color = Dato::where('nombre', 'color')->first()->valor;
        return view('auth.login', ['color' => $color]);
    }

    /**
     * Handle an incoming authentication request.
     *
     * @param  \App\Http\Requests\Auth\LoginRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $request->validate([
            // El campo name debe ser obligatorio, de tipo string y tener como máximo 255 caracteres

            'country_code' => 'required|string',
            // El campo phone debe ser obligatorio, de tipo string, tener como máximo 15 caracteres y ser único en la tabla users
            // Asegurarse de que el número de teléfono completo no exista en la columna email de la tabla users
            'phone' => [
                'required',
                'string',
                'max:15',
            ],

            // El campo password debe ser obligatorio, de tipo string y tener como mínimo 8 caracteres. Además, debe coincidir con el campo password_confirm
            'password' => 'required|string|min:8',
        ], [
            // Aquí se definen los mensajes personalizados para cada regla de validación y cada campo

            'country_code.required' => 'El código de país es obligatorio.',
            'country_code.string' => 'El código de país debe ser una cadena de texto.',
            'phone.required' => 'El teléfono es obligatorio',
            'phone.string' => 'El teléfono debe ser una cadena de texto',
            'phone.max' => 'El teléfono no debe superar los 15 caracteres',



            'password.required' => 'La contraseña es obligatoria',
            'password.string' => 'La contraseña debe ser una cadena de texto',
            'password.min' => 'La contraseña debe tener al menos 8 caracteres',

        ]);
        $full_number = $request->country_code . $request->phone;
        if (!User::where('email', $full_number)->exists()) {
            return back()->withErrors([
                'phone' => 'El teléfono no existe',
            ]);
        }
        $login = new LoginRequest(['email' => $full_number, 'password' => $request->password]);
        $login->authenticate();

        // $login->session()->regenerate();

        if ($_COOKIE['product'] ?? false) {
            $carrito_exist = Carrito::where('id_user', Auth::user()->id)->where('id_producto', $_COOKIE['product'])->first();

            if ($carrito_exist) {



                $actcarrito = Carrito::find($carrito_exist->id);
                $actcarrito->cantidad = 1 + $carrito_exist->cantidad;
                $actcarrito->save();
            } else {
                Carrito::create([
                    'id_user' => Auth::user()->id,
                    'id_producto' => $_COOKIE['product'],
                    'cantidad' => 1
                ]);
                setcookie('product', '', time() - 3600);
                return redirect(route('carrito'));
            }
        } else {
            return redirect()->intended(RouteServiceProvider::HOME);
        }
    }

    /**
     * Destroy an authenticated session.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }

    public function verificar_sms()
    {

        $URL = "https://verification.api.sinch.com/verification/v1/verifications";
        $METHOD = "POST";

        /*
    The key from one of your Verification Apps, found here https://dashboard.sinch.com/verification/apps
*/
        $applicationKey  = "1b44b4a9-c925-46b9-b3bb-f3b6ac148e7d";

        /*
    The secret from the Verification App that uses the key above, found here https://dashboard.sinch.com/verification/apps
*/
        $applicationSecret = "gDB1eZmyY24QmZ7MfnO_4wrDdI";

        /*
    The number that will receive the SMS PIN. Test accounts are limited to verified numbers.
    The number must be in E.164 Format, e.g. Netherlands 0639111222 -> +31639111222
*/
        $toNumber = "+14122095813";

        $smsVerificationPayload = [
            "identity" => [
                "type" => "number",
                "endpoint" => $toNumber
            ],
            "method" => "sms"
        ];

        $curl = curl_init();

        curl_setopt_array($curl, [
            CURLOPT_HTTPHEADER => [
                "Content-Type: application/json",
                "Authorization: Basic " . base64_encode($applicationKey . ":" . $applicationSecret)
            ],
            CURLOPT_POSTFIELDS => json_encode($smsVerificationPayload),
            CURLOPT_URL => $URL,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_CUSTOMREQUEST => $METHOD,
        ]);

        $response = curl_exec($curl);
        $error = curl_error($curl);
        $statusCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);

        curl_close($curl);

        if ($error) {
            echo "cURL Error #:" . $error . "\n";
        } else {
            echo $response . "\n";
            echo $statusCode . "\n";
        }
        return redirect(route("home"));
    }
}
