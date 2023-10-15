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
<style>
    .referencia::placeholder {
        color: #464646;
    }
</style>
<div>

    <main class="main">
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <div class="page-header breadcrumb-wrap">
            <div class="container">
                <div class="breadcrumb">
                    <a href="{{ route('home') }}" rel="nofollow">Incio</a>
                    <span></span> <a href="{{ route('shoping') }}">Comprar</a>
                    <span></span> Pagar
                </div>
            </div>
        </div>
        <section class="mt-50 mb-50">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 mb-sm-15">
                        {{-- <div class="toggle_info">
                            <span><i class="fi-rs-user mr-10"></i><span class="text-muted">Already have an account?</span> <a href="#loginform" data-bs-toggle="collapse" class="collapsed" aria-expanded="false">Click here to login</a></span>
                        </div> --}}
                        <div class="panel-collapse collapse login_form" id="loginform">
                            {{-- <div class="panel-body">
                                <p class="mb-30 font-sm">If you have shopped with us before, please enter your details below. If you are a new customer, please proceed to the Billing &amp; Shipping section.</p>
                               
                              
                            </div> --}}
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="toggle_info">
                            <span><i class="fi-rs-label mr-10"></i><span class="text-muted">Tienes cupon?</span> <a
                                    href="" data-bs-toggle="collapse" class="collapsed"
                                    aria-expanded="false">Click aqui para usarlo</a></span>
                        </div>
                        <div class="panel-collapse collapse coupon_form " id="coupon">
                            <div class="panel-body">
                                <p class="mb-30 font-sm">Si tiene algun cupon, por favor introduzcalo.</p>
                                <form method="post">
                                    <div class="form-group">
                                        <input type="text" placeholder="Su cupon aqui...">
                                    </div>
                                    <div class="form-group">
                                        <button class="btn  btn-md" name="login">Aplicar</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="divider mt-50 mb-50"></div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-25">
                            <h4>Direccion de envio 🚚</h4>
                        </div>
                        <form method="post" action="{{ route('pagar') }}" name="pagar">
                            @csrf
                            <div class="form-group">
                                <input type="text" name="nombre" placeholder="Nombre y apellidos *"
                                    value="{{ $ordenes->nombre ?? '' }}" required>
                            </div>
                            <div class="form-group">
                                <input type="text" name="direccion" required placeholder="Direccion *"
                                    value="{{ $ordenes->direccion ?? '' }}">
                            </div>

                            <div class="form-group">
                                <input required type="text" name="pais" value="Cuba" disabled>
                                <input type="hidden" name="pais" value="Cuba">
                            </div>
                            <div class="form-group">
                                <input required type="text" name="provincia" value="La Habana" disabled>
                                <input type="hidden" name="provincia" value="La Habana">
                            </div>

                            <div class="form-group">
                                <div class="custom_select">
                                    <select class="form-control select-active" name="municipio" required>
                                        <option value="">Municipio *</option>
                                        @foreach ($municipios as $municipio)
                                            @if ($ordenes->municipio ?? '' == $municipio)
                                                <option value="{{ $municipio }}" selected>{{ $municipio }}
                                                </option>
                                            @else
                                                <option value="{{ $municipio }}">{{ $municipio }}</option>
                                            @endif
                                        @endforeach


                                    </select>
                                </div>
                            </div>
                            {{-- <div class="form-group">
                                <input required="" type="text" name="state" placeholder="Municipio *">
                            </div> --}}
                            {{-- <div class="form-group">
                                <input required="" type="text" name="zipcode" placeholder="Postcode / ZIP *">
                            </div> --}}
                            <div class="form-group">
                                <input required type="text" name="telefono"
                                    placeholder="Telefono (Se le confirmará a este telefono antes del envio) *"
                                    value="{{ $ordenes->telefono ?? '' }}">
                            </div>
                            {{-- <div class="form-group">
                                <input required="" type="text" name="email" placeholder="Email address *">
                            </div> --}}
                            {{-- <div class="form-group">
                                <div class="checkbox">
                                     <div class="custome-checkbox">
                                        <input class="form-check-input" type="checkbox" name="checkbox" id="createaccount">
                                        <label class="form-check-label label_info" data-bs-toggle="collapse" href="#collapsePassword" data-target="#collapsePassword" aria-controls="collapsePassword" for="createaccount"><span>Create an account?</span></label>
                                    </div> 
                                </div>
                            </div> --}}
                            {{-- <div id="collapsePassword" class="form-group create-account collapse in">
                                <input required="" type="password" placeholder="Password" name="password">
                            </div> --}}
                            {{-- <div class="ship_detail">
                                <div class="form-group">
                                    <div class="chek-form">
                                        {{-- <div class="custome-checkbox">
                                            <input class="form-check-input" type="checkbox" name="checkbox" id="differentaddress">
                                            <label class="form-check-label label_info" data-bs-toggle="collapse" data-target="#collapseAddress" href="#collapseAddress" aria-controls="collapseAddress" for="differentaddress"><span>Enviar a otra direccion?</span></label>
                                        </div> 
                                    </div>
                                </div>
                                <div id="collapseAddress" class="different_address collapse in">
                                    <div class="form-group">
                                        <input type="text" required="" name="fname" placeholder="First name *">
                                    </div>
                                    <div class="form-group">
                                        <input type="text" required="" name="lname" placeholder="Last name *">
                                    </div>
                                    <div class="form-group">
                                        <input required="" type="text" name="cname" placeholder="Company Name">
                                    </div>
                                    <div class="form-group">
                                        <div class="custom_select">
                                            <select class="form-control select-active">
                                                <option value="">Select an option...</option>
                                                <option value="AX">Aland Islands</option>
                                               
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <input type="text" name="billing_address" required="" placeholder="Address *">
                                    </div>
                                    <div class="form-group">
                                        <input type="text" name="billing_address2" required="" placeholder="Address line2">
                                    </div>
                                    <div class="form-group">
                                        <input required="" type="text" name="city" placeholder="City / Town *">
                                    </div>
                                    <div class="form-group">
                                        <input required="" type="text" name="state" placeholder="State / County *">
                                    </div>
                                    <div class="form-group">
                                        <input required="" type="text" name="zipcode" placeholder="Postcode / ZIP *">
                                    </div>
                                </div>
                            </div> --}}
                            {{-- <div class=“mb-20”>
                                <h5>Referencia tu direccion (opcional)</h5>
                            </div>
                            <div class="form-group mb-30">
                                <textarea  rows="6" name="referencia" style="border: 2px solid #FF6E11;color: #2b2a2a"
                                    placeholder="Indícanos un punto de referencia para ayudarnos a encontrar tu dirección. 🙏"></textarea>
                            </div> --}}


                    </div>
                    <div class=“mb-20”>
                        <h5>Escribe aquí lo que desees (opcional)</h5>
                    </div>
                    <div class="form-group mb-30">
                        <textarea rows="6" name="comentarios" style="border: 2px solid #FF6E11;color: #2b2a2a"
                            placeholder="¿Tienes alguna duda, petición o alguna otra cosa que quieras decirnos? Escríbenos aquí lo que quieras. Te responderemos lo antes posible. Estamos atentos a tus comentarios. 💬"></textarea>
                    </div>

                </div>
                <div class="col-md-6">
                    <div class="order_review">
                        <div class="mb-20">
                            <h4>Tu pedido</h4>
                        </div>
                        <div class="table-responsive order_table text-center">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th colspan="2">Producto</th>
                                        <th>Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $subtotal = 0;
                                    @endphp
                                    @foreach ($carrito->where('id_user', Auth::user()->id) as $item)
                                        <tr>
                                            <td class="image product-thumbnail"><img src="{{ $item->producto->foto }}"
                                                    alt="{{ $item->producto->nombre }}"></td>
                                            <td>
                                                <h5><a href="product-details.html">{{ $item->producto->nombre }}</a>
                                                </h5> <span class="product-qty">{{ $item->cantidad }}</span>
                                            </td>
                                            <td>{{ ($whatsapp ? $item->producto->preciocup : $item->producto->preciocup + 0.1 * $item->producto->preciocup) * $item->cantidad }}
                                            </td>
                                            @php
                                                $subtotal += ($whatsapp ? $item->producto->preciocup : $item->producto->preciocup + 0.1 * $item->producto->preciocup) * $item->cantidad;
                                            @endphp

                                        </tr>
                                    @endforeach

                                    <tr>
                                        <th>SubTotal</th>
                                        <td class="product-subtotal" colspan="2">${{ $subtotal }}</td>
                                        <input type="hidden" name="subtotal" value="{{ $subtotal }}">
                                    </tr>
                                    <tr>
                                        <th>Envio</th>
                                        <td colspan="2">
                                            {{ $shippingCost > 0 ? '$' . $shippingCost . ' CUP' : 'Gratis' }}<br>( 24h a
                                            48h )</td>
                                            <input type="hidden" name="envio" value="{{ $shippingCost }}">
                                    </tr>
                                    <tr>
                                        <th>Total</th>
                                        <td colspan="2" class="product-subtotal"><span
                                                class="font-xl text-brand fw-900">${{ $subtotal + $shippingCost }}
                                                CUP</span></td>
                                                <input type="hidden" name="total" value="{{ $subtotal + $shippingCost }}">
                                                <input type="hidden" name="cordenadas" value="{{ $cordenadas }}">
                                                <input type="hidden" name="bono" value="0">
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="bt-1 border-color-1 mt-30 mb-30"></div>
                        <div class="payment_method">
                            <div class="mb-25">
                                <h5>Método de Pago</h5>
                            </div>
                            <div class="payment_option">
                                <div class="custome-radio">
                                    <input class="form-check-input" required="" type="radio" name="metodopago"
                                        id="exampleRadios3" value="efectivo" selected>
                                    <label class="form-check-label" for="exampleRadios3" data-bs-toggle="collapse"
                                        data-target="#cashOnDelivery" aria-controls="cashOnDelivery">Efectivo</label>
                                </div>

                            </div>
                        </div>
                        <a href="javascript:document.pagar.submit()" class="btn btn-fill-out btn-block mt-30"
                            style="background-color: #BCCA25">Proceder con la compra 💳</a>
                    </div>
                    </form>
                </div>
            </div>
</div>
</section>
</main>
</div>
