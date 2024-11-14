<div class="header-action-icon-2">
    <a class="mini-cart-icon" href="{{ route('carrito') }}">
        <img alt="Surfside Media" src="{{asset('assets/imgs/theme/icons/icon-cart.svg')}}">
        <span class="pro-count blue">{{ $cartCount }}</span>
    </a>
    <div class="cart-dropdown-wrap cart-dropdown-hm2">
        <ul>
            @auth
                @forelse ($cartItems as $item)
                    <li>
                        <div class="shopping-cart-img">
                            <a href="{{ route('detalles', ['id' => $item->producto->id]) }}">
                                <img alt="" src="{{$item->producto->foto}}">
                            </a>
                        </div>
                        <div class="shopping-cart-title">
                            <h4>
                                <a href="{{ route('detalles', ['id' => $item->producto->id]) }}">
                                    {{ $item->producto->name }}
                                </a>
                            </h4>
                            <h4>
                                <span>{{ $item->cantidad }} × </span>
                                ${{ $whatsapp ? $item->producto->preciocup : $item->producto->preciocup + 0.1 * $item->producto->preciocup }}
                            </h4>
                        </div>
                        <div class="shopping-cart-delete">
                            <a href="#" wire:click.prevent="removeFromCart({{ $item->id }})">
                                <i class="fi-rs-cross-small"></i>
                            </a>
                        </div>
                    </li>
                @empty
                    <li class="text-center py-4">
                        <span>No hay productos en el carrito</span>
                    </li>
                @endforelse
            @else
                <li class="text-center py-4">
                    <span>Inicie sesión para ver su carrito</span>
                </li>
            @endauth
        </ul>

        <div class="shopping-cart-footer">
            <div class="shopping-cart-total">
                <h4>Total <span>${{ number_format($subtotal, 2) }}</span></h4>
            </div>
            <div class="shopping-cart-button">
                <a href="{{ route('carrito') }}" class="outline">Ver Carrito</a>
                @auth
                    @if($cartCount > 0)
                        <a href="{{ route('mapa') }}">Pagar</a>
                    @endif
                @endauth
            </div>
        </div>
    </div>
</div>
