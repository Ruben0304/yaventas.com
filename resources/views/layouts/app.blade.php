@php
    use App\Models\Carrito;
    use App\Models\Categoria;
    use App\Models\Whatsapp;
    $carrito = Carrito::all();
    $categorias = Categoria::all();

    // $carrito="";

@endphp
@auth
@php

    $whatsapp = Whatsapp::where('id_user', Auth::user()->id)->first() ?? null;
@endphp
@else
@php
    $whatsapp = null;
@endphp
@endauth

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
    @livewireStyles
    @stack('styles')
</head>

<body>
<header class="header-area header-style-1 header-height-2">
    <div class="header-top header-top-ptb-1 d-none d-lg-block">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-xl-3 col-lg-4">
                    <div class="header-info">

                    </div>
                </div>
                <div class="col-xl-6 col-lg-4">
                    <div class="text-center">
                        <div id="news-flash" class="d-inline-block">
                            <ul>
                                <li>Unete a whatsapp para consegir ofertas <a href="">Unirse</a></li>
                                <li>Calidad y seguridad garantizadas</li>

                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-4">
                    <div class="header-info header-info-right">
                        <ul>
                            @auth
                                <li><i class="fi-rs-key"></i><a href="{{ route('home') }}">{{ Auth::user()->name }} </a>
                                    <form action="{{ route('logout') }}" method="post">
                                        @csrf
                                        <a href=""
                                           onclick="event.preventDefault(); this.closest('form').submit()">Salir</a>

                                    </form>
                                </li>
                            @else
                                <li><i class="fi-rs-key"></i><a href="{{ route('login') }}">Entrar </a> / <a
                                        href="{{ route('register') }}">Registrate</a></li>

                            @endauth

                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="header-middle header-middle-ptb-1 d-none d-lg-block">
        <div class="container">
            <div class="header-wrap">
                <div class="logo logo-width-1">
                    <a href="{{ route('home') }}"><img src="img/logo/1.png" alt="logo" width="100px"></a>
                    {{-- <h4>Aqui va el logo.</h4> --}}
                </div>
                <div class="header-right">
                    <div class="search-style-1">
                        <form action="{{ route('buscar') }}" method="GET">

                            <input type="text" placeholder="Buscar" name="buscar">
                            <button type="submit" class="site-btn"><i class="fi-rs-search"
                                                                      style="padding: 5px"></i></button>
                        </form>
                    </div>
                    <div class="header-action-right">
                        <div class="header-action-2">
                            <div class="header-action-icon-2">
                                {{-- <a href="shop-wishlist.php">
                                    <img class="svgInject" alt="Surfside Media" src="assets/imgs/theme/icons/icon-heart.svg">
                                    <span class="pro-count blue">4</span>
                                </a> --}}
                            </div>
                            <div class="header-action-icon-2">
                                <a class="mini-cart-icon" href="{{ route('carrito') }}">
                                    <img alt="Surfside Media" src="assets/imgs/theme/icons/icon-cart.svg">
                                    <span class="pro-count blue">
                                            @auth
                                            {{ $carrito->where('id_user', Auth::user()->id)->count() }}
                                        @else
                                            0
                                        @endauth </span>
                                </a>
                                <div class="cart-dropdown-wrap cart-dropdown-hm2">
                                    <ul>
                                        @php $subtotal=0 @endphp
                                        @auth

                                            @php $carritos= $carrito->where('id_user',Auth::user()->id)@endphp
                                            @if ($carritos->first() == null)
                                            @else
                                                @foreach ($carritos as $item)
                                                    <form action=" {{ route('quitar_carrito') }} "
                                                          name="quitarcarrito{{ 2 * 34 + 345 * $item->id_user * $item->id }}"
                                                          method="POST">
                                                        @csrf
                                                        <input type="hidden" value="{{ $item->id }}"
                                                               name="id">

                                                    </form>
                                                    <li>
                                                        <div class="shopping-cart-img">
                                                            <a
                                                                href="{{ route('detalles', 'id=' . $item->producto->id . '') }}"><img
                                                                    alt=""
                                                                    src="{{ $item->producto->foto }}"></a>
                                                        </div>
                                                        <div class="shopping-cart-title">
                                                            <h4><a
                                                                    href="{{ route('detalles', 'id=' . $item->producto->id . '') }}">{{ $item->producto->name }}</a>
                                                            </h4>
                                                            <h4><span>{{ $item->cantidad }} ×
                                                                </span>${{ $whatsapp ? $item->producto->preciocup : $item->producto->preciocup + 0.1 * $item->producto->preciocup }}
                                                            </h4>
                                                        </div>
                                                        <div class="shopping-cart-delete">
                                                            <a
                                                                href="javascript:document.quitarcarrito{{ 2 * 34 + 345 * $item->id_user * $item->id }}.submit()"><i
                                                                    class="fi-rs-cross-small"></i></a>
                                                        </div>
                                                    </li>
                                                    @php
                                                        $subtotal += ($whatsapp ? $item->producto->preciocup : $item->producto->preciocup + 0.1 * $item->producto->preciocup) * $item->cantidad;
                                                    @endphp
                                                @endforeach
                                            @endif

                                    </ul>
                                    <div class="shopping-cart-footer">
                                        <div class="shopping-cart-total">
                                            <h4>Total <span>${{ $subtotal }}</span></h4>
                                        </div>
                                        <div class="shopping-cart-button">
                                            <a href="{{ route('carrito') }}" class="outline">Ver Carrito</a>
                                            <a href="{{ route('mapa') }}">Pagar</a>
                                        </div>
                                        @else
                                            <div class="shopping-cart-footer">
                                                <div class="shopping-cart-total">
                                                    <h4>Total <span>$0</span></h4>
                                                </div>
                                                <div class="shopping-cart-button">
                                                    <a href="{{ route('carrito') }}" class="outline">Ver Carrito</a>
                                                    <a href="{{ route('mapa') }}">Pagar</a>
                                                </div>
                                                @endauth
                                            </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="header-bottom header-bottom-bg-color sticky-bar">
            <div class="container">
                <div class="header-wrap header-space-between position-relative">
                    <div class="logo logo-width-1 d-block d-lg-none">
                        <a href="{{ route('home') }}"><img src="img/logo/1.png" alt="logo"></a>
                        {{-- <h1>Logo aqui</h1> --}}
                    </div>
                    <div class="header-nav d-none d-lg-flex">
                        <div class="main-categori-wrap d-none d-lg-block">
                            <a class="categori-button-active" href="#">
                                <span class="fi-rs-apps"></span> Categorias
                            </a>
                            <div class="categori-dropdown-wrap categori-dropdown-active-large">
                                <ul>
                                    @foreach ($categorias as $categoria)
                                        <form action="{{ route('categoria') }}" method="GET">

                                            <input type="hidden" name="buscar" value="{{ $categoria->id }}">


                                            <li><a href=""
                                                   onclick="event.preventDefault(); this.closest('form').submit()"><i
                                                        class="surfsidemedia-font-desktop"></i>{{ $categoria->nombre }}
                                                </a>
                                            </li>
                                        </form>
                                    @endforeach

                                </ul>
                                <div class="more_categories">Mostrar mas...</div>
                            </div>
                        </div>
                        {{--                        <div class="main-menu main-menu-padding-1 main-menu-lh-2 d-none d-lg-block"--}}
                        {{--                             style="margin-left: 100px;">--}}
                        {{--                            <nav>--}}
                        {{--                                <ul>--}}
                        {{--                                    <li><a class="active" href="{{ route('home') }}">Inicio </a></li>--}}

                        {{--                                    <li><a href="{{ route('shoping') }}">Comprar</a></li>--}}
                        {{--                                    <li><a href="{{ route('dashboard') }}">Mi Cuenta </a></li>--}}
                        {{--                                    <li><a href="{{ route('info') }}">Sobre Nosotros</a></li>--}}
                        {{--                                    @auth--}}
                        {{--                                        @if (Auth::user()->utype == 'ADMIN')--}}
                        {{--                                            --}}{{-- <li><a href="contact.html">Reservas</a></li> --}}
                        {{--                                            <li><a href="#">Administrar <i class="fi-rs-angle-down"></i></a>--}}
                        {{--                                                <ul class="sub-menu">--}}
                        {{--                                                    <li><a href="{{ route('admin.crear.productos') }}">Agregar--}}
                        {{--                                                            Producto</a></li>--}}
                        {{--                                                    <li><a href="{{ route('admin.productos') }}">Productos</a></li>--}}
                        {{--                                                    <li><a href="{{ route('admin.categorias') }}">Categorias</a></li>--}}
                        {{--                                                    <li><a href="{{ route('admin.listado.usuarios') }}">Usuarios</a>--}}
                        {{--                                                    </li>--}}
                        {{--                                                    <li><a href="{{ route('admin.listado.ordenes') }}">Ordenes</a></li>--}}
                        {{--                                                    <li><a href="{{ route('admin.listado.vendedores') }}">Vendedores</a>--}}
                        {{--                                                    </li>--}}
                        {{--                                                </ul>--}}
                        {{--                                            </li>--}}
                        {{--                                        @endif--}}
                        {{--                                    @endauth--}}
                        {{--                                </ul>--}}
                        {{--                            </nav>--}}
                        {{--                        </div>--}}
                        @livewire('navigation')
                    </div>
                    <div class="hotline d-none d-lg-block">
                        <p><i class="fi-rs-smartphone"></i><span>Contáctanos</span> +1 (786)592-6593 </p>
                    </div>
                    <p class="mobile-promotion">Unete <span class="text-brand">a nuestro grupo en Whatsapp</span>
                        y obten descuento de 10% en todas las compras</p>
                    <div class="header-action-right d-block d-lg-none">
                        <div class="header-action-2">
                            <div class="header-action-icon-2">
                                {{-- <a href="shop-wishlist.php">
                                    <img alt="Surfside Media" src="assets/imgs/theme/icons/icon-heart.svg">
                                    <span class="pro-count white">4</span>
                                </a> --}}


                            </div>
                            <div class="header-action-icon-2">
                                <a class="mini-cart-icon" href="{{ route('carrito') }}">
                                    <img alt="" src="assets/imgs/theme/icons/icon-cart.svg">

                                    <span class="pro-count white">@auth
                                            {{ $carritos->count() }}
                                        @else
                                            0
                                        @endauth
                                    </span>
                                </a>
                                {{-- @auth
                                <div class="cart-dropdown-wrap cart-dropdown-hm2">
                                    <ul>



                                        @if ($carritos->first() == null)


                                        @else

                                        @foreach ($carritos as $item)

                                        <li>
                                            <div class="shopping-cart-img">
                                                <a href="{{route('detalles','id='.$item->producto->id.'')}}"><img alt="{{$item->producto->name}}" src="{{$item->producto->foto}}"></a>
                                            </div>
                                            <div class="shopping-cart-title">
                                                <h4><a href="{{route('detalles','id='.$item->producto->id.'')}}">{{$item->producto->name}}</a></h4>
                                                <h3><span>{{$item->cantidad}} × </span>${{$whatsapp ? $item->producto->preciocup : $item->producto->preciocup + 0.1 * $item->producto->preciocup}}</h3>
                                            </div>
                                            {{-- <div class="shopping-cart-delete">
                                                <a href="#"><i class="fi-rs-cross-small"></i></a>
                                            </div>
                                        </li>
                                       @endforeach
                                       @endif
                                    </ul>
                                    <div class="shopping-cart-footer">
                                        <div class="shopping-cart-total">
                                            <h4>Total <span>${{$subtotal}}</h4>
                                        </div>
                                        <div class="shopping-cart-button">
                                            <a href="{{route('carrito')}}">Ver carrito</a>
                                            <a href="{{route('caja')}}">Pagar</a>
                                        </div>
                                    </div>
                                </div>
                                @endauth --}}
                            </div>
                            <div class="header-action-icon-2 d-block d-lg-none">
                                <div class="burger-icon burger-icon-white">
                                    <span class="burger-icon-top"></span>
                                    <span class="burger-icon-mid"></span>
                                    <span class="burger-icon-bottom"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
<div class="mobile-header-active mobile-header-wrapper-style">
    <div class="mobile-header-wrapper-inner">
        <div class="mobile-header-top">
            <div class="mobile-header-logo">
                {{-- <a href="{{route('home')}}"><img src="assets/imgs/logo/logo.png" alt="logo"></a> --}}
            </div>
            <div class="mobile-menu-close close-style-wrap close-style-position-inherit">
                <button class="close-style search-close">
                    <i class="icon-top"></i>
                    <i class="icon-bottom"></i>
                </button>
            </div>
        </div>
        <div class="mobile-header-content-area">
            <div class="mobile-search search-style-3 mobile-header-border">

                <form action="{{ route('buscar') }}" method="GET">

                    <input type="text" placeholder="Buscar" name="buscar">

                    <button type="submit"><i class="fi-rs-search"></i></button>
                </form>
            </div>
            <div class="mobile-menu-wrap mobile-header-border">
                <div class="main-categori-wrap mobile-header-border">
                    <a class="categori-button-active-2" href="#">
                        <span class="fi-rs-apps"></span> Categorias
                    </a>

                    <div class="categori-dropdown-wrap categori-dropdown-active-small">
                        <ul>


                            @foreach ($categorias as $categoria)
                                <form action="{{ route('categoria') }}" method="GET">

                                    <input type="hidden" name="buscar" value="{{ $categoria->id }}">

                                    <li><a href=""
                                           onclick="event.preventDefault(); this.closest('form').submit()"><i
                                                class="surfsidemedia-font-dress"></i>{{ $categoria->nombre }}</a>
                                    </li>

                                </form>

                            @endforeach
                            {{--
                      --}}


                        </ul>
                    </div>
                </div>
                <!-- mobile menu start -->
                <nav>
                    <ul class="mobile-menu">
                        <li class="menu-item-has-children"><span class="menu-expand"></span><a
                                href="{{ route('home') }}">Inicio</a></li>
                        <li class="menu-item-has-children"><span class="menu-expand"></span><a
                                href="{{ route('shoping') }}">Comprar</a></li>
                        <li class="menu-item-has-children"><span class="menu-expand"></span><a
                                href="{{ route('pedidos') }}">Mis Pedidos</a></li>
                        @auth
                            @if (Auth::user()->utype == 'ADMIN')
                                <li class="menu-item-has-children"><span class="menu-expand"></span><a
                                        href="{{ route('admin.crear.productos') }}">Agregar Producto</a></li>

                                <li class="menu-item-has-children"><span class="menu-expand"></span><a href="#">Technology</a>
                                    <ul class="dropdown">
                                        <li><a href="product-details.html">Gaming Laptops</a></li>
                                        <li><a href="product-details.html">Ultraslim Laptops</a></li>
                                        <li><a href="product-details.html">Tablets</a></li>
                                        <li><a href="product-details.html">Laptop Accessories</a></li>
                                        <li><a href="product-details.html">Tablet Accessories</a></li>
                                    </ul>
                                </li>
                    </ul>


                    <li class="menu-item-has-children"><span class="menu-expand"></span><a href="#">Language</a>
                        <ul class="dropdown">
                            <li><a href="#">English</a></li>
                            <li><a href="#">French</a></li>
                            <li><a href="#">German</a></li>
                            <li><a href="#">Spanish</a></li>
                        </ul>
                    </li>
                    @endif
                    @endauth
                </nav>
                <!-- mobile menu end -->
            </div>
            <div class="mobile-header-info-wrap mobile-header-border">
                <div class="single-mobile-header-info mt-30">
                    {{-- <a href="" id="instalar"> Sobre Nosotros </a> --}}
                </div>
                <div class="single-mobile-header-info">
                    <a href="{{ route('login') }}">@auth
                            {{ Auth::user()->name }}
                        @else
                            Entrar
                        @endauth </a>
                </div>
                @auth

                    <form action="{{ route('logout') }}" method="post">
                        @csrf
                        <a href="" onclick="event.preventDefault(); this.closest('form').submit()">Salir</a>
                        </li>
                    </form>
                @else
                    <div class="single-mobile-header-info">
                        <a href="{{ route('register') }}">Registrarse</a>
                    </div>
                @endauth
                <div class="single-mobile-header-info">
                    <a href="#">(+53) 54830854 </a>
                </div>
            </div>
            <div class="mobile-social-icon">
                <h5 class="mb-15 text-grey-4">Sigenos</h5>
                <a href="#"><img src="assets/imgs/theme/icons/icon-facebook.svg" alt=""></a>
                <a href="#"><img src="assets/imgs/theme/icons/icon-twitter.svg" alt=""></a>
                <a href="#"><img src="assets/imgs/theme/icons/icon-instagram.svg" alt=""></a>
                <a href="#"><img src="assets/imgs/theme/icons/icon-pinterest.svg" alt=""></a>
                <a href="#"><img src="assets/imgs/theme/icons/icon-youtube.svg" alt=""></a>
            </div>
        </div>
    </div>
</div>
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
