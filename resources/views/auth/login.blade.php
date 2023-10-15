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
                    <a href="{{ route('home') }}" rel="nofollow">Inicio</a>
                    <span></span> Entrar
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
                            <div class="col-lg-5">
                                <div
                                    class="login_wrap widget-taber-content p-30 background-white border-radius-10 mb-md-5 mb-lg-0 mb-sm-5">
                                    <div class="padding_eight_all bg-white">
                                        <div class="heading_s1">
                                            <h3 class="mb-30">Entrar</h3>
                                        </div>
                                        <form method="post" action="{{ route('login') }}">
                                            @csrf
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
                                                    <input type="phone" required="" name="phone"
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
                                                <input required="" type="password" name="password"
                                                    placeholder="Contraseña" required autocomplete="current-password" />
                                                <x-input-error :messages="$errors->get('password')" class="mt-2" />
                                            </div>
                                            <div class="login_footer form-group">
                                                <div class="chek-form">
                                                    <div class="custome-checkbox">
                                                        <input class="form-check-input" type="checkbox" name="remember"
                                                            id="exampleCheckbox1" checked />


                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <button type="submit" class="btn btn-fill-out btn-block hover-up"
                                                        name="login">
                                                        Entrar
                                                    </button>
                                                </div>
                                                <div class="form-group mb-3" style="display: none">
                                                    <label for="remember"> Recuérdame </label>
                                                    <input type="checkbox" name="remember" value="1" checked />
                                                </div>
                                        </form>
                                        <div class="text-muted text-center">
                                            No tienes cuenta ?<a href="{{ route('register') }}">Rigistrate</a>
                                        </div>
                                    </div>
                                    <a href="{{ route('glogin') }}"><img src="/img/google.png" alt=""
                                            style="" /></i></span></a>
                                </div>
                            </div>
                            <div class="col-lg-1"></div>


                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Añadir el script para cambiar el emoji según el estado de los inputs -->
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
