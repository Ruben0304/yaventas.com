<div>
    <div style=" padding: 3rem 1rem; min-height: 100vh; display: flex; justify-content: center; align-items: center;">
        <div style="background: white; max-width: 28rem; width: 100%; border-radius: 1rem; box-shadow: 0 10px 25px rgba(0, 0, 0, 0.05); padding: 2.5rem;">
            <h2 style="text-align: center; font-size: 1.75rem; font-weight: 700; margin-bottom: 0.5rem; color: #1a1f36;">Iniciar Sesión</h2>
            <p style="text-align: center; color: #6b7280; margin-bottom: 2rem; font-size: 0.95rem;">Bienvenido de nuevo</p>

            <!-- Botón de Google -->
            <div style="margin-bottom: 2rem;">
                <button type="button" onclick="window.location.href='{{ route('glogin') }}'"
                        style="width: 100%;
                               background-color: white;
                               border: 1px solid #e5e7eb;
                               color: #374151;
                               padding: 0.75rem;
                               border-radius: 0.5rem;
                               font-weight: 500;
                               cursor: pointer;
                               display: flex;
                               align-items: center;
                               justify-content: center;
                               gap: 0.75rem;
                               transition: all 0.2s ease;
                               box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);">
                    <svg style="width: 20px; height: 20px;" viewBox="0 0 24 24">
                        <path fill="#4285F4" d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z"/>
                        <path fill="#34A853" d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z"/>
                        <path fill="#FBBC05" d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l2.85-2.22.81-.62z"/>
                        <path fill="#EA4335" d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z"/>
                    </svg>
                    Continuar con Google
                </button>
            </div>

            <div style="display: flex; align-items: center; margin: 1.5rem 0;">
                <div style="flex: 1; height: 1px; background: #e5e7eb;"></div>
                <span style="padding: 0 1rem; color: #6b7280; font-size: 0.9rem;">o</span>
                <div style="flex: 1; height: 1px; background: #e5e7eb;"></div>
            </div>

            <form method="post" action="{{ route('login') }}">
                @csrf

                <div style="margin-bottom: 1.5rem;">
                    <label style="display: block; color: #374151; font-weight: 600; margin-bottom: 0.5rem; font-size: 0.9rem;" for="phone">Número de Teléfono</label>
                    <div style="position: relative; display: flex; border: 1px solid #e5e7eb; border-radius: 0.5rem; overflow: hidden; transition: all 0.2s ease;">
                        <div style="position: relative; width: 5rem;">
                            <select style="width: 100%;
                                         appearance: none;
                                         background-color: #f9fafb;
                                         border: none;
                                         padding: 0.75rem 0.5rem;
                                         padding-right: 1.5rem;
                                         font-size: 0.9rem;
                                         cursor: pointer;
                                         outline: none;"
                                    wire:model="country_code"
                                    name="country_code">
                                @foreach($countries as $country)
                                    <option value="{{ $country['code'] }}">{{ $country['flag'] }}</option>
                                @endforeach
                            </select>
                            <div style="position: absolute; right: 0.5rem; top: 50%; transform: translateY(-50%); pointer-events: none;">
                                <svg style="width: 12px; height: 12px; fill: #6b7280;" viewBox="0 0 20 20">
                                    <path d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"/>
                                </svg>
                            </div>
                        </div>
                        <input type="phone"
                               wire:model="phone"
                               name="phone"
                               style="flex: 1;
                                      border: none;
                                      padding: 0.75rem;
                                      outline: none;
                                      font-size: 0.95rem;"
                               placeholder="Ingresa tu número de teléfono">
                    </div>
                    @error('phone')
                    <span style="color: #ef4444; font-size: 0.8rem; margin-top: 0.5rem; display: block;">{{ $message }}</span>
                    @enderror
                </div>

                <div style="margin-bottom: 1.5rem;">
                    <label style="display: block; color: #374151; font-weight: 600; margin-bottom: 0.5rem; font-size: 0.9rem;" for="password">Contraseña</label>
                    <div style="position: relative;">
                        <input type="password"
                               wire:model="password"
                               name="password"
                               style="width: 100%;
                                      border: 1px solid #e5e7eb;
                                      border-radius: 0.5rem;
                                      padding: 0.75rem;
                                      font-size: 0.95rem;
                                      outline: none;
                                      transition: all 0.2s ease;"
                               placeholder="Ingresa tu contraseña">
                    </div>
                    @error('password')
                    <span style="color: #ef4444; font-size: 0.8rem; margin-top: 0.5rem; display: block;">{{ $message }}</span>
                    @enderror
                </div>

                <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1.5rem;">
                    <div style="display: flex; align-items: center; gap: 0.5rem;">
                        <input type="checkbox"
                               wire:model="remember"
                               name="remember"
                               style="width: 1rem;
                                      height: 1rem;
                                      border-radius: 0.25rem;
                                      border: 1px solid #d1d5db;
                                      cursor: pointer;">
                        <label for="remember" style="color: #374151; font-size: 0.9rem;">Recordarme</label>
                    </div>
                    <a href="#" style="color: #4f46e5; text-decoration: none; font-size: 0.9rem; font-weight: 500;">¿Olvidaste tu contraseña?</a>
                </div>

                <button type="submit"
                        style="width: 100%;
                               background-color: #f97316;
                               color: white;
                               padding: 0.85rem;
                               border: none;
                               border-radius: 0.5rem;
                               font-weight: 600;
                               font-size: 0.95rem;
                               cursor: pointer;
                               transition: all 0.2s ease;
                               box-shadow: 0 2px 4px rgba(249, 115, 22, 0.2);">
                    Iniciar Sesión
                </button>
            </form>

            <div style="text-align: center; color: #374151; margin-top: 1.5rem; font-size: 0.9rem;">
                ¿No tienes una cuenta?
                <a href="{{ route('register') }}"
                   style="color: #f97316;
                          text-decoration: none;
                          font-weight: 500;">
                    Regístrate
                </a>
            </div>
        </div>
    </div>
</div>
