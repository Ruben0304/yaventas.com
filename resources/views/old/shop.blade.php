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
    
    <!-- Breadcrumb Section End -->

    <!-- Product Section Begin -->
    <section class="product spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-5">
                    <div class="sidebar">
                        <div class="sidebar__item" id="deparment">
                            <h4>Department</h4>
                            <ul>
                                <li><a href="#">Fresh Meat</a></li>
                                <li><a href="#">Vegetables</a></li>
                                <li><a href="#">Fruit & Nut Gifts</a></li>
                                <li><a href="#">Fresh Berries</a></li>
                                <li><a href="#">Ocean Foods</a></li>
                                <li><a href="#">Butter & Eggs</a></li>
                                <li><a href="#">Fastfood</a></li>
                                <li><a href="#">Fresh Onion</a></li>
                                <li><a href="#">Papayaya & Crisps</a></li>
                                <li><a href="#">Oatmeal</a></li>
                            </ul>
                        </div> 
                        <form action="" method="get">
                        <div class="sidebar__item" id="price">
                            <h4>Precio</h4>
                            <div class="price-range-wrap">
                                <div class="price-range ui-slider ui-corner-all ui-slider-horizontal ui-widget ui-widget-content"
                                    data-min="0" data-max="">
                                    <div class="ui-slider-range ui-corner-all ui-widget-header"></div>
                                    <span tabindex="0" class="ui-slider-handle ui-corner-all ui-state-default"></span>
                                    <span tabindex="0" class="ui-slider-handle ui-corner-all ui-state-default"></span>
                                </div>
                                <div class="range-slider">
                                    <div class="price-input">
                                        <input type="text" id="minamount">
                                        <input type="text" id="maxamount">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                        
                        
                    </div>
                </div>
                <div class="col-lg-9 col-md-7"> 
                   
               
                    <div class="filter__item">
                        <div class="row">
                            <div class="col-lg-4 col-md-5">
                                <div class="filter__sort">
                                    <span>Sort By</span>
                                    <select>
                                        <option value="0">Default</option>
                                        <option value="0">Default</option>
                                    </select>
                                </div>
                            </div>
                            {{-- <div class="col-lg-4 col-md-4">
                                <div class="filter__found">
                                    <h6><span>{{$producto->count()}}</span> Productos encontrados</h6>
                                </div>
                            </div> --}}
                            
                        </div>
                    </div>
                    <div class="row">
                        <section class="productos_movil">
                            @foreach ($producto as $item)
                        <div class="latest-prdouct__slider__item">
                            <a href="{{route('detalles','id='.$item->id.'')}}" class="latest-product__item">
                                <div class="latest-product__item__pic">
                                    <img src="{{$item->foto}}" alt="">
                                </div>
                                <div class="latest-product__item__text">
                                    <h6>{{$item->nombre}}</h6>
                                    <span>$ {{$item['precio'.$_COOKIE['moneda'].'']}}</span>
                                </div>
                            </a>
                           
                        </div>
                        @endforeach
                    </section>
                    
                    @foreach ($producto as $item)
                        
                    
                    
                        <div class="col-lg-4 col-md-6 col-sm-6" id="productos_pc">
                            <div class="product__item">
                                <div class="product__item__pic set-bg" data-setbg="{{$item->foto}}">
                                    <ul class="product__item__pic__hover">
                                        <li><a href="#"><i class="fa fa-heart"></i></a></li>
                                        <li><a href="#"><i class="fa fa-retweet"></i></a></li>
                                        <li><a href="#"><i class="fa fa-shopping-cart"></i></a></li>
                                    </ul>
                                </div>
                                <div class="product__item__text">
                                    <h6><a href="#">{{$item->nombre}}</a></h6>
                                    <h5>$ {{$item['precio'.$_COOKIE['moneda'].'']}}</h5>
                                </div>
                         </div>
                        </div>
                   
                    @endforeach
                    
                    </div>    
                    @if ($producto->count()>9 )
                    {{ $producto->links() }} 
                    @endif
                    
                    <div class="product__pagination">
                        
                        {{-- <a href="#"><i class="fa fa-long-arrow-right"></i></a> --}}
                    </div>
                </div>
                
            </div>
        </div>
    </section>
    <!-- Product Section End -->
    
@endsection