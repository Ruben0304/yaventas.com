<div>
    <style>
        nav svg { height: 20px; }
        nav .hidden { display: block; }
    </style>

    <main class="main">
        <div class="page-header breadcrumb-wrap">
            <div class="container">
                <div class="breadcrumb">
                    <a href="/" rel="nofollow">Home</a>
                    <span></span> Productos
                </div>
            </div>
        </div>

        <section class="mt-50 mb-50">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header d-flex justify-content-between align-items-center">
                                <span>{{ $modo === 'lista' ? 'Todos los productos' : ($modo === 'crear' ? 'Crear Producto' : 'Editar Producto') }}</span>
                                @if($modo === 'lista')
                                    <button wire:click="cambiarModo('crear')" class="btn btn-primary">Crear Producto</button>
                                @else
                                    <button wire:click="cambiarModo('lista')" class="btn btn-secondary">Volver a la lista</button>
                                @endif
                            </div>

                            <div class="card-body">
                                @if (session()->has('message'))
                                    <div class="alert alert-success">
                                        {{ session('message') }}
                                    </div>
                                @endif

                                @if($modo === 'lista')
                                    {{-- Tabla de productos --}}
                                    <table class="table table-striped">
                                        <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Nombre</th>
                                            <th>CUP</th>
                                            <th>Stock</th>
                                            <th>Color</th>
                                            <th>Vendedor</th>
                                            <th>Categoria</th>
                                            <th>Acciones</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach ($productos as $producto)
                                            <tr>
                                                <td>{{$producto->id}}</td>
                                                <td>{{$producto->nombre}}</td>
                                                <td>{{$producto->preciocup}}</td>
                                                <td>{{$producto->stock}}</td>
                                                <td>
                                                    <div style="width: 20px; height: 20px; background-color: {{$producto->color}}; border: 1px solid #ddd;"></div>
                                                </td>
                                                <td>{{$producto->vendedor->nombre}}</td>
                                                <td>{{$producto->categoria->nombre}}</td>
                                                <td>
                                                    <button wire:click="editar({{$producto->id}})" class="btn btn-sm btn-primary">Editar</button>
                                                    <button wire:click="eliminar_producto({{$producto->id}})" class="btn btn-sm btn-danger" onclick="confirm('¿Está seguro?') || event.stopImmediatePropagation()">Eliminar</button>
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                    {{$productos->links()}}
                                @else
                                    {{-- Formulario crear/editar --}}
                                    <form wire:submit.prevent="{{ $modo === 'crear' ? 'crear' : 'actualizar' }}">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group mb-3">
                                                    <label>Nombre</label>
                                                    <input type="text" class="form-control" wire:model="nombre">
                                                    @error('nombre') <span class="text-danger">{{ $message }}</span> @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group mb-3">
                                                    <label>Precio CUP</label>
                                                    <input type="number" class="form-control" wire:model="preciocup">
                                                    @error('preciocup') <span class="text-danger">{{ $message }}</span> @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group mb-3">
                                                    <label>Color</label>
                                                    <input type="color" class="form-control" wire:model="color">
                                                    @error('color') <span class="text-danger">{{ $message }}</span> @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group mb-3">
                                                    <label>Stock</label>
                                                    <input type="number" class="form-control" wire:model="stock">
                                                    @error('stock') <span class="text-danger">{{ $message }}</span> @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group mb-3">
                                                    <label>Vendedor</label>
                                                    <select class="form-control" wire:model="id_vendedor">
                                                        <option value="">Seleccionar...</option>
                                                        @foreach($vendedores as $vendedor)
                                                            <option value="{{ $vendedor->id }}">{{ $vendedor->nombre }}</option>
                                                        @endforeach
                                                    </select>
                                                    @error('id_vendedor') <span class="text-danger">{{ $message }}</span> @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group mb-3">
                                                    <label>Categoría</label>
                                                    <select class="form-control" wire:model="id_categoria">
                                                        <option value="">Seleccionar...</option>
                                                        @foreach($categorias as $categoria)
                                                            <option value="{{ $categoria->id }}">{{ $categoria->nombre }}</option>
                                                        @endforeach
                                                    </select>
                                                    @error('id_categoria') <span class="text-danger">{{ $message }}</span> @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group mb-3">
                                                    <label>Descripción</label>
                                                    <textarea class="form-control" wire:model="descripcion" rows="3"></textarea>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group mb-3">
                                                    <label>Imagen Principal</label>
                                                    <input type="file" class="form-control" wire:model="foto">
                                                    @error('foto') <span class="text-danger">{{ $message }}</span> @enderror
                                                    @if($modo === 'editar' && !$foto)
                                                        <img src="{{ asset('storage/'.$producto->foto) }}" width="120" alt="Imagen principal">
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group mb-3">
                                                    <label>Imagen 2 (Opcional)</label>
                                                    <input type="file" class="form-control" wire:model="foto2">
                                                    @if($modo === 'editar' && !$foto2 && $producto->foto_2)
                                                        <img src="{{ asset('storage/'.$producto->foto_2) }}" width="120" alt="Imagen 2">
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group mb-3">
                                                    <label>Imagen 3 (Opcional)</label>
                                                    <input type="file" class="form-control" wire:model="foto3">
                                                    @if($modo === 'editar' && !$foto3 && $producto->foto_3)
                                                        <img src="{{ asset('storage/'.$producto->foto_3) }}" width="120" alt="Imagen 3">
                                                    @endif
                                                </div>
                                            </div>

                                            @if($modo === 'editar')
                                                <div class="col-12 mt-4">
                                                    <h4>Oferta por tiempo limitado (Opcional)</h4>
                                                    <div class="row">
                                                        <div class="col-md-3">
                                                            <div class="form-group mb-3">
                                                                <label>Fecha fin de oferta</label>
                                                                <input type="date" class="form-control" wire:model="duraciono">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <div class="form-group mb-3">
                                                                <label>Precio CUP oferta</label>
                                                                <input type="number" class="form-control" wire:model="preciocupo">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <div class="form-group mb-3">
                                                                <label>Precio USD oferta</label>
                                                                <input type="number" class="form-control" wire:model="preciousdo">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <div class="form-group mb-3">
                                                                <label>Motivo de la oferta</label>
                                                                <input type="text" class="form-control" wire:model="motivo">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endif

                                            <div class="col-12 mt-4">
                                                <button type="submit" class="btn btn-primary">
                                                    {{ $modo === 'crear' ? 'Crear Producto' : 'Actualizar Producto' }}
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
</div>
