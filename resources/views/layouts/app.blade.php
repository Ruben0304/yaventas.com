

<!DOCTYPE html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <title>YaVentas - Tu tienda online en Cuba</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description"
          content="YaVentas es una tienda online que se dedica a vender productos variados y de buena calidad y precio en Cuba. Encuentra lo que buscas y recíbelo en tu casa con facilidad y seguridad."/>
    <meta name="keywords" content="tienda online, productos variados, buena calidad, buen precio, Cuba"/>
    <meta property="og:url" content="https://yaventas.com/"/>
    <meta property="og:type" content="website"/>
    <meta property="og:title" content="YaVentas - Tu tienda online en Cuba"/>
    <meta property="og:description"
          content="YaVentas es una tienda online que se dedica a vender productos variados y de buena calidad y precio en Cuba. Encuentra lo que buscas y recíbelo en tu casa con facilidad y seguridad."/>
    <link rel="shortcut icon" type="image/x-icon" href="img/logo/fav.png">
    <link rel="stylesheet" href="{{ asset('assets/css/main.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/custom.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    @laravelPWA


    <style>
        @media (max-width: 640px) {
            #featured {
                display: none;
            }


            .slider-1-1 {
                width: 72%;
                margin-right: 14%;
            }

        }
    </style>

    @stack('styles')
    @livewireStyles
</head>

<body>


<livewire:navigation/>
<livewire:mobile-navigation/>


{{ $slot }}

<footer class="main">
    <section class="newsletter p-30 text-white wow fadeIn animated">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-7 mb-md-3 mb-lg-0">
                    <div class="row align-items-center">
                        <div class="col flex-horizontal-center">
                            <img class="icon-email" src="assets/imgs/theme/icons/icon-email.svg" alt="icono email">
                            <h4 class="font-size-20 mb-0 ml-3">¡Suscríbete a nuestro boletín!</h4>
                        </div>
                        <div class="col my-4 my-md-0 des">
                            <h5 class="font-size-15 ml-4 mb-0">...y recibe un <strong>cupón de $25 en tu primera
                                    compra</strong></h5>
                        </div>
                    </div>
                </div>
                <div class="col-lg-5">
                    <form class="form-subcriber d-flex wow fadeIn animated">
                        <input type="email" class="form-control bg-white font-small"
                               placeholder="Ingresa tu correo electrónico">
                        <button class="btn bg-dark text-white hover-up" type="submit">Suscribirse</button>
                    </form>
                </div>
            </div>
        </div>
    </section>
    <section class="section-padding footer-mid">
        <div class="container pt-15 pb-20">
            <div class="row">
                <div class="col-lg-4 col-md-6">
                    <div class="widget-about font-md mb-md-5 mb-lg-0">
                        <div class="logo logo-width-1 wow fadeIn animated">
                            <a href="{{route('home')}}"><img src="assets/imgs/logo/logo.png" alt="logo"></a>
                        </div>
                        <h5 class="mt-20 mb-10 fw-600 text-grey-4 wow fadeIn animated">Contacto</h5>
                        <p class="wow fadeIn animated">
                            <strong>Dirección: </strong>Calle Wellington 562
                        </p>
                        <p class="wow fadeIn animated">
                            <strong>Teléfono: </strong>+1 0000-000-000
                        </p>
                        <p class="wow fadeIn animated">
                            <strong>Correo: </strong>contacto@yunioramerica.com
                        </p>
                        <h5 class="mb-10 mt-30 fw-600 text-grey-4 wow fadeIn animated">Síguenos en Redes</h5>
                        <div class="mobile-social-icon wow fadeIn animated mb-sm-5 mb-md-0">
                            <a href="#" class="hover-up"><img src="assets/imgs/theme/icons/icon-facebook.svg"
                                                              alt="facebook"></a>
                            <a href="#" class="hover-up"><img src="assets/imgs/theme/icons/icon-twitter.svg"
                                                              alt="twitter"></a>
                            <a href="#" class="hover-up"><img src="assets/imgs/theme/icons/icon-instagram.svg"
                                                              alt="instagram"></a>
                            <a href="#" class="hover-up"><img src="assets/imgs/theme/icons/icon-pinterest.svg"
                                                              alt="pinterest"></a>
                            <a href="#" class="hover-up"><img src="assets/imgs/theme/icons/icon-youtube.svg"
                                                              alt="youtube"></a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-2 col-md-3">
                    <h5 class="widget-title wow fadeIn animated">Nosotros</h5>
                    <ul class="footer-list wow fadeIn animated mb-sm-5 mb-md-0">
                        <li><a href="#" class="hover-up">Quiénes Somos</a></li>
                        <li><a href="#" class="hover-up">Información de Envíos</a></li>
                        <li><a href="#" class="hover-up">Política de Privacidad</a></li>
                        <li><a href="#" class="hover-up">Términos y Condiciones</a></li>
                        <li><a href="#" class="hover-up">Contáctanos</a></li>
                    </ul>
                </div>
                <div class="col-lg-2 col-md-3">
                    <h5 class="widget-title wow fadeIn animated">Mi Cuenta</h5>
                    <ul class="footer-list wow fadeIn animated">
                        <li><a href="mi-cuenta.html" class="hover-up">Mi Perfil</a></li>
                        <li><a href="#" class="hover-up">Ver Carrito</a></li>
                        <li><a href="#" class="hover-up">Lista de Deseos</a></li>
                        <li><a href="#" class="hover-up">Seguir Pedido</a></li>
                        <li><a href="#" class="hover-up">Mis Pedidos</a></li>
                    </ul>
                </div>
                <div class="col-lg-4 mob-center">
                    <h5 class="widget-title wow fadeIn animated">Descarga Nuestra App</h5>
                    <div class="row">
                        <div class="col-md-8 col-lg-12">
                            <p class="wow fadeIn animated">Disponible en App Store y Google Play</p>
                            <div class="download-app wow fadeIn animated mob-app">
                                <a href="#" class="hover-up mb-sm-4 mb-lg-0"><img class="active"
                                                                                  src="assets/imgs/theme/app-store.jpg"
                                                                                  alt="app store"></a>
                                <a href="#" class="hover-up"><img src="assets/imgs/theme/google-play.jpg"
                                                                  alt="google play"></a>
                            </div>
                        </div>
                        <div class="col-md-4 col-lg-12 mt-md-3 mt-lg-0">
                            <p class="mb-20 wow fadeIn animated">Métodos de Pago Seguros</p>
                            <img class="wow fadeIn animated" src="assets/imgs/theme/payment-method.png"
                                 alt="métodos de pago">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <div class="container pb-20 wow fadeIn animated mob-center">
        <div class="row">
            <div class="col-12 mb-20">
                <div class="footer-bottom"></div>
            </div>
            <div class="col-lg-6">
                <p class="float-md-left font-sm text-muted mb-0">
                    <a href="{{ route('politica') }}" class="hover-up">Política de Privacidad</a> |
                    <a href="{{ route('terminos') }}" class="hover-up">Términos y Condiciones</a>
                </p>
            </div>
            <div class="col-lg-6">
                <p class="text-lg-end text-start font-sm text-muted mb-0">
                    &copy; <strong class="text-brand">Yunior America</strong> - Todos los derechos
                    reservados {{ date('Y') }}
                </p>
            </div>
        </div>
    </div>
</footer>

<style>
    .hover-up {
        transition: all 0.3s ease-in-out;
    }

    .hover-up:hover {
        transform: translateY(-5px);
    }

    .footer-list li a {
        transition: all 0.3s ease;
        line-height: 2.5;
    }

    .footer-list li a:hover {
        padding-left: 5px;
    }

    .mobile-social-icon a {
        margin-right: 15px;
    }

    .btn {
        border-radius: 5px;
        padding: 10px 25px;
        transition: all 0.3s ease;
    }

    .btn:hover {
        transform: translateY(-2px);
    }

    .newsletter {
        border-radius: 10px;
        margin-bottom: 30px;
    }
</style>
<!-- Vendor JS-->
@livewireScripts

{{-- <script>
        if ('serviceWorker' in navigator) {
          window.addEventListener('load', function() {
            navigator.serviceWorker.register('serviceworker.js').then(function(registration) {
              console.log('Service worker registrado con éxito:', registration.scope);
            }, function(err) {
              console.log('Error al registrar el service worker:', err);
            });
          });
        }
        </script> --}}
<script src="{{ asset('assets/js/vendor/modernizr-3.6.0.min.js     ') }}"></script>
<script src="{{ asset('assets/js/vendor/jquery-3.6.0.min.js        ') }}"></script>
<script src="{{ asset('assets/js/vendor/jquery-migrate-3.3.0.min.js') }}"></script>
<script src="{{ asset('assets/js/vendor/bootstrap.bundle.min.js    ') }}"></script>
<script src="{{ asset('assets/js/plugins/slick.js                  ') }}"></script>
<script src="{{ asset('assets/js/plugins/jquery.syotimer.min.js    ') }}"></script>
<script src="{{ asset('assets/js/plugins/wow.js                    ') }}"></script>
<script src="{{ asset('assets/js/plugins/jquery-ui.js              ') }}"></script>
<script src="{{ asset('assets/js/plugins/perfect-scrollbar.js      ') }}"></script>
<script src="{{ asset('assets/js/plugins/magnific-popup.js         ') }}"></script>
<script src="{{ asset('assets/js/plugins/select2.min.js            ') }}"></script>
<script src="{{ asset('assets/js/plugins/waypoints.js              ') }}"></script>
<script src="{{ asset('assets/js/plugins/counterup.js              ') }}"></script>
<script src="{{ asset('assets/js/plugins/jquery.countdown.min.js   ') }}"></script>
<script src="{{ asset('assets/js/plugins/images-loaded.js          ') }}"></script>
<script src="{{ asset('assets/js/plugins/isotope.js                ') }}"></script>
<script src="{{ asset('assets/js/plugins/scrollup.js               ') }}"></script>
<script src="{{ asset('assets/js/plugins/jquery.vticker-min.js     ') }}"></script>
<script src="{{ asset('assets/js/plugins/jquery.theia.sticky.js    ') }}"></script>
<script src="{{ asset('assets/js/plugins/jquery.elevatezoom.js     ') }}"></script>
<!-- Template  JS -->
<script src="{{ asset('assets/js/main.js?v=3.3') }}"></script>
<script src="{{ asset('assets/js/shop.js?v=3.3') }}"></script>
<script src="{{ asset('assets/js/pwa.js     ') }}"></script>

@stack('scripts')
</body>

</html>
