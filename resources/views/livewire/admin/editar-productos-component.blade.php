<div>
    <style>
        nav svg {
            height: 20px;

        }

        nav .hidden {
            display: block;
        }
    </style>
    <main class="main">
        <div class="page-header breadcrumb-wrap">
            <div class="container">
                <div class="breadcrumb">
                    <a href="index.html" rel="nofollow">Home</a>

                    <span></span> Productos
                </div>
            </div>
        </div>
        <section class="mt-50 mb-50">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                Editar Producto
                            </div>
                            <div class="card-body">
                                <form action="{{ route('actualizando_producto') }}" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')
                                    <div class="formulario">
                                        <div class="form-group">
                                            <label for="example-text-input" class="form-control-label">Imagen
                                                Princpipal</label>
                                            <input class="form-control" type="file" name="foto" accept="image/*">
                                        </div>
                                        <div class="form-group">
                                            <label for="example-text-input" class="form-control-label">Imagen 2
                                                (Opcional)</label>
                                            <input class="form-control" type="file" name="foto2" accept="image/*">
                                        </div>
                                        <div class="form-group">
                                            <label for="example-text-input" class="form-control-label">Imagen 3
                                                (Opcional)</label>
                                            <input class="form-control" type="file" name="foto3" accept="image/*">
                                        </div>
                                        <div class="form-group">
                                            <label for="example-text-input" class="form-control-label">Nombre</label>
                                            <input class="form-control" type="text" name="nombre"
                                                value="{{ $producto->nombre }}" required>
                                        </div>

                                        <div class="form-group">
                                            <label for="example-number-input" class="form-control-label">Precio</label>
                                            <input class="form-control" type="number"
                                                value="{{ $producto->preciocup }}" name="preciocup">
                                        </div>
                                        
                                        <div class="form-group">
                                            <label for="example-number-input" class="form-control-label">Color</label>
                                            <input class="form-control" type="color" name="color"
                                                value="{{ $producto->color }}" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="example-number-input" class="form-control-label">Descripcion</label>
                                            <textarea name="descripcion"  cols="30" rows="10" class="form-control" {{ $producto->descripcion }}></textarea>
                                            
                                        </div>
                                        {{-- <div class="form-group">
                                     <label for="example-number-input" class="form-control-label">Precio USD</label>
                                     <input class="form-control" type="number" value="{{$producto->preciousd}}" name="preciousd">
                                 </div> --}}


                                        <div class="form-group">
                                            <label for="example-number-input" class="form-control-label">Stock</label>
                                            <input class="form-control" type="number" value="{{ $producto->stock }}"
                                                name="stock" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="example-number-input"
                                                class="form-control-label">Categoria</label>

                                            <select name="categoria">
                                                <option value="{{ $producto->vendedor->id }}" selected>
                                                    {{ $producto->vendedor->nombre }} </option>
                                                @foreach ($categorias as $categoria)
                                                    <option value="{{ $categoria->id }}">{{ $categoria->nombre }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="example-number-input"
                                                class="form-control-label">Vendedor</label>

                                            <select name="vendedor">
                                                <option value="{{ $producto->vendedor->id }}" selected>
                                                    {{ $producto->vendedor->nombre }}</option>
                                                @foreach ($vendedores as $vendedor)
                                                    <option value="{{ $vendedor->id }}">{{ $vendedor->nombre }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <hr>

                                        <h4>Oferta por tiempo limitado (Opcional)</h4>
                                        <div class="form-group">
                                            <label for="example-number-input" class="form-control-label">Hasta que dia
                                                sera la oferta ?</label>
                                            <input class="form-control" type="date" name="duraciono">
                                        </div>
                                        <div class="form-group">
                                            <label for="example-number-input" class="form-control-label">Precio
                                                CUP</label>
                                            <input class="form-control" type="number" value="null" name="preciocupo">
                                        </div>

                                        <div class="form-group">
                                            <label for="example-number-input" class="form-control-label">Precio
                                                USD</label>
                                            <input class="form-control" type="number" value="null" name="preciousdo">
                                        </div>
                                        <div class="form-group">
                                            <label for="example-text-input" class="form-control-label">Motivo de la
                                                oferta (Opcional)</label>
                                            <input class="form-control" type="text" name="motivo"
                                                placeholder="No sera visible para el cliente.">
                                        </div>
                                        <span style="color: red; font-weight:bold">CUIDADO: Si pone el producto en
                                            oferta no podra deshacerlo hasta que se cumpla la fecha que usted determino
                                            como fin de la rebaja. Esto lo hacemos por cuestion de seriedad con nuestros
                                            clientes. </span>
                                        <hr>
                                        <div class="form-group">
                                            <input class="form-control" type="hidden" value="{{ $producto->id }}"
                                                name="id" required>
                                            <input class="form-control" type="hidden"
                                                value="{{ Auth::user()->id }}" name="uid" required>
                                        </div>
                                        <button type="submit" class="btn bg-gradient-success">Actualizar</button>

                                    </div>
                            </div>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
</div>
</section>
</main>
</div>
