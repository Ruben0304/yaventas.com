<style>
    #emoji {
        width: 150px;



    }

    @media (max-width: 640px) {
        #emoji {
            width: 30%;

        }

    }
</style>

<x-app-layout>
    <main class="main">
        <div class="page-header breadcrumb-wrap">
            <div class="container">
                <div class="breadcrumb">
                    <a href="index.html" rel="nofollow">Inicio</a>
                    <span></span> Registrarse
                </div>
            </div>
        </div>
        <section class="pt-150 pb-150">
            <div class="container">
                <!-- Cambiar la etiqueta img por una etiqueta p con el emoji -->
                <div style="display: flex; justify-content:center;">
                    <img src="img/notapado.png" alt="" id="emoji">
                </div>
                <div class="row">
                    <div class="col-lg-10 m-auto">
                        <div class="row" style="justify-content: center;">
                            <div class="col-lg-6">
                                <div class="login_wrap widget-taber-content p-30 background-white border-radius-5">
                                    <div class="padding_eight_all bg-white">
                                        <div class="heading_s1">
                                            <h3 class="mb-30">Registrarse</h3>
                                        </div>
                                        <form method="post" action="{{ route('register') }}">
                                            @csrf
                                            <div class="form-group">
                                                <input id="name" type="text" name="name"
                                                    value="{{ old('name') }}" placeholder="Nombre" required>

                                                @error('name')
                                                    <span>{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div class="form-group" style="display: inline">
                                                <!-- Agregar la clase iti-input al input -->
                                                <div class="custom_select">
                                                    <select class="form-control select-active" name="country_code"
                                                        required>
                                                        <option value="+53" selected>🇨🇺 Cuba (+53)</option>
                                                        <option value="+1">🇺🇸 Estados Unidos (+1)</option>
                                                        <option value="+52">🇲🇽 México (+52)</option>
                                                        <option value="+54">🇦🇷 Argentina (+54)</option>
                                                        <option value="+55">🇧🇷 Brasil (+55)</option>
                                                        <option value="+56">🇨🇱 Chile (+56)</option>
                                                        <option value="+57">🇨🇴 Colombia (+57)</option>
                                                        <option value="+86">🇨🇳 China (+86)</option>
                                                        <option value="+33">🇫🇷 Francia (+33)</option>
                                                        <option value="+49">🇩🇪 Alemania (+49)</option>
                                                        <option value="+91">🇮🇳 India (+91)</option>
                                                        <option value="+39">🇮🇹 Italia (+39)</option>
                                                        <option value="+81">🇯🇵 Japón (+81)</option>
                                                        <option value="+7">🇷🇺 Rusia (+7)</option>
                                                        <option value="+34">🇪🇸 España (+34)</option>
                                                        <option value="+44">🇬🇧 Reino Unido (+44)</option>
                                                        <option value="+61">🇦🇺 Australia (+61)</option>
                                                        <option value="+27">🇿🇦 Sudáfrica (+27)</option>
                                                        <option value="+90">🇹🇷 Turquía (+90)</option>
                                                        <option value="+31">🇳🇱 Países Bajos (+31)</option>
                                                        <option value="+46">🇸🇪 Suecia (+46)</option>
                                                        <option value="+41">🇨🇭 Suiza (+41)</option>
                                                    </select>

                                                </div>
                                                <div class="form-group">
                                                    <input type="text" required="" name="phone"
                                                        placeholder="Tu número de movil" :value="old('phone')" required
                                                        autofocus>
                                                    @if (session('error'))
                                                        <div class="alert alert-danger">
                                                            {{ session('error') }}
                                                        </div>
                                                    @endif

                                                    @error('phone')
                                                        <span>{{ __($message) }}</span>
                                                    @enderror
                                                </div>
                                            </div>


                                            <div class="form-group">
                                                <input id="password" type="password" name="password"
                                                    placeholder="Contraseña" required>

                                                @error('password')
                                                    <span>{{ $message }}</span>
                                                @enderror
                                            </div>

                                            <div class="form-group">
                                                <input id="password-confirm" type="password"
                                                    name="password_confirmation" placeholder="Repita la Contraseña"
                                                    required>
                                            </div>
                                            <div class="login_footer form-group">
                                                <div class="chek-form">
                                                    <div class="custome-checkbox">
                                                        <input class="form-check-input" type="checkbox" name="checkbox"
                                                            id="exampleCheckbox12" value="">
                                                        <label class="form-check-label"
                                                            for="exampleCheckbox12"><span>Acepta unirte a nuestro grupo
                                                                de whatsapp y disfruta de un 10% de descuento
                                                                permanente. 💰😎</span></label>
                                                    </div>
                                                </div>

                                            </div>
                                            <div class="form-group">
                                                <button type="submit" class="btn btn-fill-out btn-block hover-up"
                                                    name="login"> Aceptar &amp; Registrarte</button>
                                            </div>
                                            <div class="form-group mb-3" style="display: none">
                                                <label for="remember"> Recuérdame </label>
                                                <input type="checkbox" name="remember" value="1" checked>
                                            </div>
                                        </form>
                                        <div class="text-muted text-center">Ya tienes cuenta ? <a
                                                href="{{ route('login') }}">Entrar</a></div>
                                        <hr>
                                        <div class="text-muted text-center">Al registrarte aceptas nuestros <a
                                                href="{{ route('login') }}">Terminos y Condiciones <i
                                                    class="fi-rs-book-alt mr-5 text-muted"></i></a>y nuestra <a
                                                href="{{ route('login') }}">Politica de Privacidad <i
                                                    class="fi-rs-book-alt mr-5 text-muted"></i></a> </div>

                                    </div>

                                </div>
                            </div>
                            <div class="col-lg-1"></div>
                            {{-- <div class="col-lg-6">
                               <img src="assets/imgs/login.png">
                            </div> --}}
                        </div>
                    </div>
                </div>
            </div>
            </div>
        </section>
        <script>
            // Obtener los elementos del DOM
            let inputPassword = document.querySelector("input[name='password']");
            let inputConfirm = document.querySelector("input[name='confirm']");
            

            // Definir las funciones para cambiar el emoji
            function showMonkey() {
                document.getElementById("emoji").src = "img/notapado.png";
            }

            function hideMonkey() {
                document.getElementById("emoji").src = "img/tapado.png";
            }

            // Añadir los eventos a los inputs
            inputPassword.addEventListener("focus", hideMonkey);
            inputPassword.addEventListener("blur", showMonkey);
            inputConfirm.addEventListener("focus", hideMonkey);
            inputConfirm.addEventListener("blur", showMonkey);
        </script>
    </main>

</x-app-layout>
