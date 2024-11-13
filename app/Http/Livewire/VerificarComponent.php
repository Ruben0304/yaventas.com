<?php

namespace App\Http\Livewire;

use App\Models\User;
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

    public function mount($phone)
    {
        $this->phone = $phone;
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

            if (!$user) {
                $this->addError('code', 'Usuario no encontrado.');
                return;
            }

            // Generar nuevo código de 6 dígitos
            $newCode = str_pad(random_int(0, 999999), 6, '0', STR_PAD_LEFT);

            $user->update([
                'verification_code' => $newCode,
                'last_code_sent_at' => now()
            ]);

            // Aquí deberías implementar el envío del SMS con el nuevo código
            // Por ejemplo, usando tu servicio de SMS actual

            $this->messageType = 'success';
            $this->message = 'Nuevo código enviado exitosamente!';
            $this->startTimer();

        } catch (\Exception $e) {
            Log::error("Error al reenviar código: " . $e->getMessage());
            $this->messageType = 'error';
            $this->message = 'Error al enviar el código. Por favor intente nuevamente.';
        }
    }

    private function startTimer()
    {
        $this->canResend = false;
        $this->timer = 60;
        $this->dispatchBrowserEvent('start-timer');
    }
}
