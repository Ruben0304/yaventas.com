<div class="main-menu main-menu-padding-1 main-menu-lh-2 d-none d-lg-block" style="margin-left: 100px;">
    <nav>
        <ul>
            <li>
                <a class="{{ $activeMenu === 'home' ? 'active' : '' }}"
                   wire:click="setActiveMenu('home')"
                   href="{{ route('home') }}">
                    Inicio
                </a>
            </li>

            <li>
                <a class="{{ $activeMenu === 'shoping' ? 'active' : '' }}"
                   wire:click="setActiveMenu('shoping')"
                   href="{{ route('shoping') }}">
                    Comprar
                </a>
            </li>

            <li>
                <a class="{{ $activeMenu === 'dashboard' ? 'active' : '' }}"
                   wire:click="setActiveMenu('dashboard')"
                   href="{{ route('dashboard') }}">
                    Mi Cuenta
                </a>
            </li>

            <li>
                <a class="{{ $activeMenu === 'info' ? 'active' : '' }}"
                   wire:click="setActiveMenu('info')"
                   href="{{ route('info') }}">
                    Sobre Nosotros
                </a>
            </li>

            @auth
                @if (Auth::user()->utype == 'ADMIN')
                    <li>
                        <a href="#" class="{{ in_array($activeMenu, ['admin.crear.productos', 'admin.productos', 'admin.categorias', 'admin.listado.usuarios', 'admin.listado.ordenes', 'admin.listado.vendedores']) ? 'active' : '' }}">
                            Administrar <i class="fi-rs-angle-down"></i>
                        </a>
                        <ul class="sub-menu">
                            <li>
                                <a class="{{ $activeMenu === 'admin.crear.productos' ? 'active' : '' }}"
                                   wire:click="setActiveMenu('admin.crear.productos')"
                                   href="{{ route('admin.crear.productos') }}">
                                    Agregar Producto
                                </a>
                            </li>
                            <li>
                                <a class="{{ $activeMenu === 'admin.productos' ? 'active' : '' }}"
                                   wire:click="setActiveMenu('admin.productos')"
                                   href="{{ route('admin.productos') }}">
                                    Productos
                                </a>
                            </li>
                            <li>
                                <a class="{{ $activeMenu === 'admin.categorias' ? 'active' : '' }}"
                                   wire:click="setActiveMenu('admin.categorias')"
                                   href="{{ route('admin.categorias') }}">
                                    Categorias
                                </a>
                            </li>
                            <li>
                                <a class="{{ $activeMenu === 'admin.listado.usuarios' ? 'active' : '' }}"
                                   wire:click="setActiveMenu('admin.listado.usuarios')"
                                   href="{{ route('admin.listado.usuarios') }}">
                                    Usuarios
                                </a>
                            </li>
                            <li>
                                <a class="{{ $activeMenu === 'admin.listado.ordenes' ? 'active' : '' }}"
                                   wire:click="setActiveMenu('admin.listado.ordenes')"
                                   href="{{ route('admin.listado.ordenes') }}">
                                    Ordenes
                                </a>
                            </li>
                            <li>
                                <a class="{{ $activeMenu === 'admin.listado.vendedores' ? 'active' : '' }}"
                                   wire:click="setActiveMenu('admin.listado.vendedores')"
                                   href="{{ route('admin.listado.vendedores') }}">
                                    Vendedores
                                </a>
                            </li>
                        </ul>
                    </li>
                @endif
            @endauth
        </ul>
    </nav>
</div>
