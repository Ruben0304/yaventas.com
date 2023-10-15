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
                    <a href="{{ route('home') }}" rel="nofollow">Inicio</a>
                    <span></span> <a href="{{ route('shoping') }}">Comprar</a>
                    <span></span> Carrito
                </div>
            </div>
        </div>
        <section class="mt-50 mb-50">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="table-responsive">
                            <table class="table shopping-summery text-center clean">
                                <thead>
                                    <tr class="main-heading">
                                        <th scope="col">Imagen</th>
                                        <th scope="col">Nombre</th>
                                        <th scope="col">Precio</th>
                                        <th scope="col">Cantidad</th>
                                        <th scope="col">Subtotal</th>
                                        <th scope="col">Eliminar</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php $carritos= $carrito->where('id_user',Auth::user()->id) @endphp
                                    @php $subtotal=0 @endphp
                                    @if ($carritos->first() == null)
                                    @else
                            
                                        @foreach ($carritos as $item)
                                            <form action=" {{ route('quitar_carrito') }} "
                                                name="quitarcarrito{{ 2 * 34 + 345 * $item->id_user * $item->id }}"
                                                method="POST">
                                                @csrf
                                                <input type="hidden" value="{{ $item->id }}" name="id">

                                            </form>

                                            <form action=" {{ route('limpiar_carrito') }} " name="limpiar_carrito"
                                                method="POST">
                                                @csrf
                                            </form>
                                            <tr>
                                                <td class="image product-thumbnail"><img
                                                        src="{{ $item->producto->foto }}"
                                                        alt="{{ $item->producto->nombre }}"></td>
                                                <td class="product-des product-name">
                                                    <h5 class="product-name"><a
                                                            href="{{ route('detalles', '' . $item->producto->id . '') }}">{{ $item->producto->nombre }}</a>
                                                    </h5>
                                                </td>
                                                <td class="price" data-title="Precio">
                                                    <span>${{ $whatsapp ? $item->producto->preciocup : $item->producto->preciocup + 0.1 * $item->producto->preciocup }}</span>
                                                </td>
                                                <td class="text-center" data-title="Cantidad">
                                                    <div class="detail-qty border radius  m-auto">
                                                        <a href="#"
                                                            wire:click.prevent="restar_carrito('{{ $item->id }}')"
                                                            class="qty-down"><i class="fi-rs-angle-small-down"></i></a>
                                                        <span class="qty-val">{{ $item->cantidad }}</span>
                                                        <a href="#"
                                                            wire:click.prevent="sumar_carrito('{{ $item->id }}')"
                                                            class="qty-up"><i class="fi-rs-angle-small-up"></i></a>
                                                    </div>
                                                </td>
                                                <td class="text-right" data-title="Carrito">
                                                    <span>${{ ($whatsapp ? $item->producto->preciocup : $item->producto->preciocup + 0.1 * $item->producto->preciocup) * $item->cantidad }}
                                                    </span>
                                                </td>
                                                <td class="action" data-title="Eliminar"><a href="#"
                                                        wire:click.prevent="quitar_carrito('{{ $item->id }}')"
                                                        class="text-muted"><i class="fi-rs-trash"></i></a></td>
                                            </tr>
                                            @php
                                                $subtotal += ($whatsapp ? $item->producto->preciocup : $item->producto->preciocup + 0.1 * $item->producto->preciocup) * $item->cantidad;
                                            @endphp
                                        @endforeach
                                        {{-- Total --}}

                                    @endif
                                    <tr>
                                        <td colspan="6" class="text-end">
                                            @auth
                                                <a href="#"
                                                    wire:click.prevent="limpiar_carrito('{{ Auth::user()->id }}')"
                                                    class="text-muted"> <i class="fi-rs-cross-small"></i> Limpiar
                                                    carrito</a>
                                            @else
                                                <a href="#" class="text-muted"> <i class="fi-rs-cross-small"></i>
                                                    Limpiar carrito</a>
                                            @endauth

                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="cart-action text-end">

                            <a class="btn " href="{{ route('shoping') }}"><i
                                    class="fi-rs-shopping-bag mr-10"></i>Volver a la tienda</a>
                        </div>
                        <div class="divider center_icon mt-50 mb-50"><i class="fi-rs-money"></i></div>
                        <div class="row mb-50">
                            {{-- <div class="col-lg-6 col-md-12">
                                <div class="heading_s1 mb-3">
                                    <h4>Calculate Shipping</h4>
                                </div>
                                <p class="mt-15 mb-30">Flat rate: <span class="font-xl text-brand fw-900">5%</span></p> --}}
                            {{-- <form class="field_form shipping_calculator">
                                    <div class="form-row">
                                        <div class="form-group col-lg-12">
                                            <div class="custom_select">
                                                <select class="form-control select-active">
                                                   
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-row row">
                                        <div class="form-group col-lg-6">
                                            <input required="required" placeholder="State / Country" name="name" type="text">
                                        </div>
                                        <div class="form-group col-lg-6">
                                            <input required="required" placeholder="PostCode / ZIP" name="name" type="text">
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-lg-12">
                                            <button class="btn  btn-sm"><i class="fi-rs-shuffle mr-10"></i>Update</button>
                                        </div>
                                    </div>
                                </form> --}}
                            {{-- <div class="mb-30 mt-50">
                                    <div class="heading_s1 mb-3">
                                        <h4>Apply Coupon</h4>
                                    </div>
                                    <div class="total-amount">
                                        <div class="left">
                                            <div class="coupon">
                                                <form action="#" target="_blank">
                                                    <div class="form-row row justify-content-center">
                                                        <div class="form-group col-lg-6">
                                                            <input class="font-medium" name="Coupon" placeholder="Enter Your Coupon">
                                                        </div>
                                                        <div class="form-group col-lg-6">
                                                            <button class="btn  btn-sm"><i class="fi-rs-label mr-10"></i>Apply</button>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div> --}}
                            {{-- </div> --}}


                            <div class="col-lg-6 col-md-12">
                                <div class="border p-md-4 p-30 border-radius cart-totals">
                                    <div class="heading_s1 mb-3">
                                        <h4>Estás a un paso de tu compra</h4>
                                    </div>
                                    <div class="table-responsive">
                                        <table class="table">
                                            <tbody>
                                                <tr>
                                                    <td class="cart_total_label">Subtotal</td>
                                                    <td class="cart_total_amount"><span
                                                            class="font-lg fw-900 text-brand">${{ $subtotal }}</span>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="cart_total_label">Envio</td>
                                                    <td class="cart_total_amount"> <i class="ti-gift mr-5"></i> Se
                                                        calcula al introducir la direccion </td>
                                                </tr>
                                                <tr>
                                                    <td class="cart_total_label">Total</td>
                                                    <td class="cart_total_amount"><strong><span
                                                                class="font-xl fw-900 text-brand">${{ $subtotal }}</span></strong>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                        <form action=" {{ route('pagar_con_qvapay') }}" method="POST" name="qvapay">
                                            @csrf
                                            <input type="hidden" name='uid' value="{{ Auth::user()->id }}">
                                            <input type="hidden" name='total' value="{{ $subtotal }}">
                                            <input type="hidden" name='remote_id' value="{{ $subtotal }}">
                                            <input type="hidden" id="qvapay" name="metodopago" value="qvapay">
                                        </form>
                                    </div>

                                    <a href="{{ route('mapa') }}" clas="btn" style="font-size: 14px;
                                    font-weight: 700;
                                    padding: 12px 30px;
                                    border-radius: 4px;
                                    color: #fff;
                                    border: 1px solid #BCCA25;
                                    background-color: #BCCA25;
                                    cursor: pointer;
                                    -webkit-transition: all 300ms linear 0s;
                                    transition: all 300ms linear 0s;
                                    letter-spacing: 0.5px;">  Ir a Pagar 💰</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
</div>
