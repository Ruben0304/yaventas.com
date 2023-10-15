
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
Todas los productos
                        </div>
                        <div class="card-body">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Nombre</th>
                                        <th>CUP</th>
                                        <th>USD</th>
                                        <th>Stock</th>
                                        <th>Color</th>
                                        <th>Vendedor</th>
                                        <th>Categoria</th>
                                    </tr>
                                </thead>
<tbody>
    @foreach ($productos as $producto)
        <tr>
            <td>{{$producto->id}}</td>
            <td>{{$producto->nombre}}</td>
            <td>{{$producto->preciocup}}</td>
            <td>{{$producto->preciousd}}</td>
            <td>{{$producto->stock}}</td>
            <td>{{$producto->color}}</td>
            <td>{{$producto->vendedor->nombre}}</td>
            <td>{{$producto->categoria->nombre}}</td>
            <td style="display: flex; justify-content:space-between"> <a href="{{route('admin.editar.productos','id='.$producto->id.'')}}"> Editar</a> <a href="" wire:click.prevent="eliminar_producto({{$producto->id}})"><i class="fi-rs-trash"></i></a></td>
        </tr>
    @endforeach
</tbody>
                            </table>
{{$productos->links()}}
                        </div>
                    </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
</div>
