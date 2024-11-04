<div>
    <main class="main">
        <div class="page-header breadcrumb-wrap">
            <div class="container">
                <div class="breadcrumb">
                    <a href="index.html" rel="nofollow">Home</a>
                    <span>Vendedores</span>
                </div>
            </div>
        </div>
        <section class="mt-50 mb-50">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header d-flex justify-content-between align-items-center">
                                <h3 class="card-title">Listado de Vendedores</h3>
                                <div class="input-group" style="width: 300px;">
                                    <input wire:model.debounce.300ms="search" type="text" class="form-control"
                                           placeholder="Buscar por nombre, teléfono o dirección...">
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-hover">
                                        <thead>
                                        <tr>
                                            <th>Imagen</th>
                                            <th>Nombre</th>
                                            <th>Teléfono</th>
                                            <th>Dirección</th>
                                            <th>Descripción</th>
                                            <th>Productos</th>
                                            <th>Detalles</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach ($vendedores as $vendedor)
                                            <tr>
                                                <td class="align-middle" style="width: 100px;">
                                                    <img src="{{ asset($vendedor->foto) }}"
                                                         alt="{{ $vendedor->nombre }}"
                                                         class="img-thumbnail"
                                                         style="width: 80px; height: 80px; object-fit: cover;">
                                                </td>
                                                <td class="align-middle">{{ $vendedor->nombre }}</td>
                                                <td class="align-middle">{{ $vendedor->telefono }}</td>
                                                <td class="align-middle">{{ $vendedor->direccion }}</td>
                                                <td class="align-middle">{{ $vendedor->descripcion }}</td>
                                                <td class="align-middle">
                                                    <button wire:click="showVendorProducts({{ $vendedor->id }})"
                                                            class="btn btn-sm btn-primary">
                                                        Ver Productos
                                                    </button>
                                                </td>
                                                <td class="align-middle">
                                                    <button type="button"
                                                            class="btn btn-sm btn-info"
                                                            data-bs-toggle="modal"
                                                            data-bs-target="#vendedorModal{{ $vendedor->id }}">
                                                        Ver Detalles
                                                    </button>

                                                    <!-- Modal de Detalles del Vendedor -->
                                                    <div class="modal fade" id="vendedorModal{{ $vendedor->id }}" tabindex="-1" aria-hidden="true">
                                                        <div class="modal-dialog modal-lg">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title">Detalles del Vendedor</h5>
                                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <div class="row">
                                                                        <div class="col-md-4">
                                                                            <img src="{{ asset($vendedor->foto) }}"
                                                                                 alt="{{ $vendedor->nombre }}"
                                                                                 class="img-fluid rounded">
                                                                        </div>
                                                                        <div class="col-md-8">
                                                                            <h6>Información del Vendedor</h6>
                                                                            <p><strong>Nombre:</strong> {{ $vendedor->nombre }}</p>
                                                                            <p><strong>Teléfono:</strong> {{ $vendedor->telefono }}</p>
                                                                            <p><strong>Dirección:</strong> {{ $vendedor->direccion }}</p>
                                                                            <p><strong>Descripción:</strong> {{ $vendedor->descripcion }}</p>
                                                                            <p><strong>Fecha de registro:</strong> {{ $vendedor->created_at->format('d/m/Y H:i') }}</p>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>

                                <div class="mt-4">
                                    {{ $vendedores->links() }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Modal de Productos del Vendedor -->
        @if($selectedVendor)
            <div class="modal fade show" id="vendorProductsModal" style="display: block;" aria-modal="true" role="dialog">
                <div class="modal-dialog modal-xl">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Productos de {{ $selectedVendor->nombre }}</h5>
                            <button type="button" class="btn-close" wire:click="closeVendorModal"></button>
                        </div>
                        <div class="modal-body">
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                    <tr>
                                        <th>Imagen</th>
                                        <th>Nombre</th>
                                        <th>Precio CUP</th>
                                        <th>Precio USD</th>
                                        <th>Stock</th>
                                        <th>Categoría</th>
                                        <th>Acciones</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @forelse($selectedVendor->productos as $producto)
                                        <tr>
                                            <td>
                                                <img src="{{ asset($producto->foto) }}"
                                                     alt="{{ $producto->nombre }}"
                                                     class="img-thumbnail"
                                                     style="width: 60px; height: 60px; object-fit: cover;">
                                            </td>
                                            <td>
                                                <a href="{{ route('detalles', ['id' => $producto->id]) }}"
                                                   class="text-primary text-decoration-none">
                                                    {{ $producto->nombre }}
                                                </a>
                                            </td>
                                            <td>${{ number_format($producto->preciocup, 2) }}</td>
                                            <td>${{ $producto->preciousd ? number_format($producto->preciousd, 2) : 'N/A' }}</td>
                                            <td>{{ $producto->stock }}</td>
                                            <td>{{ $producto->categoria->nombre ?? 'Sin categoría' }}</td>
                                            <td>
                                                <a href="{{ route('detalles', ['id' => $producto->id]) }}"
                                                   class="btn btn-sm btn-info">
                                                    Ver Detalles
                                                </a>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="7" class="text-center">Este vendedor no tiene productos registrados</td>
                                        </tr>
                                    @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-backdrop fade show"></div>
        @endif
    </main>
</div>
