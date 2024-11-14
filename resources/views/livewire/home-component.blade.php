<div>
    <main class="main">


        <section class="home-slider position-relative pt-50">
            <div class="hero-slider-1 dot-style-1 dot-style-1-position-1">
                <div class="single-hero-slider single-animation-wrap">
                    <div class="container">
                        <div class="row align-items-center slider-animated-1">
                            <div class="col-lg-5 col-md-6">
                                <div class="hero-slider-content-2">
                                    <h2 class="animated fw-900" style="color: rgb(4, 5, 4);">Únete a whatsapp</h2>
                                    <h1 class="animated fw-900 text-7" style="color: rgb(58, 169, 84);">10% de
                                        descuento</h1>
                                    {{-- <p class="animated" style="color: black;">En todas tus compras</p> --}}
                                    <p class="animated" style="color: rgb(10, 16, 10);">Que esperas &#128512;</p>
                                    <a class="animated btn btn-brush btn-brush-2" href="{{ route('whatsapp') }}"> Ir
                                        al grupo </a>
                                    {{-- https://chat.whatsapp.com/BhrgFNATbSyBzShazsRVNL   --}}
                                </div>
                            </div>
                            <div class="col-lg-7 col-md-6">
                                <div class="single-slider-img single-slider-img-1">
                                    <img class="animated slider-1-1" src="img/whatsapp.png" alt="">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{--                <div class="single-hero-slider single-animation-wrap">--}}
                {{--                    <div class="container">--}}
                {{--                        <div class="row align-items-center slider-animated-1">--}}
                {{--                            <div class="col-lg-5 col-md-6">--}}
                {{--                                <div class="hero-slider-content-2">--}}
                {{--                                    --}}{{-- <h4 class="animated">Mochilas para niña </h4> --}}
                {{--                                    <h2 class="animated fw-900">Mochilas para niña</h2>--}}
                {{--                                    <h1 class="animated fw-900 text-brand">En buena oferta</h1>--}}
                {{--                                    <p class="animated">Ahorra hasta un 30%</p>--}}
                {{--                                    <a class="animated btn btn-brush btn-brush-3"--}}
                {{--                                        href="{{ route('detalles', 'id=57') }}"> Ir a Comprarlos </a>--}}
                {{--                                </div>--}}
                {{--                            </div>--}}
                {{--                            <div class="col-lg-7 col-md-6">--}}
                {{--                                <div class="single-slider-img single-slider-img-1">--}}
                {{--                                    <img class="animated slider-1-1 " src="{{asset('fotos_productos/13producto1product-10.jpg')}}" alt="">--}}
                {{--                                </div>--}}
                {{--                            </div>--}}
                {{--                        </div>--}}
                {{--                    </div>--}}
                {{--                </div>--}}

                {{--                <div class="single-hero-slider single-animation-wrap">--}}
                {{--                    <div class="container">--}}
                {{--                        <div class="row align-items-center slider-animated-1">--}}
                {{--                            <div class="col-lg-5 col-md-6">--}}
                {{--                                <div class="hero-slider-content-2">--}}
                {{--                                    <h2 class="animated fw-900">Carteras para hombre</h2>--}}
                {{--                                    <h1 class="animated fw-900 text-7">En buena oferta</h1>--}}
                {{--                                    <p class="animated">Ahorra un 20%</p>--}}
                {{--                                    <a class="animated btn btn-brush btn-brush-2"--}}
                {{--                                        href="{{ route('detalles', 'id=56') }}"> Ir a Comprarlos </a>--}}
                {{--                                </div>--}}
                {{--                            </div>--}}
                {{--                            <div class="col-lg-7 col-md-6">--}}
                {{--                                <div class="single-slider-img single-slider-img-1">--}}
                {{--                                    <img class="animated slider-1-1"--}}
                {{--                                        src="fotos_productos/138billeteraImagen de WhatsApp 2023-04-09 a las 21.29.47.jpg"--}}
                {{--                                        alt="">--}}
                {{--                                </div>--}}
                {{--                            </div>--}}
                {{--                        </div>--}}
                {{--                    </div>--}}
                {{--                </div>--}}
            </div>
            <div class="slider-arrow hero-slider-1-arrow"></div>
        </section>
        <section class="popular-categories section-padding mt-15 mb-25">
            <div class="container wow fadeIn animated">
                <h3 class="section-title mb-20"><span>Categorias</span> Populares</h3>
                <div class="carausel-6-columns-cover position-relative">
                    <div class="slider-arrow slider-arrow-2 carausel-6-columns-arrow" id="carausel-6-columns-arrows">
                    </div>
                    <div class="carausel-6-columns" id="carausel-6-columns">
                        <div class="card-1">
                            <figure class=" img-hover-scale overflow-hidden">
                                <form action="{{ route('categoria') }}" method="GET">

                                    <input type="hidden" name="buscar" value="1">

                                    <a onclick="event.preventDefault(); this.closest('form').submit()"><img
                                            src="fotos_productos/141chancletasImagen de WhatsApp 2023-04-09 a las 21.30.15.jpg"
                                            alt=""></a>
                                </form>
                            </figure>
                            <h5><a onclick="event.preventDefault(); this.closest('form').submit()">Calzado</a></h5>


                        </div>
                        <div class="card-1">
                            <figure class=" img-hover-scale overflow-hidden">
                                <form action="{{ route('categoria') }}" method="GET">

                                    <input type="hidden" name="buscar" value="2">

                                    <a onclick="event.preventDefault(); this.closest('form').submit()"><img
                                            src="fotos_productos/138billeteraImagen de WhatsApp 2023-04-09 a las 21.29.47.jpg"
                                            alt=""></a>
                                </form>
                            </figure>
                            <h5><a onclick="event.preventDefault(); this.closest('form').submit()">Accesorios para
                                    vestir</a></h5>


                        </div>
                        <div class="card-1">
                            <figure class=" img-hover-scale overflow-hidden">
                                <form action="{{ route('categoria') }}" method="GET">
                                    <input type="hidden" name="buscar" value="3">
                                    <a onclick="event.preventDefault(); this.closest('form').submit()"><img
                                            src="https://th.bing.com/th?q=Alimentos+Para+Prevenir+La+Anemia&w=120&h=120&c=1&rs=1&qlt=90&cb=1&dpr=1.4&pid=InlineBlock&mkt=es-ES&cc=ES&setlang=es&adlt=moderate&t=1&mw=247"
                                            alt=""></a>
                                </form>
                            </figure>
                            <h5><a onclick="event.preventDefault(); this.closest('form').submit()">Alimentos</a></h5>
                        </div>
                        <div class="card-1">
                            <figure class=" img-hover-scale overflow-hidden">
                                <form action="{{ route('categoria') }}" method="GET">
                                    <input type="hidden" name="buscar" value="4">
                                    <a href="{{ route('home') }}"><img
                                            src="https://th.bing.com/th/id/OIP.GxPD69xp-wjvXKKjAza57AHaF3?w=208&h=180&c=7&r=0&o=5&dpr=1.4&pid=1.7"
                                            alt=""></a>
                                </form>
                            </figure>
                            <h5><a href="{{ route('home') }}">Ferreteria (Proximamente)</a></h5>
                        </div>
                        <div class="card-1">
                            <figure class=" img-hover-scale overflow-hidden">
                                <form action="{{ route('categoria') }}" method="GET">
                                    <input type="hidden" name="buscar" value="5">
                                    <a href="{{ route('home') }}"><img
                                            src="https://th.bing.com/th/id/OIP.d-W0_QyS0XcF-qAO522WVQHaHW?w=183&h=183&c=7&r=0&o=5&dpr=1.4&pid=1.7"
                                            alt=""></a>
                                </form>
                            </figure>
                            <h5><a href="{{ route('home') }}">Articulos para fiestas (Proximamente)</a></h5>
                        </div>

                    </div>
                </div>
            </div>
        </section>

        <section class="featured section-padding position-relative" id="featured">
            <div class="container">
                <div class="row">
                    <div class="col-lg-2 col-md-4 mb-md-3 mb-lg-0">
                        <div class="banner-features wow fadeIn animated hover-up">
                            <img src="assets/imgs/theme/icons/feature-1.png" alt="">
                            <h4 class="bg-1">Free Shipping</h4>
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-4 mb-md-3 mb-lg-0">
                        <div class="banner-features wow fadeIn animated hover-up">
                            <img src="assets/imgs/theme/icons/feature-2.png" alt="">
                            <h4 class="bg-3">Online Order</h4>
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-4 mb-md-3 mb-lg-0">
                        <div class="banner-features wow fadeIn animated hover-up">
                            <img src="assets/imgs/theme/icons/feature-3.png" alt="">
                            <h4 class="bg-2">Save Money</h4>
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-4 mb-md-3 mb-lg-0">
                        <div class="banner-features wow fadeIn animated hover-up">
                            <img src="assets/imgs/theme/icons/feature-4.png" alt="">
                            <h4 class="bg-4">Promotions</h4>
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-4 mb-md-3 mb-lg-0">
                        <div class="banner-features wow fadeIn animated hover-up">
                            <img src="assets/imgs/theme/icons/feature-5.png" alt="">
                            <h4 class="bg-5">Happy Sell</h4>
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-4 mb-md-3 mb-lg-0">
                        <div class="banner-features wow fadeIn animated hover-up">
                            <img src="assets/imgs/theme/icons/feature-6.png" alt="">
                            <h4 class="bg-6">24/7 Support</h4>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="product-tabs section-padding position-relative wow fadeIn animated">
            {{-- <div class="bg-square"></div> --}}
            <div class="container">
                <div class="tab-header">
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="nav-tab-one" data-bs-toggle="tab"
                                    data-bs-target="#tab-one" type="button" role="tab" aria-controls="tab-one"
                                    aria-selected="true">Buenas ofertas
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="nav-tab-two" data-bs-toggle="tab" data-bs-target="#tab-two"
                                    type="button" role="tab" aria-controls="tab-two"
                                    aria-selected="false">Recientes
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            {{-- <button class="nav-link" id="nav-tab-three" data-bs-toggle="tab" data-bs-target="#tab-three" type="button" role="tab" aria-controls="tab-three" aria-selected="false"></button> --}}
                        </li>
                    </ul>
                    <a href="{{ route('shoping') }}" class="view-more d-none d-md-flex">Ver mas<i
                            class="fi-rs-angle-double-small-right"></i></a>
                </div>
                <!--End nav-tabs-->
                <div class="tab-content wow fadeIn animated" id="myTabContent">
                    <div class="tab-pane fade show active" id="tab-one" role="tabpanel" aria-labelledby="tab-one">
                        <div class="row product-grid-4">


                            @foreach ($productos_populares as $producto)
                                @if ($producto->preciocup != 0)
                                    @php
                                        $micro = date('u');
                                    @endphp
                                    <div class="col-lg-3 col-md-4 col-sm-6 col-xs-6 col-6">
                                        <div class="product-cart-wrap mb-30">
                                            <div class="product-img-action-wrap">
                                                <div class="product-img product-img-zoom">
                                                    <a href="{{ route('detalles', 'id=' . $producto->id . '') }}">

                                                        <img class="default-img" src="{{ $producto->foto }}"
                                                             alt="">
                                                        <img class="hover-img" src="{{ $producto->foto_2 }}"
                                                             alt="">
                                                    </a>
                                                </div>

                                                <div class="product-badges product-badges-position product-badges-mrg">
                                                    <span class="hot">{{$producto->vendedor->nombre}}</span>
                                                </div>
                                            </div>
                                            <div class="product-content-wrap">
                                                <div class="product-category">
                                                    <a
                                                        href="{{ route('shoping') }}">{{ $producto->categoria->nombre }}</a>
                                                </div>
                                                <h2><a
                                                        href="{{ route('detalles', 'id=' . $producto->id . '') }}">{{ $producto->nombre }}</a>
                                                </h2>
                                                <div class="rating-result" title="{{ $producto->valoracion }}%">
                                                <span>
                                                    <span>{{ $producto->valoracion }}</span>
                                                </span>
                                                </div>
                                                <div class="product-price">
                                                <span>${{ $whatsapp ? $producto->preciocup : $producto->preciocup + 0.1 * $producto->preciocup }}
                                                </span>

                                                    @if ($whatsapp != null)
                                                        <span
                                                            class="old-price">${{ $producto->preciocup + 0.1 * $producto->preciocup }}</span>
                                                    @endif
                                                    {{-- <img src="https://th.bing.com/th?id=OIP.TwESrblIhpd2D8XG5VDz5QHaHa&w=250&h=250&c=8&rs=1&qlt=90&o=6&dpr=1.4&pid=3.1&rm=2" width=“16” y height=“16” alt="whatsapp"> --}}
                                                </div>
                                                <div class="product-action-1 show">

                                                    @auth

                                                        <form action="{{ route('agregar_carrito') }}" method="POST"
                                                              name="addcart{{ Auth::user()->id * 324 * $producto->id + 50 * $producto->cant * $micro * 2 }}">
                                                            @csrf
                                                            <input type="hidden" value="{{ Auth::user()->id }}"
                                                                   name="uid">
                                                            <input type="hidden" value="{{ $producto->id }}"
                                                                   name="pid">
                                                            <input type="hidden" value="1" name="cant">

                                                        </form>
                                                        {{-- <a aria-label="Agregar al Carrito" class="action-btn hover-up"  href="javascript:document.addcart{{Auth::user()->id*324*$producto->id+50*$producto->cant*$micro*2}}.submit()"><i class="fi-rs-shopping-bag-add"></i></a> --}}
                                                        <a aria-label="Agregar al Carrito" class="action-btn hover-up"
                                                           href="#"
                                                           wire:click.prevent="agregar_carrito({{ $producto->id }},1)"><i
                                                                class="fi-rs-shopping-bag-add"></i></a>
                                                    @else
                                                        <a aria-label="Agregar al Carrito" class="action-btn hover-up"
                                                           href="{{ route('login') }}"><i
                                                                class="fi-rs-shopping-bag-add"></i></a>
                                                    @endauth
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            @endforeach
                        </div>

                        <!--End product-grid-4-->
                    </div>
                    <!--En tab one (Featured)-->
                    <div class="tab-pane fade" id="tab-two" role="tabpanel" aria-labelledby="tab-two">
                        <div class="row product-grid-4">
                            @foreach ($productos_nuevos as $producto)
                                @if ($producto->preciocup != 0)
                                    @php
                                        $micro = date('u');
                                    @endphp

                                    {{-- @auth


     <form action="{{route('agregar_carrito')}}" method="POST" name="addcart{{Auth::user()->id*324*$producto->id+50*$producto->cant*$micro*2}}">
      @csrf
      <input type="hidden" value="{{Auth::user()->id}}" name="uid">
      <input type="hidden" value="{{$producto->id}}" name="pid">
      <input type="hidden" value="1" name="cant">
      @endauth
    </form> --}}
                                    <div class="col-lg-3 col-md-4 col-sm-6 col-xs-6 col-6">
                                        <div class="product-cart-wrap mb-30">
                                            <div class="product-img-action-wrap">
                                                <div class="product-img product-img-zoom">
                                                    <a href="{{ route('detalles', 'id=' . $producto->id . '') }}">

                                                        <img class="default-img" src="{{ $producto->foto }}"
                                                             alt="">
                                                        @if ($producto->foto_2 != null)
                                                            <img class="hover-img" src="{{ $producto->foto_2 }}"
                                                                 alt="">
                                                        @else
                                                            <img class="hover-img" src="{{ $producto->foto }}"
                                                                 alt="">
                                                        @endif

                                                    </a>
                                                </div>
                                                {{--   <div class="product-action-1">
                                                 <a aria-label="Quick view" class="action-btn hover-up" data-bs-toggle="modal" data-bs-target="#quickViewModal"><i class="fi-rs-eye"></i></a>
                                                <a aria-label="Add To Wishlist" class="action-btn hover-up" href="wishlist.php"><i class="fi-rs-heart"></i></a>
                                                <a aria-label="Compare" class="action-btn hover-up" href="compare.php"><i class="fi-rs-shuffle"></i></a> --}}
                                                {{-- </div> --}}
                                                <div class="product-badges product-badges-position product-badges-mrg">
                                                    <span class="hot">Producto nuestro</span>
                                                </div>
                                            </div>
                                            <div class="product-content-wrap">
                                                <div class="product-category">
                                                    <a
                                                        href="{{ route('shoping') }}">{{ $producto->categoria->nombre }}</a>
                                                </div>
                                                <h2><a
                                                        href="{{ route('detalles', 'id=' . $producto->id . '') }}">{{ $producto->nombre }}</a>
                                                </h2>
                                                <div class="rating-result" title="{{ $producto->valoracion }}">
                                                <span>
                                                    <span>{{ $producto->valoracion }}</span>
                                                </span>
                                                </div>
                                                <div class="product-price">
                                                <span>${{ $whatsapp ? $producto->preciocup : $producto->preciocup + 0.1 * $producto->preciocup }}
                                                </span>
                                                    @if ($whatsapp != null)
                                                        <span
                                                            class="old-price">${{ $producto->preciocup + 0.1 * $producto->preciocup }}</span>
                                                    @endif
                                                </div>
                                                <div class="product-action-1 show">

                                                    @auth

                                                        <form action="{{ route('agregar_carrito') }}" method="POST"
                                                              name="addcart{{ Auth::user()->id * 324 * $producto->id + 50 * $producto->cant * $micro * 2 }}">
                                                            @csrf
                                                            <input type="hidden" value="{{ Auth::user()->id }}"
                                                                   name="uid">
                                                            <input type="hidden" value="{{ $producto->id }}"
                                                                   name="pid">
                                                            <input type="hidden" value="1" name="cant">

                                                        </form>
                                                        {{-- <a aria-label="Agregar al Carrito" class="action-btn hover-up"  href="javascript:document.addcart{{Auth::user()->id*324*$producto->id+50*$producto->cant*$micro*2}}.submit()"><i class="fi-rs-shopping-bag-add"></i></a> --}}
                                                        <a aria-label="Agregar al Carrito" class="action-btn hover-up"
                                                           href="#"
                                                           wire:click.prevent="agregar_carrito({{ $producto->id }},1)"><i
                                                                class="fi-rs-shopping-bag-add"></i></a>
                                                    @else
                                                        <a aria-label="Agregar al Carrito" class="action-btn hover-up"
                                                           href="{{ route('login') }}"><i
                                                                class="fi-rs-shopping-bag-add"></i></a>
                                                    @endauth
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            @endforeach

                        </div>
                        <!--End product-grid-4-->
                    </div>
                    <!--En tab two (Popular)-->

                    <!--En tab three (New added)-->
                </div>
                <!--End tab-content-->
            </div>
        </section>
         <section class="banner-2 section-padding pb-0">
            <div class="container">
                <div class="banner-img banner-big wow fadeIn animated f-none">
                    <img src="assets/imgs/banner/banner-4.png" alt="">
                    <div class="banner-text d-md-block d-none">
                        <h4 class="mb-15 mt-40 text-brand"></h4>
                        <h1 class="fw-600 mb-20">Aqui nos hace falta disenar algo <br></h1>
                        <a href="{{route('shoping')}}" class="btn">Leer mas <i class="fi-rs-arrow-right"></i></a>
                    </div>
                </div>
            </div>
        </section>

        <section class="banners mb-15">
            <div class="container">
                <div class="row">
                    <div class="col-lg-4 col-md-6">
                        <div class="banner-img wow fadeIn animated">
                            <img src="assets/imgs/banner/banner-1.png" alt="">
                            <div class="banner-text">
                                <span>Smart Offer</span>
                                <h4>Save 20% on <br>Woman Bag</h4>
                                <a href="{{route('shoping')}}">Shop Now <i class="fi-rs-arrow-right"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6">
                        <div class="banner-img wow fadeIn animated">
                            <img src="assets/imgs/banner/banner-2.png" alt="">
                            <div class="banner-text">
                                <span>Sale off</span>
                                <h4>Great Summer <br>Collection</h4>
                                <a href="{{route('shoping')}}">Shop Now <i class="fi-rs-arrow-right"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 d-md-none d-lg-flex">
                        <div class="banner-img wow fadeIn animated  mb-sm-0">
                            <img src="assets/imgs/banner/banner-3.png" alt="">
                            <div class="banner-text">
                                <span>New Arrivals</span>
                                <h4>Shop Today’s <br>Deals & Offers</h4>
                                <a href="{{route('shoping')}}">Shop Now <i class="fi-rs-arrow-right"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="section-padding">
            <div class="container wow fadeIn animated">
                <h3 class="section-title mb-20"><span>Productos</span> en Liquidacion</h3>
                <div class="carausel-6-columns-cover position-relative">
                    <div class="slider-arrow slider-arrow-2 carausel-6-columns-arrow"
                         id="carausel-6-columns-2-arrows"></div>
                    <div class="carausel-6-columns carausel-arrow-center" id="carausel-6-columns-2">
                        @foreach ($productos_baratos as $producto)
                            @if ($producto->preciocup != 0)
                                <div class="product-cart-wrap small hover-up">
                                    <div class="product-img-action-wrap">
                                        <div class="product-img product-img-zoom">
                                            <a href="{{ route('detalles', 'id=' . $producto->id . '') }}">
                                                <img class="default-img" src="{{ $producto->foto }}" alt="">
                                                <img class="hover-img" src="{{ $producto->foto }}" alt="">
                                            </a>
                                        </div>

                                        <div class="product-badges product-badges-position product-badges-mrg">
                                            <span class="hot">Oferta</span>
                                        </div>
                                    </div>
                                    <div class="product-content-wrap">
                                        <h2><a
                                                href="{{ route('detalles', 'id=' . $producto->id . '') }}">{{ $producto->nombre }}</a>
                                        </h2>
                                        {{-- <div class="rating-result" title="90%">
                                                                <span>
                                                                </span>
                                                            </div> --}}
                                        <div class="product-price">
                                        <span>{{ $whatsapp ? $producto->preciocup : $producto->preciocup + 0.1 * $producto->preciocup }}
                                        </span>
                                            @if ($whatsapp != null)
                                                <span
                                                    class="old-price">${{ $producto->preciocup + 0.1 * $producto->preciocup }}</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            @endif
                        @endforeach
                        <!--End product-cart-wrap-2-->

                        <!--End product-cart-wrap-2-->
                    </div>
                </div>
            </div>
        </section>

        <livewire:generar-pdf />

        {{-- <section class="section-padding">
            <div class="container">
                <h3 class="section-title mb-20 wow fadeIn animated"><span>Featured</span> Brands</h3>
                <div class="carausel-6-columns-cover position-relative wow fadeIn animated">
                    <div class="slider-arrow slider-arrow-2 carausel-6-columns-arrow" id="carausel-6-columns-3-arrows"></div>
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
        {{-- <div style="padding: 15%">
        <form action="{{route('gpt')}}" method="post">
            @csrf
            <textarea name="chat"  cols="30" rows="10" placeholder="chatgpt papu"></textarea>
            <button type="submit">Enviar</button>
        </form>
        <h4 style="margin-top: 20px">{{$_COOKIE['gpt']}}</h4>
    </div> --}}
    </main>
</div>
