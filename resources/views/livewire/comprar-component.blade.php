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
                                    <livewire:product-card :producto="$producto" :whatsapp="$whatsapp"
                                                           :key="$producto->id"/>
                                @endforeach
                            @endif



                        </div>
                        <!--pagination-->
                        <div >

                            {{ $productos->links() }}

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
