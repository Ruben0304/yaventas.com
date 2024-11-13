<div style="background: linear-gradient(135deg, #f6f8fc 0%, #e9edf5 100%); padding: 3rem 1rem; min-height: 100vh; display: flex; justify-content: center; align-items: center;">
    <div style="background: white; max-width: 32rem; width: 100%; border-radius: 1rem; box-shadow: 0 10px 25px rgba(0, 0, 0, 0.05); padding: 2.5rem;">
        <h2 style="text-align: center; font-size: 1.75rem; font-weight: 700; margin-bottom: 0.5rem; color: #1a1f36;">Crear Cuenta</h2>
        <p style="text-align: center; color: #6b7280; margin-bottom: 2rem; font-size: 0.95rem;">Únete a nuestra comunidad</p>

        <form wire:submit.prevent="register">
            <!-- Nombre -->
            <div style="margin-bottom: 1.5rem;">
                <label style="display: block; color: #374151; font-weight: 600; margin-bottom: 0.5rem; font-size: 0.9rem;">Nombre</label>
                <input type="text"
                       wire:model.debounce.500ms="name"
                       style="width: 100%; border: 1px solid #e5e7eb; border-radius: 0.5rem; padding: 0.75rem; font-size: 0.95rem; outline: none; transition: all 0.2s ease;"
                       placeholder="Ingresa tu nombre completo">
                @error('name')
                <span style="color: #ef4444; font-size: 0.8rem; margin-top: 0.5rem; display: block;">{{ $message }}</span>
                @enderror
            </div>

            <!-- Teléfono con código de país -->
            <div style="margin-bottom: 1.5rem;">
                <label style="display: block; color: #374151; font-weight: 600; margin-bottom: 0.5rem; font-size: 0.9rem;">Número de Teléfono</label>
                <div style="display: flex; gap: 0.5rem;">
                    <div style="width: 40%;">
                        <select wire:model="country_code"
                                style="width: 100%; appearance: none; background-color: #f9fafb; border: 1px solid #e5e7eb; border-radius: 0.5rem; padding: 0.75rem; font-size: 0.95rem; cursor: pointer; outline: none; background-position: right 0.5rem center; background-repeat: no-repeat; padding-right: 2.5rem;">
                            <option value="+53" selected>🇨🇺 Cuba (+53)</option>
                            <option value="+1">🇺🇸 Estados Unidos (+1)</option>
                            <option value="+52">🇲🇽 México (+52)</option>
                            <option value="+54">🇦🇷 Argentina (+54)</option>
                            <option value="+55">🇧🇷 Brasil (+55)</option>
                            <option value="+56">🇨🇱 Chile (+56)</option>
                            <option value="+57">🇨🇴 Colombia (+57)</option>
                            <option value="+34">🇪🇸 España (+34)</option>
                        </select>
                    </div>
                    <input type="text"
                           wire:model.debounce.500ms="phone"
                           style="width: 60%; border: 1px solid #e5e7eb; border-radius: 0.5rem; padding: 0.75rem; font-size: 0.95rem; outline: none;"
                           placeholder="Número de móvil">
                </div>
                @error('phone')
                <span style="color: #ef4444; font-size: 0.8rem; margin-top: 0.5rem; display: block;">{{ $message }}</span>
                @enderror
            </div>

            <!-- Contraseña -->
            <div style="margin-bottom: 1.5rem;">
                <label style="display: block; color: #374151; font-weight: 600; margin-bottom: 0.5rem; font-size: 0.9rem;">Contraseña</label>
                <input type="password"
                       wire:model.debounce.500ms="password"
                       style="width: 100%; border: 1px solid #e5e7eb; border-radius: 0.5rem; padding: 0.75rem; font-size: 0.95rem; outline: none;"
                       placeholder="Crea tu contraseña">
                @error('password')
                <span style="color: #ef4444; font-size: 0.8rem; margin-top: 0.5rem; display: block;">{{ $message }}</span>
                @enderror
            </div>

            <!-- Confirmar Contraseña -->
            <div style="margin-bottom: 1.5rem;">
                <label style="display: block; color: #374151; font-weight: 600; margin-bottom: 0.5rem; font-size: 0.9rem;">Confirmar Contraseña</label>
                <input type="password"
                       wire:model.debounce.500ms="password_confirmation"
                       style="width: 100%; border: 1px solid #e5e7eb; border-radius: 0.5rem; padding: 0.75rem; font-size: 0.95rem; outline: none;"
                       placeholder="Repite tu contraseña">
            </div>

            <!-- WhatsApp Checkbox -->
            <div style="margin-bottom: 1.5rem; background-color: #f3f4f6; padding: 1rem; border-radius: 0.5rem;">
                <label style="display: flex; align-items: start; gap: 0.75rem; cursor: pointer;">
                    <input type="checkbox"
                           wire:model="join_whatsapp"
                           style="width: 1.25rem; height: 1.25rem; margin-top: 0.2rem; border: 2px solid #d1d5db; border-radius: 0.25rem; cursor: pointer;">
                    <span style="color: #374151; font-size: 0.9rem;">
                        Acepta unirte a nuestro grupo de WhatsApp y disfruta de un 10% de descuento permanente. 💰😎
                    </span>
                </label>
            </div>

            <!-- Botón de Registro -->
            <button type="submit"
                    style="width: 100%; background-color: #f97316; color: white; padding: 0.85rem; border: none; border-radius: 0.5rem; font-weight: 600; font-size: 0.95rem; cursor: pointer; transition: all 0.2s ease; box-shadow: 0 2px 4px rgba(249, 115, 22, 0.2); margin-bottom: 1.5rem;">
                <span wire:loading.remove wire:target="register">
                    Crear Cuenta
                </span>
                <span wire:loading wire:target="register">
                    Procesando...
                </span>
            </button>

            <!-- Login Link -->
            <div style="text-align: center; color: #374151; margin-bottom: 1.5rem; font-size: 0.9rem;">
                ¿Ya tienes una cuenta?
                <a href="{{ route('login') }}"
                   style="color: #f97316; text-decoration: none; font-weight: 500;">
                    Iniciar Sesión
                </a>
            </div>

            <!-- Terms -->
            <div style="text-align: center; color: #6b7280; font-size: 0.8rem; line-height: 1.5;">
                Al registrarte aceptas nuestros
                <a href="#" style="color: #f97316; text-decoration: none;">Términos y Condiciones</a>
                y nuestra
                <a href="#" style="color: #f97316; text-decoration: none;">Política de Privacidad</a>
            </div>
        </form>

        @if (session()->has('error'))
            <div style="position: fixed; bottom: 1rem; right: 1rem; background-color: #ef4444; color: white; padding: 1rem 1.5rem; border-radius: 0.5rem; box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);">
                {{ session('error') }}
            </div>
        @endif
    </div>
</div>
