


<!DOCTYPE html>
<html lang="zxx">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="">
    <meta name="keywords" content="Ogani, unica, creative, html">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Gustazo </title>

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@200;300;400;600;900&display=swap" rel="stylesheet">

    <!-- Css Styles -->
   
    <link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}" type="text/css">
    <link rel="stylesheet" href="{{asset('css/font-awesome.min.css')}}" type="text/css">
    <link rel="stylesheet" href="{{asset('css/elegant-icons.css')}}" type="text/css">
    <link rel="stylesheet" href="{{asset('css/nice-select.css')}}" type="text/css">
    <link rel="stylesheet" href="{{asset('css/jquery-ui.min.css')}}" type="text/css">
    <link rel="stylesheet" href="{{asset('css/owl.carousel.min.css')}}" type="text/css">
    <link rel="stylesheet" href="{{asset('css/slicknav.min.css')}}" type="text/css">
    <link rel="stylesheet" href="{{asset('css/style.css')}}" type="text/css">
    {{-- <link id="pagestyle" href="assets/css/soft-ui-dashboard.css?v=1.0.3" rel="stylesheet" /> --}}
    <link rel="stylesheet" href="{{asset('css/app.css')}}" type="text/css">
    
  @laravelPWA

<style>
    
     

    .header__logo{
        width: 119px;  margin-left: 40px;
        }
        
        .product__discount__percent{
            height: 45px;
                            width: 45px;
                            background: #dd2222;
                            border-radius: 50%;
                            font-size: 14px;
                            color: #ffffff;
                            line-height: 45px;
                            text-align: center;
                            position: absolute;
                            left: 15px;
                            top: 15px;
        }
        .product__discount__fecha{
            height: 45px;
width: 100%;
border-radius: 50%;
font-size: 12px;
color: #c81919;
line-height: 45px;
text-align: right;
position: absolute;
right: 15px;
top: 15px;
font-weight: bold;
}
.productos_movil{
   margin-left: 6%;
   width: 88%;
}

      @media(min-width:641px){
        .productos_movil{
    display: none;
}
      }

    @media (max-width: 640px){
        #fondo_mobil_blanco{
            background-color: white;
        }
        .hero__categories ul{
            display: none;
        }
        #latestitem{
            width: 50%;
            
            
           
        }

        .featured__item{
            width: 100%;
            
            
        }
        .featured__item__pic {
           width: 100%;
         height: 200px;
           
        }
        .header__logo{
            margin-left: 0;
            width: 100px; 
            height: 30px;
        }
        #productos_pc{display: none;}
        #deparment{display: none;}
        #price{display: none;}
        #youtube{display: none;}
    }

</style >

</head>
@if (isset($moneda))
 @else
 @php
     $moneda='cup';
 @endphp


@endif


<body style="--main-bg-color:  {{$color}}">
    
    <!-- Page Preloder -->
    <div id="preloder">
        <div class="loader"></div>
    </div>

    <!-- Humberger Begin -->
    <div class="humberger__menu__overlay"></div>
    <div class="humberger__menu__wrapper">
        <div class="humberger__menu__logo">
            <a href="#"><img src="/img/logo.png" alt=""></a>
        </div>
        <div class="humberger__menu__cart">
            <ul>
                @auth
                                
                            
                <li><a href="#"><i class="fa fa-heart"></i> <span>1</span></a></li>
        <li><a href="{{route('carrito')}}"><i class="fa fa-shopping-bag"></i> <span>{{$carrito->where('id_user',Auth::user()->id)->count()}}</span></a></li>
        @else
        <li><a href="#"><i class="fa fa-heart"></i></a></li>
        <li><a href="{{route('login')}}"><i class="fa fa-shopping-bag"></i> </a></li>
        @endauth
                
            </ul>
            <div class="header__cart__price">Saldo: <span>$0.00</span></div>
        </div>
        <div class="humberger__menu__widget">
            <div class="header__top__right__language">
                {{-- <img src="img/icons8_money.ico" alt=""> --}}
                <div>CUP</div>
                <span class="arrow_carrot-down"></span>
                <ul>
                    <li><a href="#">USD</a></li>
                    <li><a href="#">CUP</a></li>
                </ul>
            </div>
            <div class="header__top__right__auth">
                @auth
                            
                                <a href="{{route('dashboard')}}"><i class="fa fa-user"></i> {{Auth::user()->name}}</a>
                                
                                
                            
                            @else
                           
                                <a href="{{route('login')}}"><i class="fa fa-user"></i> Entrar</a>
                            
                            @endauth
            </div>
        </div>
        <nav class="humberger__menu__nav mobile-menu">
            <ul>
                <li class="active"><a href="{{route('home')}}">Inicio</a></li>
                <li><a href="{{route('shoping')}}">Comprar</a></li>
                
                   
                        @auth
                            <li><a href="{{route('ordenes')}}">Mis Ordenes</a></li>
                           @if (Auth::user()->id==1)
                            <li><a href="{{route('admin')}}">Administar</a></li>
                             @else

                            <li><a href="{{route('crear_vendedor')}}">Vender</a></li>
                            @endif     
                            @endauth
                     
                      
                    
              
                
            </ul>
        </nav>
        <div id="mobile-menu-wrap"></div>
        <div class="header__top__right__social">
            <a href="#"><i class="fa fa-facebook"></i></a>
            <a href="#"><i class="fa fa-twitter"></i></a>
            <a href="#"><i class="fa fa-linkedin"></i></a>
            <a href="#"><i class="fa fa-pinterest-p"></i></a>
        </div>
        <div class="humberger__menu__contact">
            <ul>
                <li><i class="fa fa-envelope"></i> gustazo-shop@gmail.com</li>
                <li>Free Shipping for all Order of $99</li>
            </ul>
        </div>
    </div>
    <!-- Humberger End -->

    <!-- Header Section Begin -->
    <header class="header">
        <div class="header__top">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 col-md-6">
                        <div class="header__top__left">
                            <ul>
                                <li><i class="fa fa-envelope"></i> gustazo-shop@gmail.com</li>
                                <li>Aqui va algo</li>
                                <li><form action="{{route('cambiar_color')}}" method="post"> @csrf @method('put') <input type="color" name='color' style="width: 20px;
                                    border: none;
                                    height: 20px;"> <button type="submit">cambiar</button></form></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6">
                        <div class="header__top__right">
                            <div class="header__top__right__social">
                                <a href="#"><i class="fa fa-facebook"></i></a>
                                <a href="#"><i class="fa fa-twitter"></i></a>
                         
                            </div>
                            <div class="header__top__right__language">
                                {{-- <img src="img/icons8_money.ico" alt="" style="height: 20px"> --}}
                                @if (isset($_COOKIE['moneda']))
                                
                                @if ($_COOKIE['moneda']=='usd')
                                <div style="display: inline"><i class="fa fa-dollar"></i><span style="margin-left: 10px">USD</span></div>
                                @else
                                <div style="display: inline"><i class="fa fa-dollar"></i><span style="margin-left: 10px">CUP</span></div>
                                
                                @endif

                                @else
                                <div style="display: inline"><i class="fa fa-dollar"></i><span style="margin-left: 10px">CUP</span></div>
                                @endif

                                
                                
                                <span class="arrow_carrot-down"></span>
                                <ul>
                                    <li><a href="{{route('cup')}}">CUP</a></li>
                                    <li><a href="{{route('usd')}}">USD</a></li>
                                </ul>
                            </div>
                            <div class="header__top__right__auth">
                            @auth
                            
                                <a href="{{route('dashboard')}}"><i class="fa fa-user"></i> {{Auth::user()->name}}</a>
                                
                                {{-- <a href="{{route('dashboard')}}"><i class="fa fa-user"></i> Salir</a> --}}
                            
                            @else
                           
                                <a href="{{route('login')}}"><i class="fa fa-user"></i> Entrar</a>
                            
                            @endauth
                        </div> 
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            
            <div class="row">
                <div class="col-lg-3">
                    <div class="header__logo">
                        
                        <a href="{{route('home')}}"><img src="img/logos/log.png" alt="" ></a>
                        
                    </div>
                </div>
                <div class="col-lg-6">
                    <nav class="header__menu">
                        <ul>
                            <li class="active"><a href="{{route('home')}}">Inicio</a></li>
                            <li><a href="{{route('shoping')}}">Comprar</a></li>
                            {{-- <li><a href="#">Pages</a>
                                <ul class="header__menu__dropdown">
                                    <li><a href="./shop-details.html">Shop Details</a></li>
                                    <li><a href="./shoping-cart.html">Shoping Cart</a></li>
                                    <li><a href="./checkout.html">Check Out</a></li>
                                   
                                </ul>
                            </li> --}}
                            @auth
                            <li><a href="{{route('ordenes')}}">Mis Ordenes</a></li>
                            
                           @if (Auth::user()->id==1)
                            <li><a href="{{route('admin')}}">Administar</a></li>
                             @else

                            <li><a href="{{route('crear_vendedor')}}">Vender</a></li>
                            @endif     
                            @else
                            <li><a href="{{route('login')}}">Mis Ordenes</a></li>
                            <li><a href="{{route('login')}}">Administar</a></li>
                            @endauth
                            <li><a href="{{route('contacto')}}">App</a></li>
                        </ul>
                    </nav>
                </div>
                <div class="col-lg-3">
                    <div class="header__cart">
                        <ul>
                            @auth
                                
                            
                            <li><a href="#"><i class="fa fa-heart"></i> <span>1</span></a></li>
                    <li><a href="{{route('carrito')}}"><i class="fa fa-shopping-bag"></i> <span>{{$carrito->where('id_user',Auth::user()->id)->count()}}</span></a></li>
                    @else
                    <li><a href="#"><i class="fa fa-heart"></i></a></li>
                    <li><a href="{{route('login')}}"><i class="fa fa-shopping-bag"></i> </a></li>
                    @endauth
                </ul>
                        <div class="header__cart__price">Saldo: <span>$0.00</span></div>
                    </div>
                </div>
            </div>
            <div class="humberger__open">
                <i class="fa fa-bars"></i>
            </div>
        </div>
    </header>
    

   
    @yield('contenido')

    <!-- Footer Section Begin -->
    <footer class="footer spad">
        <div class="container">
            
            <div class="row">
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="footer__about">
                        <div class="footer__about__logo">
                            <a href="./index.html"><img src="img/logo.png" alt=""></a>
                        </div>
                        <ul>
                            <li>Direccion: xxxx</li>
                            <li>Télefono: +53 54830854</li>
                            <li>Email: clientes@rd.shop</li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-6 offset-lg-1">
                    <div class="footer__widget">
                        <h6>Links Útiles</h6>
                        <ul>
                            <li><a href="#">Sobre Nosotros</a></li>
                            <li><a href="#">Términos y Condiciones</a></li>
                            <li><a href="#">Política de Devoluciones</a></li>
                            <li><a href="#">Quejas y Sujerencias</a></li>
                        </ul>
                        
                    </div>
                </div>
                <div class="col-lg-4 col-md-12">
                    <div class="footer__widget">
                        <h6>Introduce tu email</h6>
                        <p>Subscríbete para recibir novedades sobre nuestro servicio.</p>
                        <form action="#">
                            <input type="text" placeholder="">
                            <button type="submit" class="site-btn">Subscribirse</button>
                        </form>
                        <div class="footer__widget__social">
                            <a href="#"><i class="fa fa-facebook"></i></a>
                            <a href="#"><i class="fa fa-instagram"></i></a>
                            <a href="#"><i class="fa fa-twitter"></i></a>
                            <a href="#"><i class="fa fa-telegram"></i></a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="footer__copyright">
                        <div class="footer__copyright__text"><p><!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
  Copyright &copy;<script>document.write(new Date().getFullYear());</script>
  <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. --></p></div>
                        <div class="footer__copyright__payment"><img src="img/payment-item.png" alt=""></div>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!-- Footer Section End -->

    <!-- Js Plugins -->
    <script src="{{asset('registrar_visita/registrar visita.js')}}"></script>
    <script src="{{asset('js/jquery-3.3.1.min.js')}}"></script>
    <script src="{{asset('js/bootstrap.min.js')}}"></script>
    <script src="{{asset('js/jquery.nice-select.min.js')}}"></script>
    <script src="{{asset('js/jquery-ui.min.js')}}"></script>
    <script src="{{asset('js/jquery.slicknav.js')}}"></script>
    <script src="{{asset('js/mixitup.min.js')}}"></script>
    <script src="{{asset('js/owl.carousel.min.js')}}"></script>
    <script src="{{asset('js/main.js')}}"></script>
  



</body>

</html>