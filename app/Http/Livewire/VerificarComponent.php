<?php

namespace App\Http\Livewire;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Livewire\Component;



class VerificarComponent extends Component
{
    public $phone;
    public $code;
    public $timer = 60;
    public $canResend = false;
    public $message = '';
    public $messageType = '';
    public $attempts = 0;

    protected $rules = [
        'code' => 'required|string|size:6',
    ];

    protected $messages = [
        'code.required' => 'El código es obligatorio',
        'code.size' => 'El código debe tener 6 dígitos',
    ];

    public function mount()
    {
        $this->phone = Auth::user()->email;
        $this->startTimer();
    }

    public function render()
    {
        return view('livewire.verificar-component');
    }

    public function verifyCode()
    {
        $this->validate();

        try {
            $user = User::where('email', $this->phone)->first();

            if (!$user) {
                $this->addError('code', 'Usuario no encontrado.');
                return;
            }

            // Verificar si el código ha expirado (30 minutos)
            if ($user->last_code_sent_at && now()->diffInMinutes($user->last_code_sent_at) > 30) {
                $this->addError('code', 'El código ha expirado. Por favor, solicita uno nuevo.');
                $this->startTimer();
                return;
            }

            // Verificar si el código es correcto
            if ($user->verification_code !== $this->code) {
                // Incrementar contador de intentos fallidos
                $user->increment('code_attempts');
                $this->attempts = $user->code_attempts;

                // Si hay demasiados intentos fallidos, bloquear temporalmente
                if ($user->code_attempts >= 5) {
                    $this->addError('code', 'Has excedido el número máximo de intentos. Por favor, espera 24 horas o contacta a soporte.');
                    $this->startTimer();
                    return;
                }

                $this->addError('code', 'El código ingresado no es correcto. Por favor, intenta nuevamente.');
                return;
            }

            // Si el código es correcto, marcar al usuario como verificado
            $user->update([
                'verificado' => true,
                'verification_code' => null,
                'code_attempts' => 0
            ]);

            session()->flash('status', '¡Número de teléfono verificado correctamente!');
            return redirect()->route('dashboard');
        } catch (\Exception $e) {
            Log::error("Error en la verificación del código: " . $e->getMessage());
            $this->addError('code', 'Hubo un error al verificar el código. Por favor, intenta nuevamente.');
        }
    }

    public function resendCode()
    {
        try {
            $user = User::where('email', $this->phone)->first();
            $user->update([
                'verification_code' => rand(100000, 999999),
                'last_code_sent_at' => now(),
                'code_attempts' => 0
            ]);

            $this->message = 'Se ha enviado un nuevo código de verificación a tu número de teléfono.';
            $this->messageType = 'success';
            $this->canResend = false;
            $this->startTimer();
        } catch (\Exception $e) {
            Log::error("Error al reenviar el código de verificación: " . $e->getMessage());
            $this->message = 'Hubo un error al reenviar el código de verificación. Por favor, intenta nuevamente.';
            $this->messageType = 'error';
        }
    }

    public function updatedTimer()
    {
        if ($this->timer <= 0) {
            $this->canResend = true;
        }
    }

    private function startTimer()
    {
        $this->timer = 60;
        $this->canResend = false;
    }
}
