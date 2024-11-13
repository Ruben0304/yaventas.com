@php

    use App\Models\Whatsapp;

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
<div>

    <main class="main">
        <div class="page-header breadcrumb-wrap">
            <div class="container">
                <div class="breadcrumb">
                    <a href="{{ route('home') }}" rel="nofollow">Incio</a>
                    <span></span> Comprar
                </div>
            </div>
        </div>
        <section class="mt-50 mb-50">
            <div class="container">
                <div class="row">
                    <div class="col-lg-9">
                        <div class="shop-product-fillter">
                            <div class="totall-product">
                                <p>Resultados</p>
                            </div>
                            <div class="sort-by-product-area">

                                <div class="sort-by-cover">
                                    <div class="sort-by-product-wrap">
                                        <div class="sort-by">
                                            <span><i class="fi-rs-apps-sort"></i>Ordenar por:</span>
                                        </div>
                                        <div class="sort-by-dropdown-wrap">
                                            <span> Filtros <i class="fi-rs-angle-small-down"></i></span>
                                        </div>
                                    </div>
                                    <div class="sort-by-dropdown">
                                        <ul>
                                            <li><a class="{{ $orderBy == '' ? 'active' : 'Default' }}" href="#"
                                                    wire:click.prevent="cambiar_orden('Default')">Todos</a></li>
                                            <li><a class="{{ $orderBy == '' ? 'active' : 'Precio: Menor a Mayor' }}"
                                                    href="#"
                                                    wire:click.prevent="cambiar_orden('Precio: Menor a Mayor')">Precio:
                                                    Menor a Mayor</a></li>
                                            <li><a class="{{ $orderBy == '' ? 'active' : 'Precio: Mayor a Menor' }}"
                                                    href="#"
                                                    wire:click.prevent="cambiar_orden('Precio: Mayor a Menor')">Precio:
                                                    Mayor a Menor</a></li>
                                            <li><a class="{{ $orderBy == '' ? 'active' : 'Ultimos productos' }}"
                                                    href="#"
                                                    wire:click.prevent="cambiar_orden('Ultimos productos')">Más
                                                    recientes</a></li>

                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row product-grid-3">
                            @if ($productos->first() == null)
                                <h1>Nada por el momento</h1>
                            @else
                                @foreach ($productos as $producto)
                                    <div class="col-lg-4 col-md-4 col-6 col-sm-6">
                                        <div class="product-cart-wrap mb-30">
                                            <div class="product-img-action-wrap">
                                                <div class="product-img product-img-zoom">
                                                    <a href="{{ route('detalles', 'id=' . $producto->id . '') }}">
                                                        <img class="default-img" src="{{ $producto->foto }}"
                                                            alt="">
                                                        {{-- <img class="hover-img" src="{{$producto->foto_1}}" alt=""> --}}
                                                    </a>
                                                </div>
                                                <div class="product-action-1">
                                                    {{-- <a aria-label="Quick view" class="action-btn hover-up" data-bs-toggle="modal" data-bs-target="#quickViewModal">
                                                <i class="fi-rs-search"></i></a>
                                            <a aria-label="Agregar al deseos" class="action-btn hover-up" href="wishlist.php"><i class="fi-rs-heart"></i></a> --}}
                                                    {{-- <a aria-label="Agregar al Carrito" class="action-btn hover-up" href="{{route('detalles','id='.$producto->id.'')}}"><i class="fi-rs-shuffle"></i></a> --}}
                                                </div>
                                                {{-- <div class="product-badges product-badges-position product-badges-mrg">
                                            <span class="hot">Hot</span>
                                        </div> --}}
                                            </div>
                                            <div class="product-content-wrap">
                                                <div class="product-category">
                                                    <a
                                                        href="{{ route('shoping') }}">{{ $producto->categoria->nombre }}</a>
                                                </div>
                                                <h2><a
                                                        href="{{ route('detalles', 'id=' . $producto->id . '') }}">{{ $producto->nombre }}</a>
                                                </h2>
                                                {{-- <div class="rating-result" title="{{ $producto->valoracion }}%">
                                                    <span>
                                                        <span>{{ $producto->valoracion }}</span>
                                                    </span>
                                                </div> --}}
                                                <br>
                                                <div class="product-price">
                                                    <span>$
                                                        {{ $whatsapp ? $producto->preciocup : $producto->preciocup + 0.1 * $producto->preciocup }}
                                                    </span>
                                                    {{-- <span class="old-price">$245.8</span> --}}
                                                </div>
                                                <div class="product-action-1 show">
                                                    @auth
                                                        @php
                                                            $micro = date('u');
                                                        @endphp

                                                        <form action="{{ route('agregar_carrito') }}" method="POST"
                                                            name="addcart{{ Auth::user()->id * 324 * $producto->id + 50 * $producto->cant * $micro * 2 }}">
                                                            @csrf
                                                            <input type="hidden" value="{{ Auth::user()->id }}"
                                                                name="uid">
                                                            <input type="hidden" value="{{ $producto->id }}"
                                                                name="pid">
                                                            <input type="hidden" value="1" name="cant">

                                                        </form>
                                                        <a aria-label="Agregar al Carrito" class="action-btn hover-up"
                                                            href="javascript:document.addcart{{ Auth::user()->id * 324 * $producto->id + 50 * $producto->cant * $micro * 2 }}.submit()"><i
                                                                class="fi-rs-shopping-bag-add"></i></a>
                                                        @if (Auth::user()->utype == 'ADMIN')
                                                            <a aria-label="Editar" class="action-btn hover-up"
                                                                href="admin/editar_productos?id={{ $producto->id }}"><i
                                                                    class="fi-rs-edit"></i></a>
                                                        @endif
                                                    @else
                                                        <a aria-label="Agregar al Carrito" class="action-btn hover-up"
                                                            href="{{ route('login') }}"><i
                                                                class="fi-rs-shopping-bag-add"></i></a>

                                                    @endauth

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            @endif



                        </div>
                        <!--pagination-->
                        <div class="pagination-area mt-15 mb-sm-5 mb-lg-0">

                            {{ $productos->links() }}



                            {{-- <nav aria-label="Page navigation example">
                                <ul class="pagination justify-content-start">
                                    <li class="page-item active"><a class="page-link" href="#">01</a></li>
                                    <li class="page-item"><a class="page-link" href="#">02</a></li>
                                    <li class="page-item"><a class="page-link" href="#">03</a></li>
                                    <li class="page-item"><a class="page-link dot" href="#">...</a></li>
                                    <li class="page-item"><a class="page-link" href="#">16</a></li>
                                    <li class="page-item"><a class="page-link" href="#"><i class="fi-rs-angle-double-small-right"></i></a></li>
                                </ul>
                            </nav> --}}
                        </div>
                    </div>
                    <div class="col-lg-3 primary-sidebar sticky-sidebar">
                        <div class="row">
                            <div class="col-lg-12 col-mg-6"></div>
                            <div class="col-lg-12 col-mg-6"></div>
                        </div>
                        <div class="widget-category mb-30">
                            <h5 class="section-title style-1 mb-30 wow fadeIn animated">Categorias</h5>
                            <ul class="categories">
                                @foreach ($categorias as $categoria)
                                    <form action="{{ route('categoria') }}" method="GET">

                                        <input type="hidden" name="buscar" value="{{ $categoria->id }}">


                                        <li><a
                                                onclick="event.preventDefault(); this.closest('form').submit()">{{ $categoria->nombre }}</a>
                                        </li>
                                    </form>
                                @endforeach

                            </ul>
                        </div>
                        <!-- Fillter By Price -->
                        <div class="sidebar-widget price_range range mb-30">
                            <div class="widget-header position-relative mb-20 pb-10">
                                <h5 class="widget-title mb-10">Filtrar por precio</h5>
                                <div class="bt-1 border-color-1"></div>
                            </div>
                            <div class="price-filter">
                                <div class="price-filter-inner">
                                    <div id="slider-range" wire:ignore></div>
                                    <div class="price_slider_amount">
                                        <div class="label-input">
                                            <span>Rango:</span> <span class="text-info">${{ $minimo }}</span> -
                                            <span class="text-info">${{ $maximo }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            {{-- <div class="list-group">
                                <div class="list-group-item mb-10 mt-10">

                                    <label class="fw-900 mt-15">Condicion</label>
                                    <div class="custome-checkbox">
                                        <input class="form-check-input" type="checkbox" name="checkbox" id="exampleCheckbox11" value="">
                                        <label class="form-check-label" for="exampleCheckbox11"><span>Nuevo ()</span></label>
                                        <br>
                                        <input class="form-check-input" type="checkbox" name="checkbox" id="exampleCheckbox21" value="">
                                        <label class="form-check-label" for="exampleCheckbox21"><span>De Uso ()</span></label>
                                        <br>

                                    </div>
                                </div>
                            </div> --}}
                            {{-- <a href="{{route('shoping')}}" class="btn btn-sm btn-default"><i class="fi-rs-filter mr-5"></i> Filtrar</a> --}}
                        </div>
                        <!-- Product sidebar Widget -->
                        <div class="sidebar-widget product-sidebar  mb-30 p-30 bg-grey border-radius-10">
                            <div class="widget-header position-relative mb-20 pb-10">
                                <h5 class="widget-title mb-10">Nuevos productos</h5>
                                <div class="bt-1 border-color-1"></div>
                            </div>
                            @foreach ($productos->take(4) as $producto)
                                @if ($producto->preciocup != 0)
                                    <div class="single-post clearfix">
                                        <div class="image">
                                            <img src="{{ $producto->foto }}" alt="#">
                                        </div>
                                        <div class="content pt-10">
                                            <h5><a
                                                    href="{{ route('detalles', 'id=' . $producto->id . '') }}">{{ $producto->nombre }}</a>
                                            </h5>
                                            <p class="price mb-0 mt-5">
                                                ${{ $whatsapp ? $producto->preciocup : $producto->preciocup + 0.1 * $producto->preciocup }}
                                            </p>
                                            <div class="product-rate">
                                                <div class="product-rating" style="width:90%"></div>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            @endforeach

                        </div>
                        {{-- <div class="banner-img wow fadeIn mb-45 animated d-lg-block d-none">
                            <img src="assets/imgs/banner/banner-11.jpg" alt="">
                            <div class="banner-text">
                                <span>Women Zone</span>
                                <h4>Save 17% on <br>Office Dress</h4>
                                <a href="{{route('shoping')}}">Shop Now <i class="fi-rs-arrow-right"></i></a>
                            </div>
                        </div> --}}
                    </div>
                </div>
            </div>
        </section>
    </main>
</div>

@push('scripts')
    <script>
        var sliderrange = $('#slider-range');
        var amountprice = $('#amount');
        $(function() {
            sliderrange.slider({
                range: true,
                min: 0,
                max: 5000,
                values: [0, 5000],
                slide: function(event, ui) {
                    @this.set('minimo', ui.values[0]);
                    @this.set('maximo', ui.values[1]);
                }
            });
        });
    </script>
@endpush
