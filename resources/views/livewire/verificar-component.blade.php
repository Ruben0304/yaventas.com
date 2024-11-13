<!-- resources/views/livewire/verification-component.blade.php -->
<div class="verification-container">
    <style>
        .verification-container {
            max-width: 500px;
            margin: 2rem auto;
            padding: 2rem;
            background: white;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .verification-title {
            color: #333;
            font-size: 1.5rem;
            margin-bottom: 1.5rem;
            text-align: center;
        }

        .verification-subtitle {
            color: #666;
            text-align: center;
            margin-bottom: 2rem;
        }

        .verification-form {
            display: flex;
            flex-direction: column;
            gap: 1.5rem;
        }

        .form-group {
            display: flex;
            flex-direction: column;
            gap: 0.5rem;
        }

        .form-group label {
            color: #555;
            font-size: 0.9rem;
            font-weight: 500;
        }

        .form-group input {
            padding: 0.8rem;
            border: 2px solid #e1e1e1;
            border-radius: 5px;
            font-size: 1.2rem;
            letter-spacing: 0.2em;
            text-align: center;
            transition: border-color 0.3s ease;
        }

        .form-group input:focus {
            outline: none;
            border-color: #4a90e2;
        }

        .error-message {
            color: #dc2626;
            font-size: 0.9rem;
            margin-top: 0.5rem;
        }

        .btn {
            padding: 0.8rem 1.5rem;
            border: none;
            border-radius: 5px;
            font-size: 1rem;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.3s ease;
            text-align: center;
        }

        .btn-primary {
            background-color: #4a90e2;
            color: white;
        }

        .btn-primary:hover {
            background-color: #357abd;
        }

        .btn-secondary {
            background-color: #6c757d;
            color: white;
        }

        .btn-secondary:hover {
            background-color: #5a6268;
        }

        .btn:disabled {
            opacity: 0.6;
            cursor: not-allowed;
        }

        .message {
            padding: 1rem;
            border-radius: 5px;
            margin-bottom: 1rem;
        }

        .message.error {
            background-color: #fee2e2;
            color: #dc2626;
            border: 1px solid #fecaca;
        }

        .message.success {
            background-color: #dcfce7;
            color: #16a34a;
            border: 1px solid #bbf7d0;
        }

        .timer {
            text-align: center;
            color: #666;
            font-size: 0.9rem;
            margin-top: 1rem;
        }

        .attempts {
            text-align: center;
            color: #dc2626;
            font-size: 0.9rem;
            margin-top: 1rem;
        }

        .breadcrumb {
            padding: 1rem 0;
            margin-bottom: 2rem;
            color: #666;
        }

        .breadcrumb a {
            color: #4a90e2;
            text-decoration: none;
        }

        .breadcrumb span::before {
            content: ">";
            margin: 0 0.5rem;
        }

        @media (max-width: 640px) {
            .verification-container {
                margin: 1rem;
                padding: 1.5rem;
            }
        }
    </style>

    <div class="breadcrumb">
        <a href="{{ route('home') }}" rel="nofollow">Inicio</a>
        <span></span> Verificar
    </div>

    <div class="verification-title">
        Verificación de número telefónico
    </div>

    <div class="verification-subtitle">
        Se ha enviado un código de verificación a tu número de teléfono
    </div>

    @if($message)
        <div class="message {{ $messageType }}">
            {{ $message }}
        </div>
    @endif

    <div class="verification-form">
        <form wire:submit.prevent="verifyCode">
            <div class="form-group">
                <label for="code">Ingresa el código de 6 dígitos:</label>
                <input type="text"
                       id="code"
                       wire:model.defer="code"
                       inputmode="numeric"
                       autocomplete="one-time-code"
                       pattern="\d{6}"
                       maxlength="6"
                       required>
                @error('code')
                <span class="error-message">{{ $message }}</span>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary">
                Verificar código
            </button>
        </form>

        @if($attempts > 0 && $attempts < 5)
            <div class="attempts">
                Intentos fallidos: {{ $attempts }}/5
            </div>
        @endif

        <button wire:click="resendCode"
                class="btn btn-secondary"
            {{ !$canResend ? 'disabled' : '' }}>
            Reenviar código
        </button>

        @if(!$canResend)
            <div class="timer" wire:poll.1000ms="$refresh">
                Por favor, espere {{ $timer }} segundos antes de solicitar un nuevo código
            </div>
        @endif
    </div>

    <script>
        window.addEventListener('start-timer', event => {
            let countdown = 60;
            const timer = setInterval(() => {
                countdown--;
                if (countdown <= 0) {
                    clearInterval(timer);
                    @this.set('canResend', true);
                    @this.set('timer', 0);
                } else {
                    @this.set('timer', countdown);
                }
            }, 1000);
        });
    </script>
</div>
