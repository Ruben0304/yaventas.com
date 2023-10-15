<div>
    <style>
        nav svg{
            height: 20px;

        }
        nav .hidden{
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
Crear Producto
                        </div>
                        <div class="card-body">
                            <form action="{{route('crear_producto')}}" method="POST" enctype="multipart/form-data">
                                @csrf
                                
                                 <div class="formulario">
                             
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Imagen Princpipal</label>
                                        <input class="form-control" type="file"  name="foto" accept="image/*" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Imagen 2 (Opcional)</label>
                                        <input class="form-control" type="file"  name="foto2" accept="image/*" >
                                    </div>
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Imagen 3 (Opcional)</label>
                                        <input class="form-control" type="file"  name="foto3" accept="image/*" >
                                    </div>

                             <div class="form-group">
                                <label for="example-text-input" class="form-control-label">Nombre</label>
                                <input class="form-control" type="text"  name="nombre"  required>
                            </div>
                            
                                 <div class="form-group">
                                     <label for="example-number-input" class="form-control-label">Precio</label>
                                     <input class="form-control" type="number"  name="preciocup">
                                 </div>
                                 <div class="form-group">
                                    <label for="example-number-input" class="form-control-label">Color</label>
                                    <input class="form-control" type="color"  name="color" required>
                                </div>
                                 
                                 {{-- <div class="form-group">
                                     <label for="example-number-input" class="form-control-label">Precio USD</label>
                                     <input class="form-control" type="number" value="{{$producto->preciousd}}" name="preciousd">
                                 </div> --}}
                             
                                
                                 <div class="form-group">
                                     <label for="example-number-input" class="form-control-label">Disponibilidad</label>
                                     <input class="form-control" type="number" value=0 name="stock" required>
                                 </div>
                                 <div class="form-group">
                                    <label for="example-number-input" class="form-control-label">Categoria</label>
                                   
                                    <select name="categoria">@foreach ($categorias as $categoria)
                                        <option value="{{$categoria->id}}">{{$categoria->nombre}}</option>
                                    @endforeach</select>
                                </div>
                                <div class="form-group">
                                    <label for="example-number-input" class="form-control-label">Vendedor</label>
                                   
                                    <select name="vendedor">@foreach ($vendedores as $vendedor)
                                        <option value="{{$vendedor->id}}">{{$vendedor->nombre}}</option>
                                    @endforeach</select>
                                </div>
                                 <hr>
                            
                               
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
