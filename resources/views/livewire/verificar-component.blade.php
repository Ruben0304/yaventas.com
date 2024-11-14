<div class="verification-container mx-auto my-8 max-w-lg bg-white p-8 rounded-lg shadow-lg">
    <h2 class="verification-title text-2xl font-bold text-gray-800 mb-4 text-center">
        Verificación de número telefónico
    </h2>

    <p class="verification-subtitle text-gray-600 text-center mb-6">
        Se ha enviado un código de verificación a tu número de teléfono
    </p>

    @if($message)
        <div class="message {{ $messageType }} bg-{{ $messageType }}-100 border-{{ $messageType }}-400 text-{{ $messageType }}-700 p-4 rounded-lg mb-4">
            {{ $message }}
        </div>
    @endif

    <form wire:submit.prevent="verifyCode" class="verification-form space-y-6">
        <div class="form-group">
            <label for="code" class="block text-gray-700 font-medium mb-2">Ingresa el código de 6 dígitos:</label>
            <input type="text" id="code" wire:model.defer="code" inputmode="numeric" autocomplete="one-time-code" pattern="\d{6}" maxlength="6" required
                   class="block w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:border-blue-500 text-center text-lg tracking-widest">
            @error('code')
            <span class="error-message text-red-500 text-sm mt-2">{{ $message }}</span>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary bg-blue-500 hover:bg-blue-600 text-white font-medium px-6 py-3 rounded-lg w-full">
            Verificar código
        </button>
    </form>

    @if($attempts > 0 && $attempts < 5)
        <p class="attempts text-red-500 text-sm mt-4">
            Intentos fallidos: {{ $attempts }}/5
        </p>
    @endif

    <button wire:click="resendCode" class="btn btn-secondary bg-gray-600 hover:bg-gray-700 text-white font-medium px-6 py-3 rounded-lg w-full mt-4"
        {{ !$canResend ? 'disabled' : '' }}>
        Reenviar código
    </button>

    @if(!$canResend)
        <p class="timer text-gray-600 text-sm mt-4">
            Por favor, espere {{ $timer }} segundos antes de solicitar un nuevo código
        </p>
    @endif
</div>
