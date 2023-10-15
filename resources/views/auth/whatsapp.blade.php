<style>
    .logito {
        width: 150px;
        margin-left: 45%
    }

    @media (max-width: 640px) {
        .logito {
            width: 30%;
            margin-left: 35%
        }

    }
</style>

<x-app-layout>
    <main class="main">
        <div class="page-header breadcrumb-wrap">
            <div class="container">
                <div class="breadcrumb">
                    <a href="{{ route('home') }}" rel="nofollow">Inicio</a>
                    <span></span> Whatsapp
                </div>
            </div>
        </div>
        <section class="pt-150 pb-150">
            <div class="container">
                {{-- <img src="img/profile.gif" alt="" class="logito"> --}}
                <div class="row">
                    <div class="col-lg-10 m-auto">
                        <div class="row" style="justify-content: center;">
                            <div class="col-lg-5">
                                <div
                                    class="login_wrap widget-taber-content p-30 background-white border-radius-10 mb-md-5 mb-lg-0 mb-sm-5">
                                    <div class="padding_eight_all bg-white">
                                        <div class="heading_s1">
                                            {{-- <h3 class="mb-30">Introducir número de WhatsApp 📱</h3> --}}
                                            <img src="img/whatsapp.png" alt="" width="48%"
                                                style="margin-left: 26%">
                                        </div>
                                        <form method="post" action="{{ route('unirse_whatsapp') }}">
                                            @csrf
                                            <div class="form-group" style="display: inline">
                                                <!-- Agregar la clase iti-input al input -->
                                                <div class="custom_select">
                                                    <select class="form-control select-active" name="country_code"
                                                        required>
                                                        <option value="+53" selected>Cuba (+53)</option>
                                                        <option value="+1">Estados Unidos (+1)</option>
                                                        <option value="+52">México (+52)</option>
                                                        <option value="+54">Argentina (+54)</option>
                                                        <option value="+55">Brasil (+55)</option>
                                                        <option value="+56">Chile (+56)</option>
                                                        <option value="+57">Colombia (+57)</option>
                                                        <option value="+86">China (+86)</option>
                                                        <option value="+33">Francia (+33)</option>
                                                        <option value="+49">Alemania (+49)</option>
                                                        <option value="+91">India (+91)</option>
                                                        <option value="+39">Italia (+39)</option>
                                                        <option value="+81">Japón (+81)</option>
                                                        <option value="+7">Rusia (+7)</option>
                                                        <option value="+34">España (+34)</option>
                                                        <option value="+44">Reino Unido (+44)</option>
                                                        <option value="+61">Australia (+61)</option>
                                                        <option value="+27">Sudáfrica (+27)</option>
                                                        <option value="+90">Turquía (+90)</option>
                                                        <option value="+31">Países Bajos (+31)</option>
                                                        <option value="+46">Suecia (+46)</option>
                                                        <option value="+41">Suiza (+41)</option>
                                                    </select>
                                                </div>
                                                <input type="text" required="" name="whatsapp_number"
                                                    placeholder="Tu número de teléfono de WhatsApp"
                                                    :value="old('whatsapp_number')" required autofocus>
                                                <x-input-error :messages="$errors->get('whatsapp_number')" class="mt-2" />
                                            </div>
                                            <div class="login_footer form-group">
                                                <label class="form-check-label"><span> Acepta unirte a nuestro grupo de
                                                        WhatsApp y disfruta de un 10% de descuento permanente en todas
                                                        tus compras. 💰😍</span></label>
                                            </div>
                                            <div class="form-group">
                                                <button type="submit" class="btn btn-fill-out btn-block hover-up"
                                                    name="submit">Enviar y unirse al grupo 🚀</button>
                                            </div>
                                        </form>

                                        <!-- Incluir los archivos CSS y JS de la librería -->


                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>


</x-app-layout>
