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
                    <span></span> Verificar
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


                                        @if (session('error'))
                                            <div class="alert alert-danger">
                                                {{ session('error') }}
                                            </div>
                                        @endif



                                        <h3>Se ha enviado un sms con un codigo de verificación</h3>


                                        <form method="POST" action="{{ route('twilio_check') }}">
                                            @csrf

                                            <input type="hidden" name="phone_number" value="{{ $phone }}">
                                            <label for="code">Código de verificación:</label>
                                            <input type="text" name="code" inputmode="numeric"
                                                autocomplete="one-time-code" pattern="\d{6}" required>
                                            <br>
                                            <button type="submit">Verificar código</button>
                                        </form>

                                        <br>

                                        {{-- <input type="hidden"  name="phone_number" value="{{ $phone }}">
                                            <div class="form-group">
                                            <label for="channel">Canal:</label>
                                            <br>
                                           
                                            <input type="radio" id="whatsapp" name="channel" value="whatsapp" checked>
                                            <label for="whatsapp">WhatsApp</label>
                                            <br>
                                            <input type="radio" id="sms" name="channel" value="sms">
                                            <label for="sms">SMS</label>
                                            </div> --}}

                                        <form method="POST" action="{{ route('twilio_send') }}">
                                            @csrf
                                            <input type="hidden" name="phone_number" value="{{ $phone }}">
                                            <input type="hidden" name="channel" value="sms">
                                            <button id="resendButton" type="submit" disabled>
                                                @if ($enviado)
                                                    Volver a enviar
                                                @else
                                                    Enviar código de verificación
                                                @endif
                                            </button>
                                            <p id="timer" class="text-info"></p>
                                            @if (session('status'))
                                                <div class="alert alert-success mt-3">
                                                    {{ session('status') }}
                                                </div>
                                            @endif
                                        </form>






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

<script>
    var countDownDate = new Date().getTime() + (60 * 1000); // Ajuste 1 minuto adelante en el tiempo
    var resendButton = document.getElementById('resendButton');
    var timer = document.getElementById('timer');

    var resendTimer = setInterval(function() {
        var now = new Date().getTime();
        var distance = countDownDate - now;

        // Calcular los minutos y segundos
        var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
        var seconds = Math.floor((distance % (1000 * 60)) / 1000);

        timer.innerHTML = "Por favor, espera " + minutes + " minutos " + seconds +
            " segundos antes de solicitar un nuevo código.";

        if (distance < 0) {
            clearInterval(resendTimer);
            timer.innerHTML = "";
            resendButton.disabled = false;
        }
    }, 1000);
</script>
