<div>
    <main class="main single-page"></main>
        <div class="page-header breadcrumb-wrap">
            <div class="container">
                <div class="breadcrumb">
                    <a href="{{ route('home') }}" rel="nofollow">Inicio</a>
                    <span></span> Sobre Nosotros
                </div>
            </div>
        </div>
        <section class="section-padding">
            <div class="container pt-25">
                <div class="row">
                    <div class="col-lg-6 align-self-center mb-lg-0 mb-4">
                        <h6 class="mt-0 mb-15 text-uppercase font-sm text-brand wow fadeIn animated">Nuestra empresa
                        </h6>
                        <h1 class="font-heading mb-40">
                            Simplificamos tu Vida con Nuestros Servicios 🙌
                        </h1>
                        <p>YAventas es una tienda online radicada en Cuba destinada al comercio de una amplia gama de
                            productos de diferentes ámbitos, enfocados en la alimentación, pero principalmente en los
                            artículos textiles de la marca de nuestro cocreador acuñada como
                            <strong>@YuniorAmerica</strong>. Contamos con un equipo de trabajo con más de 15 años de
                            experiencia en la confección y distribución de dichos productos textiles, por lo que la
                            calidad, la durabilidad y la belleza están garantizadas.
                        </p>
                        <!-- Estos párrafos tienen el atributo de estilo display: none para ocultarlos -->
                        <p id="parrafo2" style="display: none;">La satisfacción y la comodidad de usted, nuestro
                            cliente, son nuestro principal objetivo por
                            eso buscamos ofrecerle los mejores precios del mercado, conjunto con esto, hemos habilitado
                            los pagos en MONEDA NACIONAL para garantizar un mayor alcance a todas las familias cubanas a
                            la par de unos servicios de entrega de excelencia hacen de YAventas.com la mejor opción para
                            satisfacer sus necesidades.</p>
                        <p id="parrafo3" style="display: none;">Esperamos que disfrute nuestros servicios y que estos
                            sean de su preferencia. Cualquier duda
                            o sugerencia puede contactar y escribirnos por nuestras redes sociales o números de atención
                            al cliente y con gusto lo atenderemos. </p>
                        <h4 id="parrafo4" style="display: none;">Equipo de YAventas.com</h4>
                        <div class="row mt-30">
                            <div class="col-12 text-center">
                                <p class="wow fadeIn animated">
                                    <!-- Este botón cambia el valor del atributo de estilo directamente dentro del onclick -->
                                    <a class="btn btn-brand text-white btn-shadow-brand hover-up btn-lg" id="mostrar"
                                        onclick="document.getElementById('parrafo2').style.display = 'block'; document.getElementById('parrafo3').style.display = 'block'; document.getElementById('parrafo4').style.display = 'block';document.getElementById('mostrar').style.display = 'none';document.getElementById('ocultar').style.display = 'initial';">Leer
                                        todo
                                    </a>
                                </p>
                            </div>
                        </div>

                        <div class="row mt-30">
                            <div class="col-12 text-center">
                                <p class="wow fadeIn animated">
                                    <!-- Este botón cambia el valor del atributo de estilo directamente dentro del onclick -->
                                    <a class="btn btn-brand text-white btn-shadow-brand hover-up btn-lg" id="ocultar" style="display: none"
                                        onclick="document.getElementById('parrafo2').style.display = 'none'; document.getElementById('parrafo3').style.display = 'none'; document.getElementById('parrafo4').style.display = 'none';document.getElementById('mostrar').style.display = 'initial';document.getElementById('ocultar').style.display = 'none';">Leer
                                        menos
                                    </a>
                                </p>
                            </div>
                        </div>

                    </div>
                    <div class="col-lg-6">
                        <img src="assets/imgs/page/about-1.png" alt=""
                            style="border-radius: 10%; border: 3px solid #FF6E11">
                    </div>
                </div>
            </div>
        </section>

        <section id="testimonials" class="section-padding">
            <div class="container pt-25">
                <div class="row mb-50">
                    <div class="col-lg-12 col-md-12 text-center">
                        <h6 class="mt-0 mb-10 text-uppercase  text-brand font-sm wow fadeIn animated">Nuestro equipo
                        </h6>
                        <h2 class="mb-15 text-grey-1 wow fadeIn animated">Conoce al equipo <br> de profesionales de
                            yaventas</h2>
                        <p class="w-50 m-auto text-grey-3 wow fadeIn animated">Somos los encargados de hacer que nuestro
                            sitio mejore constantemente con el fin de poder ofrecerte los mejores servicios con los
                            mejores precios.</p>
                    </div>
                </div>
                <div class="row align-items-center">
                    <div class="col-md-6 col-lg-4">
                        <div class="hero-card box-shadow-outer-6 wow fadeIn animated mb-30 hover-up d-flex">
                            <div class="hero-card-icon icon-left-2 hover-up ">
                                <img class="btn-shadow-brand hover-up border-radius-5 bg-brand-muted"
                                    src="assets/imgs/page/avatar-2.jpg" alt="">
                            </div>
                            <div class="pl-30">
                                <h5 class="mb-5 fw-500">
                                    Fabian Fernandez
                                </h5>
                                <p class="font-sm text-grey-5">Desarrollador</p>
                                <p class="text-grey-3">Estudiante de Ing.Informatica en la CUJAE</p>
                                <div class="social-icons single-share">
                                    <ul class="text-grey-5 d-inline-block">


                                        <li class="social-instagram"><a href="#"><img
                                                    src="assets/imgs/theme/icons/icon-instagram.svg" alt=""></a>
                                        </li>

                                    </ul>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="col-md-6 col-lg-4">
                        <div class="hero-card box-shadow-outer-6 wow fadeIn animated mb-30 hover-up d-flex">
                            <div class="hero-card-icon icon-left-2 hover-up ">
                                <img class="btn-shadow-brand hover-up border-radius-5 bg-brand-muted"
                                    src="assets/imgs/page/avatar-1.JPEG" alt="">
                            </div>
                            <div class="pl-30">
                                <h5 class="mb-5 fw-500">
                                    Ruben Hernandez
                                </h5>
                                <p class="font-sm text-grey-5">CTO</p>
                                <p class="text-grey-3">Estudiante de Ing.Informatica en la CUJAE.</p>
                                <div class="social-icons single-share">
                                    <ul class="text-grey-5 d-inline-block">



                                        <li class="social-instagram"><a href="#"><img
                                                    src="assets/imgs/theme/icons/icon-instagram.svg" alt=""></a>
                                        </li>

                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-4">
                        <div class="hero-card box-shadow-outer-6 wow fadeIn animated mb-30 hover-up d-flex">
                            <div class="hero-card-icon icon-left-2 hover-up ">
                                <img class="btn-shadow-brand hover-up border-radius-5 bg-brand-muted"
                                    src="assets/imgs/page/avatar-3.jpg" alt="">
                            </div>
                            <div class="pl-30">
                                <h5 class="mb-5 fw-500">
                                    Eduardo Fonseca
                                </h5>
                                <p class="font-sm text-grey-5">Marketing</p>
                                <p class="text-grey-3">Estudiante de Ing.Informatica en la CUJAE.</p>
                                <div class="social-icons single-share">
                                    <ul class="text-grey-5 d-inline-block">


                                        <li class="social-instagram"><a href="#"><img
                                                    src="assets/imgs/theme/icons/icon-instagram.svg" alt=""></a>
                                        </li>

                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>


                    {{-- <div class="row mt-30">
                    <div class="col-12 text-center">
                        <p class="wow fadeIn animated">
                            <a class="btn btn-brand text-white btn-shadow-brand hover-up btn-lg">View More</a>
                        </p>
                    </div>
                </div> --}}
                </div>
        </section>
        {{-- <section class="section-padding">
            <div class="container pb-25">
                <h3 class="section-title mb-20 wow fadeIn animated text-center"><span>Featured</span> Clients</h3>
                <div class="carausel-6-columns-cover position-relative wow fadeIn animated">
                    <div class="carausel-6-columns text-center" id="carausel-6-columns-3">
                        <div class="brand-logo">
                            <img class="img-grey-hover" src="assets/imgs/banner/brand-1.png" alt="">
                        </div>
                        <div class="brand-logo">
                            <img class="img-grey-hover" src="assets/imgs/banner/brand-2.png" alt="">
                        </div>
                        <div class="brand-logo">
                            <img class="img-grey-hover" src="assets/imgs/banner/brand-3.png" alt="">
                        </div>
                        <div class="brand-logo">
                            <img class="img-grey-hover" src="assets/imgs/banner/brand-4.png" alt="">
                        </div>
                        <div class="brand-logo">
                            <img class="img-grey-hover" src="assets/imgs/banner/brand-5.png" alt="">
                        </div>
                        <div class="brand-logo">
                            <img class="img-grey-hover" src="assets/imgs/banner/brand-6.png" alt="">
                        </div>
                        <div class="brand-logo">
                            <img class="img-grey-hover" src="assets/imgs/banner/brand-3.png" alt="">
                        </div>
                    </div>
                </div>
            </div>
        </section> --}}
    </main>
</div>
