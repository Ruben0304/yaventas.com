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

   

    <!-- Shoping Cart Section Begin -->
    <section class="shoping-cart spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="shoping__cart__table">
                        <table>
                            <thead>
                                <tr>
                                    <th class="shoping__product">Productos</th>
                                    <th>Precio</th>
                                    <th>Cantidad</th>
                                    <th>Total</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    @auth
                                    @php $carro= $carrito->where('id_user',Auth::user()->id)@endphp 
                                    @if ($carro->first()==null)
                                    @php $subtotal=0 @endphp 
                                   
                                     @else
                                    @foreach ($carro as $item)
                                   
                                        
                                    
                                        <form action=" {{route('quitar_carrito')}} " name="quitarcarrito{{2*34+345*$item->id_user*$item->id}}" method="POST"> 
                                         @csrf
                                            <input type="hidden" value="{{$item->id}}" name="id">

                                        </form>
                                        <form action=" {{route('sumar_carrito')}} " name="sumarcarrito{{2*34+345*$item->id_user*$item->id}}" method="POST"> 
                                            @csrf
                                               <input type="hidden" value="{{$item->id}}" name="id">
   
                                           </form>
                                           <form action=" {{route('restar_carrito')}} " name="restarcarrito{{2*34+345*$item->id_user*$item->id}}" method="POST"> 
                                            @csrf
                                               <input type="hidden" value="{{$item->id}}" name="id">
   
                                           </form>
                                   
                                    <td class="shoping__cart__item" style="width: 630px;" >
                                        <img src="{{$item->producto->foto}}" alt="" style="max-width: 100%; width: 110px" >
                                        <h5>{{$item->producto->nombre}}</h5>
                                    </td>
                                    <td class="shoping__cart__price">
                                       $ {{$item->producto['precio'.$_COOKIE['moneda'].'']}} 
                                    </td>
                                    <td class="shoping__cart__quantity">
                                        <div class="quantity">
                                            <div class="pro-qty">
                                              <a href="javascript:document.restarcarrito{{2*34+345*$item->id_user*$item->id}}.submit()"> <span class="dec qtybtn">-</span></a> 
                                                <input type="text" value={{$item->cantidad}}>
                                                <a href="javascript:document.sumarcarrito{{2*34+345*$item->id_user*$item->id}}.submit()"> <span class="inc qtybtn">+</span></a>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="shoping__cart__total">
                                       $ {{$item->producto['precio'.$_COOKIE['moneda'].'']*$item->cantidad}}
                                    </td>
                                   <td class="shoping__cart__item__close">
                                    <a href="javascript:document.quitarcarrito{{2*34+345*$item->id_user*$item->id}}.submit()">  <span class="icon_close"></span></a> 
                                    </td>
                                </tr>
                               
                               
                                
                               
                              
                                @endforeach
                                 {{-- Calculando el total --}}
                                

                                @if ($carro->count()==1)
                                <div style="display: none">  {{$subtotal=($item->producto['precio'.$_COOKIE['moneda'].'']*$item->cantidad)}}  </div>
                                  @else
                                  <div style="display: none"> {{$subtotal=($carro['0']->producto['precio'.$_COOKIE['moneda'].'']*$carro['0']->cantidad)}} </div>
                                  @for ($i = 1; $i < $carro->count(); $i++)
                                  
                                  <div style="display: none"> {{$subtotal+=($carro[$i]->producto['precio'.$_COOKIE['moneda'].'']*$carro[$i]->cantidad)}} </div>
                                  
                                  @endfor
                                  @endif
                                  @endif
                                @endauth
                                <tr>

                                    {{-- <td class="shoping__cart__item">
                                        <img src="img/cart/cart-2.jpg" alt="">
                                        <h5>Fresh Garden Vegetable</h5>
                                    </td>
                                    <td class="shoping__cart__price">
                                        $39.00
                                    </td>
                                    <td class="shoping__cart__quantity">
                                        <div class="quantity">
                                            <div class="pro-qty">
                                                <input type="text" value="1">
                                            </div>
                                        </div>
                                    </td>
                                    <td class="shoping__cart__total">
                                        $39.99
                                    </td>
                                    <td class="shoping__cart__item__close">
                                        <span class="icon_close"></span>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="shoping__cart__item">
                                        <img src="img/cart/cart-3.jpg" alt="">
                                        <h5>Organic Bananas</h5>
                                    </td>
                                    <td class="shoping__cart__price">
                                        $69.00
                                    </td>
                                    <td class="shoping__cart__quantity">
                                        <div class="quantity">
                                            <div class="pro-qty">
                                                <input type="text" value="1">
                                            </div>
                                        </div>
                                    </td>
                                    <td class="shoping__cart__total">
                                        $69.99
                                    </td>
                                    <td class="shoping__cart__item__close">
                                        <span class="icon_close"></span>
                                    </td> --}}
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="row">
                
                <div class="col-lg-6">
                    <div class="shoping__continue">
                        <div class="shoping__discount">
                            <h5>Descuentos</h5>
                            <form action="#">
                                <input type="text" placeholder="Enter your coupon code">
                                <button type="submit" class="site-btn">Aplicar Cupon</button>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    
                    <div class="shoping__checkout">
                        <form action="{{route('caja')}}" method="POST" name="ir_a_comprar">
                         <input type="hidden" name="uid" value="{{Auth::user()->id}}">
                         
                        </form>
                        <h5>Este sería el precio</h5>
                        <ul>
                            
                           
                            
                        
                        <li>Subtotal <span>$ {{$subtotal}}</span></li>
                       
                            <li>Total <span>$ {{$subtotal}}</span></li>
                        </ul>
                        <a href="{{route('caja')}}" class="primary-btn">  Me sirve  <i class="fa fa-thumbs-o-up"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Shoping Cart Section End -->

@endsection