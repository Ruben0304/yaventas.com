<div>
    <main class="main">
        <div class="page-header breadcrumb-wrap">
            <div class="container">
                <div class="breadcrumb">
                    <a href="{{route('home')}}" rel="nofollow">Home</a>
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
                                <div class="d-flex gap-3">
                                    <div class="input-group" style="width: 300px;">
                                        <input wire:model.debounce.300ms="search" type="text" class="form-control"
                                               placeholder="Buscar por nombre, teléfono o dirección...">
                                    </div>
                                    <button wire:click="create" class="btn btn-primary">
                                        Nuevo Vendedor
                                    </button>
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
                                            <th>Acciones</th>
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
                                                    <div class="btn-group">
                                                        <button wire:click="edit({{ $vendedor->id }})"
                                                                class="btn btn-sm btn-info me-2">
                                                            Editar
                                                        </button>
                                                        <button wire:click="delete({{ $vendedor->id }})"
                                                                class="btn btn-sm btn-danger"
                                                                onclick="return confirm('¿Estás seguro de eliminar este vendedor?')">
                                                            Eliminar
                                                        </button>
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

        <!-- Modal de Crear/Editar -->
        @if($showModal)
            <div class="modal fade show" style="display: block;" aria-modal="true" role="dialog">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">{{ $isEditing ? 'Editar' : 'Crear' }} Vendedor</h5>
                            <button type="button" class="btn-close" wire:click="$set('showModal', false)"></button>
                        </div>
                        <div class="modal-body">
                            <form wire:submit.prevent="save">
                                <div class="mb-3">
                                    <label class="form-label">Nombre</label>
                                    <input type="text" class="form-control" wire:model="nombre">
                                    @error('nombre') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Teléfono</label>
                                    <input type="text" class="form-control" wire:model="telefono">
                                    @error('telefono') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Dirección</label>
                                    <input type="text" class="form-control" wire:model="direccion">
                                    @error('direccion') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Descripción</label>
                                    <textarea class="form-control" wire:model="descripcion" rows="3"></textarea>
                                    @error('descripcion') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Foto</label>
                                    <input type="file" class="form-control" wire:model="foto">
                                    @error('foto') <span class="text-danger">{{ $message }}</span> @enderror

                                    <div class="mt-2">
                                        @if ($foto)
                                            <img src="{{ $foto->temporaryUrl() }}" class="img-thumbnail" style="width: 200px">
                                        @elseif ($tempFoto)
                                            <img src="{{ asset($tempFoto) }}" class="img-thumbnail" style="width: 200px">
                                        @endif
                                    </div>
                                </div>

                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" wire:click="$set('showModal', false)">
                                        Cancelar
                                    </button>
                                    <button type="submit" class="btn btn-primary">
                                        {{ $isEditing ? 'Actualizar' : 'Guardar' }}
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-backdrop fade show"></div>
        @endif

        <!-- Modal de Productos -->
        @if($showProductsModal && $selectedVendor)
            <div class="modal fade show" style="display: block;" aria-modal="true" role="dialog">
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
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" wire:click="closeVendorModal">
                                Cerrar
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-backdrop fade show"></div>
        @endif
    </main>
</div>
