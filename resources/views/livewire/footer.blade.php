<div wire:id="footer">
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
</div>
