<div>
    <p class="mobile-promotion">Unete <span class="text-brand">a nuestro grupo en Whatsapp</span>
        y obten descuento de 10% en todas las compras</p>
    <div class="header-action-right d-block d-lg-none">
        <div class="header-action-2">
            <div class="header-action-icon-2">
                {{--                                --}}{{-- <a href="shop-wishlist.php">--}}
                {{--                                    <img alt="Surfside Media" src="assets/imgs/theme/icons/icon-heart.svg">--}}
                {{--                                    <span class="pro-count white">4</span>--}}
                {{--                                </a> --}}


            </div>
            <div class="header-action-icon-2">
                <a class="mini-cart-icon" href="{{ route('carrito') }}">
                    <img alt="" src="assets/imgs/theme/icons/icon-cart.svg">

                    <span class="pro-count white">
                                        @auth
                            {{ $cartCount }}
                        @else
                            0
                        @endauth
                                    </span>
                </a>
                @auth
                    <div class="cart-dropdown-wrap cart-dropdown-hm2">
                        <ul>


                            @forelse($cartItems as $item)
                                <li>
                                    <div class="shopping-cart-img">
                                        <a href="{{ route('detalles', ['id' => $item->producto->id]) }}"><img
                                                alt="{{$item->producto->name}}" src="{{$item->producto->foto}}"></a>
                                    </div>
                                    <div class="shopping-cart-title">
                                        <h4>
                                            <a href="{{ route('detalles', ['id' => $item->producto->id]) }}">{{$item->producto->name}}</a>
                                        </h4>
                                        <h3>
                                            <span>{{ $item->cantidad }} × </span>
                                            ${{ $whatsapp ? $item->producto->preciocup : $item->producto->preciocup + 0.1 * $item->producto->preciocup }}
                                        </h3>
                                    </div>
                                    <div class="shopping-cart-delete">
                                        <a href="#" wire:click.prevent="removeFromCart({{ $item->id }})"><i
                                                class="fi-rs-cross-small"></i></a>
                                    </div>
                                </li>
                            @empty
                                <li class="text-center py-4">
                                    <span>No hay productos en el carrito</span>
                                </li>
                            @endforelse

                        </ul>
                        <div class="shopping-cart-footer">
                            <div class="shopping-cart-total">
                                <h4>Total <span>${{$subtotal}}</h4>
                            </div>
                            <div class="shopping-cart-button">
                                <a href="{{route('carrito')}}">Ver carrito</a>
                                <a href="{{route('mapa')}}">Pagar</a>
                            </div>
                        </div>
                    </div>
                @endauth
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
