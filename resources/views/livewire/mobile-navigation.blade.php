<div class="mobile-header-active mobile-header-wrapper-style" style="min-height: 100vh;display: block !important;
    opacity: 1 !important;">

<div class="mobile-header-wrapper-inner">
        <div class="mobile-header-top">
            <div class="mobile-header-logo">
                <a href="{{route('home')}}">
                    <img src="img/logo/1.png" alt="logo">
                </a>
            </div>
            <div class="mobile-menu-close close-style-wrap close-style-position-inherit">
                <button class="close-style search-close">
                    <i class="icon-top"></i>
                    <i class="icon-bottom"></i>
                </button>
            </div>
        </div>
        <div class="mobile-header-content-area">
            <div class="mobile-search search-style-3 mobile-header-border">
                <form wire:submit.prevent="search">
                    <input type="text"
                           wire:model.defer="searchQuery"
                           placeholder="Buscar">
                    <button type="submit">
                        <i class="fi-rs-search"></i>
                    </button>
                </form>
            </div>
            <div class="mobile-menu-wrap mobile-header-border">
                <div class="main-categori-wrap mobile-header-border">
                    <a class="categori-button-active-2" href="#">
                        <span class="fi-rs-apps"></span> Categorias
                    </a>
                    <div class="categori-dropdown-wrap categori-dropdown-active-small">
                        <ul>
                            @foreach($categories as $categoria)
                                <form action="{{ route('categoria') }}" method="GET">
                                    <input type="hidden" name="buscar" value="{{ $categoria->id }}">
                                    <li>
                                        <a href="#" onclick="event.preventDefault(); this.closest('form').submit()">
                                            <i class="surfsidemedia-font-dress"></i>{{ $categoria->nombre }}
                                        </a>
                                    </li>
                                </form>
                            @endforeach
                        </ul>
                    </div>
                </div>
                <!-- mobile menu start -->
                <nav>
                    <ul class="mobile-menu">
                        <li class="menu-item-has-children">
                            <span class="menu-expand"></span>
                            <a href="{{ route('home') }}">Inicio</a>
                        </li>
                        <li class="menu-item-has-children">
                            <span class="menu-expand"></span>
                            <a href="{{ route('shoping') }}">Comprar</a>
                        </li>
                        <li class="menu-item-has-children">
                            <span class="menu-expand"></span>
                            <a href="{{ route('pedidos') }}">Mis Pedidos</a>
                        </li>
                        @auth
                            @if (Auth::user()->utype == 'ADMIN')
                                <li class="menu-item-has-children">
                                    <span class="menu-expand"></span>
                                    <a href="{{ route('admin.crear.productos') }}">Agregar Producto</a>
                                </li>
                            @endif
                        @endauth
                    </ul>
                </nav>
            </div>
            <div class="mobile-header-info-wrap mobile-header-border">
                <div class="single-mobile-header-info mt-30">
                    <a href="" id="instalar">Sobre Nosotros</a>
                </div>
                <div class="single-mobile-header-info">
                    <a href="{{ route('login') }}">
                        @auth
                            {{ Auth::user()->name }}
                        @else
                            Entrar
                        @endauth
                    </a>
                </div>
                @auth
                    <form action="{{ route('logout') }}" method="post">
                        @csrf
                        <a href="#" onclick="event.preventDefault(); this.closest('form').submit()">Salir</a>
                    </form>
                @else
                    <div class="single-mobile-header-info">
                        <a href="{{ route('register') }}">Registrarse</a>
                    </div>
                @endauth
                <div class="single-mobile-header-info">
                    <a href="#">(+53) 54830854</a>
                </div>
            </div>
            <div class="mobile-social-icon">
                <h5 class="mb-15 text-grey-4">Síguenos</h5>
                <a href="#"><img src="assets/imgs/theme/icons/icon-facebook.svg" alt=""></a>
                <a href="#"><img src="assets/imgs/theme/icons/icon-twitter.svg" alt=""></a>
                <a href="#"><img src="assets/imgs/theme/icons/icon-instagram.svg" alt=""></a>
                <a href="#"><img src="assets/imgs/theme/icons/icon-pinterest.svg" alt=""></a>
                <a href="#"><img src="assets/imgs/theme/icons/icon-youtube.svg" alt=""></a>
            </div>
        </div>
    </div>
</div>
