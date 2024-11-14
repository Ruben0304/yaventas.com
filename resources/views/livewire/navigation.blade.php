<header class="header-area header-style-1 header-height-2 z-10 w-full">
    <div class="header-top header-top-ptb-1 d-none d-lg-block">
        <div class="container mx-auto px-8"> <!-- Increased padding from px-4 to px-8 -->
            <div class="row align-items-center">
                <div class="col-xl-3 col-lg-4">
                    <div class="header-info">
                    </div>
                </div>
                <div class="col-xl-6 col-lg-4">
                    <div class="text-center">
                        <div id="news-flash" class="d-inline-block">
                            <ul>
                                <li>Unete a whatsapp para consegir ofertas <a href="">Unirse</a></li>
                                <li>Calidad y seguridad garantizadas</li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-4">
                    <div class="header-info header-info-right">
                        <ul>
                            @auth
                                <li><i class="fi-rs-key"></i><a href="{{ route('home') }}">{{ Auth::user()->name }} </a>/
                                    <form action="{{ route('logout') }}" method="post">
                                        @csrf
                                        <a href=""
                                           onclick="event.preventDefault(); this.closest('form').submit()">Salir</a>
                                    </form>
                                </li>
                            @else
                                <li><i class="fi-rs-key"></i><a href="{{ route('login') }}">Entrar </a> / <a
                                        href="{{ route('register') }}">Registrate</a></li>
                            @endauth
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="header-middle header-middle-ptb-1 d-none d-lg-block">
        <div class="container mx-auto px-20"> <!-- Increased padding from px-4 to px-8 -->
            <div class="header-wrap">
                <div class="logo logo-width-1">
                    <a href="{{ route('home') }}"><img src="{{asset('img/logo/1.png')}}" alt="logo" width="100px"></a>
                </div>
                <div class="header-right">
                    <div class="search-style-1">
                        <form action="{{ route('buscar') }}" method="GET">
                            <input type="text" placeholder="Buscar" name="buscar">
                            <button type="submit" class="site-btn"><i class="fi-rs-search"></i></button>
                        </form>
                    </div>
                    <div class="header-action-right">
                        <div class="header-action-2">
                            <div class="header-action-icon-2">
                            </div>
                            <livewire:shopping-cart />
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="header-bottom header-bottom-bg-color sticky-bar" style="padding-top: 15px; backdrop-filter: blur(10px); background: rgba(255, 255, 255, 0.2); border-radius: 10px;">
        <div class="container mx-auto px-20"> <!-- Increased padding from px-4 to px-8 -->
            <div class="header-wrap header-space-between position-relative" style="display: flex; justify-content: space-between;">
                <div class="logo logo-width-1 d-block d-lg-none">
                    <a href="{{ route('home') }}"><img src="img/logo/1.png" alt="logo"></a>
                </div>

                <div class="header-nav d-none d-lg-flex" style="display: flex !important; width: 100%; justify-content: space-between;">
                    <!-- Categorías - Inicio -->
                    <div style="width: auto;">
                        <livewire:categories-menu/>
                    </div>

                    <!-- Links - Centro -->
                    <div class="main-menu main-menu-padding-1 main-menu-lh-2 d-none d-lg-block" style="margin-left: 90px;">
                        <nav>
                            <ul style="display: flex; gap: 20px;">
                                <li>
                                    <a class="{{ $activeMenu === 'home' ? 'active' : '' }}" wire:click="setActiveMenu('home')" href="{{ route('home') }}">Inicio</a>
                                </li>
                                <li>
                                    <a class="{{ $activeMenu === 'shoping' ? 'active' : '' }}" wire:click="setActiveMenu('shoping')" href="{{ route('shoping') }}">Comprar</a>
                                </li>
                                <li>
                                    <a class="{{ $activeMenu === 'dashboard' ? 'active' : '' }}" wire:click="setActiveMenu('dashboard')" href="{{ route('dashboard') }}">Mi Cuenta</a>
                                </li>
                                <li>
                                    <a class="{{ $activeMenu === 'info' ? 'active' : '' }}" wire:click="setActiveMenu('info')" href="{{ route('info') }}">Sobre Nosotros</a>
                                </li>
                                @auth
                                    @if (Auth::user()->utype == 'ADMIN')
                                        <li class="relative group">
                                            <a href="#" class="{{ in_array($activeMenu, ['admin.crear.productos', 'admin.productos', 'admin.categorias', 'admin.listado.usuarios', 'admin.listado.ordenes', 'admin.listado.vendedores']) ? 'active' : '' }}">
                                                Administrar <i class="fi-rs-angle-down"></i>
                                            </a>
                                            <ul class="sub-menu" style="position: absolute; top: 100%; left: 0; background: white; box-shadow: 0 2px 5px rgba(0,0,0,0.1);">
                                                <li><a class="{{ $activeMenu === 'admin.productos' ? 'active' : '' }}" wire:click="setActiveMenu('admin.productos')" href="{{ route('admin.productos') }}">Productos</a></li>
                                                <li><a class="{{ $activeMenu === 'admin.categorias' ? 'active' : '' }}" wire:click="setActiveMenu('admin.categorias')" href="{{ route('admin.categorias') }}">Categorias</a></li>
                                                <li><a class="{{ $activeMenu === 'admin.listado.usuarios' ? 'active' : '' }}" wire:click="setActiveMenu('admin.listado.usuarios')" href="{{ route('admin.listado.usuarios') }}">Usuarios</a></li>
                                                <li><a class="{{ $activeMenu === 'admin.listado.ordenes' ? 'active' : '' }}" wire:click="setActiveMenu('admin.listado.ordenes')" href="{{ route('admin.listado.ordenes') }}">Ordenes</a></li>
                                                <li><a class="{{ $activeMenu === 'admin.listado.vendedores' ? 'active' : '' }}" wire:click="setActiveMenu('admin.listado.vendedores')" href="{{ route('admin.listado.vendedores') }}">Vendedores</a></li>
                                            </ul>
                                        </li>
                                    @endif
                                @endauth
                            </ul>
                        </nav>
                    </div>

                    <!-- Teléfono - Final -->
                    <div class="hotline d-none d-lg-block" style="width: auto; white-space: nowrap;">
                        <p><i class="fi-rs-smartphone"></i><span>Contáctanos</span> +53 54830854</p>
                    </div>
                </div>

                <livewire:mobile-top-navigation/>
            </div>
        </div>
    </div>
</header>
