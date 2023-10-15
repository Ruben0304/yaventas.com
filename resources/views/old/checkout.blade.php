@extends('template')
@section('contenido')
    

    <!-- Hero Section Begin -->
    <section class="hero hero-normal">
       
      
        <div class="container">
            <div class="row">
                <div class="col-lg-3">
                    <div class="hero__categories">
                        <div class="hero__categories__all">
                            <i class="fa fa-bars"></i>
                            <span>Categorias</span>
                        </div>
                        <ul>
                            @foreach ($categorias as $categoria)
                                
                            
                            <li><a href="{{$categoria->id}}">{{$categoria->nombre}}</a></li>
                            @endforeach
                   </div>
                </div>
                <div class="col-lg-9">
                    <div class="hero__search">
                        </ul>
                        @include('_search')
                        <div class="hero__search__phone">
                            <div class="hero__search__phone__icon">
                                <i class="fa fa-phone"></i>
                            </div>
                            <div class="hero__search__phone__text">
                                <h5>+1 7865926593</h5>
                                <span>Atenderemos Enseguida</span>
                            </div>
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
    </section>
    <!-- Hero Section End -->

    <!-- Breadcrumb Section Begin -->
    <section class="breadcrumb-section set-bg" data-setbg="img/breadcrumb.jpg">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="breadcrumb__text">
                        <h2>Checkout</h2>
                        <div class="breadcrumb__option">
                            <a href="./index.html">Home</a>
                            <span>Checkout</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Section End -->

    <!-- Checkout Section Begin -->
    <section class="checkout spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h6><span class="icon_tag_alt"></span> Tinenes un cupon ? <a href="#">Click aqui</a> para introducir tu codigo
                    </h6>
                </div>
            </div>
            <div class="checkout__form">
                <h4>Detalles de factura</h4>
                <form action="#">
                    <div class="row">
                        <div class="col-lg-8 col-md-6">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="checkout__input">
                                        <p>Nombre<span>*</span></p>
                                        <input type="text">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="checkout__input">
                                        <p>Apellidos<span>*</span></p>
                                        <input type="text">
                                    </div>
                                </div>
                            </div>
                            <div class="checkout__input">
                                <p>Pais <span>*</span></p>
                                <input type="text" value="Cuba" disabled>
                            </div>
                            <div class="checkout__input">
                                <p>Pais donde realiza el pago<span>*</span></p>
                                <input type="text" >
                            </div>
                            <div class="checkout__input">
                                <p>Dirección<span>*</span></p>
                                <input type="text" placeholder="Calle" class="checkout__input__add">
                                <input type="text" placeholder="Número de casa, edificio, etc (Todos los detalles) ">
                            </div>
                            <div class="checkout__input">
                                <p>Provincia<span>*</span></p>
                                <input type="text" value="La Habana" disabled>
                            </div>
                            <div class="checkout__input">
                                <p>Municipio<span>*</span></p>
                                <input type="text">
                            </div>
                            {{-- <div class="checkout__input">
                                <p>Codigo Postal<span>*</span></p>
                                <input type="text">
                            </div> --}}
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="checkout__input">
                                        <p>Telefono<span>*</span></p>
                                        <input type="text" placeholder="Celular o fijo en Cuba">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="checkout__input">
                                        <p>Email<span>*</span></p>
                                        <input type="text">
                                    </div>
                                </div>
                            </div>
                            {{-- <div class="checkout__input__checkbox">
                                <label for="acc">
                                    Create an account?
                                    <input type="checkbox" id="acc">
                                    <span class="checkmark"></span>
                                </label>
                            </div>
                            <p>Create an account by entering the information below. If you are a returning customer
                                please login at the top of the page</p>
                            <div class="checkout__input">
                                <p>Account Password<span>*</span></p>
                                <input type="text">
                            </div> --}}
                            {{-- <div class="checkout__input__checkbox">
                                <label for="diff-acc">
                                    
                                    <input type="checkbox" id="diff-acc">
                                    <span class="checkmark"></span>
                                </label>
                            </div> --}}
                            <div class="checkout__input">
                                <p>Notas<span>*</span></p>
                                <input type="text"
                                    placeholder="Notes about your order, e.g. special notes for delivery.">
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6">
                            <div class="checkout__order">
                                <h4>Tu orden</h4>
                                <div class="checkout__order__products">Productos <span>Total</span></div>
                                <ul>
                                    @auth
                                    <div style="display: none">  {{$carro= $carrito->where('id_user',Auth::user()->id)}}</div>
                                    
                                    @foreach ($carro as $item)
                                        @if ($item->cantidad>$item->producto->stock)
                                            
                                        @else
                                        <li><i>{{$item->cantidad }} - </i>{{$item->producto->nombre }}<span>${{$item->producto['precio'.$_COOKIE['moneda'].'']*$item->cantidad }}</span></li>
                                    @endif
                                    @endforeach
                                </ul>
                                @if ($carro->count()==1)
                                <div style="display: none">  {{$subtotal=($item->producto['precio'.$_COOKIE['moneda'].'']*$item->cantidad)}}  </div>
                                  @else
                                  <div style="display: none"> {{$subtotal=($carro['0']->producto['precio'.$_COOKIE['moneda'].'']*$carro['0']->cantidad)}} </div>
                                  @for ($i = 1; $i < $carro->count(); $i++)
                                  
                                  <div style="display: none"> {{$subtotal+=($carro[$i]->producto['precio'.$_COOKIE['moneda'].'']*$carro[$i]->cantidad)}} </div>
                                  
                                  @endfor
                                  @endif
                                <div class="checkout__order__subtotal">Subtotal <span>{{$subtotal}}</span></div>
                                <div class="checkout__order__subtotal">Envio <span>$0.00</span></div>
                                <div class="checkout__order__subtotal">Descuento <span>$0.00</span></div>
                                <div class="checkout__order__subtotal">Impuestos <span>$0.00</span></div>
                                <div class="checkout__order__total">Total <span>{{$subtotal}}</span></div>
                                <div class="checkout__input__checkbox">
                                    {{-- <label for="acc-or">
                                        Create an account?
                                        <input type="checkbox" id="acc-or">
                                        <span class="checkmark"></span>
                                    </label>
                                </div>
                                <p>Lorem ipsum dolor sit amet, consectetur adip elit, sed do eiusmod tempor incididunt
                                    ut labore et dolore magna aliqua.</p> --}}
                                </form>
                           <form action=" {{route('pagar_con_qvapay')}}" method="POST" >
                            @csrf
                               <input type="hidden" name='uid' value="{{Auth::user()->id}}">
                               <input type="hidden" name='total' value="{{$subtotal}}">
                               <input type="hidden" name='remote_id' value="{{$subtotal}}">

                      
                              
                                    <h5>Metodos de Pago</h5>
                               
                                <div class="checkout__input__checkbox">
                                    <label for="paypal">
                                        Qvapay
                                        <input type="checkbox" id="qvapay" name="metodopago" value="qvapay" checked disabled>
                                        <span class="checkmark"></span>
                                    </label>
                                </div>
                                <button type="submit" class="site-btn">Pagar</button>
                            </form>
                            </div>
                        </div>
                    </div>
                @endauth
            </div>
        </div>
    </section>
    <!-- Checkout Section End -->
    @endsection