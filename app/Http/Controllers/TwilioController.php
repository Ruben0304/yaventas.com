<?php

namespace App\Http\Controllers;

use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Twilio\Rest\Client;

class TwilioController extends Controller
{
    /**
     * Send a verification code to the user.
     *
     * @param  Request  $request
     * @return Response
     */

    public function verificar(){
        $phoneNumber = Auth::user()->email;
        $channel = 'sms';
        $user = User::where('email', '=', $phoneNumber)->first();

        // Verifica si ha pasado 1 minuto desde el último intento de envío
        if ($user && $user->last_code_sent_at && now()->diffInSeconds($user->last_code_sent_at) < 60) {
            return view('auth.verificar', ['phone' => $phoneNumber, 'enviado' => true])->with('error', 'Debes esperar un minuto entre cada intento de envío de código.');
        }
    
        // Verifica si el usuario ha excedido el límite de intentos en las últimas 24 horas
        if ($user && $user->code_attempts >= 5 && now()->diffInHours($user->last_code_sent_at) < 24) {
            return view('auth.verificar', ['phone' => $phoneNumber, 'enviado' => true])->with('error', 'Has excedido el límite de intentos de envío de código por hoy.');
        }
    
        $sid = env("TWILIO_SID");
        $token = env("TWILIO_AUTH_TOKEN");
        $twilio = new Client($sid, $token);
    
        $verification = $twilio->verify->v2->services(env("TWILIO_VERIFICATION_SID"))
            ->verifications
            ->create($phoneNumber, $channel);
    
        // Incrementar el contador de intentos de código y actualizar el último momento de envío
        if ($user) {
            $user->update([
                'last_code_sent_at' => now(),
                'code_attempts' => $user->code_attempts + 1,
            ]);
        }
    
        // TODO: Respond with a success message or handle any errors
        
        return view('auth.verificar', ['phone' => $phoneNumber, 'enviado' => true]);
    }


    public function send(Request $request)
    {
        $request->validate([
            'phone_number' => 'required|string|max:15',
            'channel' => 'required|string|in:sms,whatsapp'
        ],[
            'phone_number.required' => 'El número de teléfono es obligatorio',
            'phone_number.string' => 'El número de teléfono debe ser una cadena de texto',
            'phone_number.max' => 'El número de teléfono no debe superar los 15 caracteres',
            'channel.required' => 'El canal es obligatorio',
            'channel.string' => 'El canal debe ser una cadena de texto',
            'channel.in' => 'El canal debe ser "sms" o "whatsapp"',
        ]);
    
        $phoneNumber = $request->phone_number;
        $channel = $request->channel;
        $user = User::where('email', '=', $phoneNumber)->first();

        // Verifica si ha pasado 1 minuto desde el último intento de envío
        if ($user && $user->last_code_sent_at && now()->diffInSeconds($user->last_code_sent_at) < 60) {
            return view('auth.verificar', ['phone' => $phoneNumber, 'enviado' => true])->with('error', 'Debes esperar un minuto entre cada intento de envío de código.');
        }
    
        // Verifica si el usuario ha excedido el límite de intentos en las últimas 24 horas
        if ($user && $user->code_attempts >= 5 && now()->diffInHours($user->last_code_sent_at) < 24) {
            return view('auth.verificar', ['phone' => $phoneNumber, 'enviado' => true])->with('error', 'Has excedido el límite de intentos de envío de código por hoy.');
        }
    
        $sid = env("TWILIO_SID");
        $token = env("TWILIO_AUTH_TOKEN");
        $twilio = new Client($sid, $token);
    
        $verification = $twilio->verify->v2->services(env("TWILIO_VERIFICATION_SID"))
            ->verifications
            ->create($phoneNumber, $channel);
    
        // Incrementar el contador de intentos de código y actualizar el último momento de envío
        if ($user) {
            $user->update([
                'last_code_sent_at' => now(),
                'code_attempts' => $user->code_attempts + 1,
            ]);
        }
    
        // TODO: Respond with a success message or handle any errors
        
        return view('auth.verificar', ['phone' => $phoneNumber, 'enviado' => true]);
    }

    /**
     * Check the verification code entered by the user.
     *
     * @param  Request  $request
     * @return Response
     */
    public function check(Request $request)
{
    $messages = [
        'phone_number.required' => 'El número de teléfono es requerido.',
        'phone_number.string' => 'El número de teléfono debe ser una cadena de texto.',
        'phone_number.max' => 'El número de teléfono no puede tener más de 15 caracteres.',
        'code.required' => 'El código es requerido.',
        'code.string' => 'El código debe ser una cadena de texto.',
        'code.max' => 'El código no puede tener más de 6 caracteres.',
    ];

    $validatedData = $request->validate([
        'phone_number' => 'required|string|max:15',
        'code' => 'required|string|max:6',
    ], $messages);

    $phoneNumber = $validatedData['phone_number'];
    $code = $validatedData['code'];

    $sid = env("TWILIO_SID");
    $token = env("TWILIO_TOKEN");
    $twilio = new Client($sid, $token);

    try {
        $verification_check = $twilio->verify->v2->services(env("TWILIO_VERIFICATION_SID"))
            ->verificationChecks
            ->create(["code"=> $code,"to" => $phoneNumber]);

        if ($verification_check->status === 'approved') {
            $usuario = User::where('email', '=', $phoneNumber)->first();
            $usuario->verificado = true;
            $usuario->save();
            Auth::login($usuario);
            return redirect(route('home'));
        } else {
            return view('auth.verificar', ['phone' => $phoneNumber, 'enviado' => true])
                ->with('error', 'El código es incorrecto.');
        }
    } catch (\Exception $e) {
        return view('auth.verificar', ['phone' => $phoneNumber, 'enviado' => true])
            ->with('error', 'El código es incorrecto.');
    }
}

    


}
