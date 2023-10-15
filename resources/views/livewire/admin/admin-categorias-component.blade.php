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
                    
                    <span></span> Categorias
                </div>
            </div>
        </div>
        <section class="mt-50 mb-50">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                    <div class="card">
                        <div class="card-header">
Todas las Categorias
                        </div>
                        <div class="card-body">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Nombre</th>
                                        <th>Slug</th>
                                        <th>Accion</th>
                                    </tr>
                                </thead>
<tbody>
    @php
        $i = ($categorias->currentPage()-1)*$categorias->perPage();
    @endphp
    @foreach ($categorias as $categoria)
        <tr>
            <td>{{++$i}}</td>
            <td>  {{$categoria->nombre}}</td>
            <td>{{$categoria->nombre}}</td>
            
            <td style="display: flex; justify-content:space-between"> <a href="{{route('admin.editar.categoria','id='.$categoria->id.'')}}"> Editar</a> <a href="" wire:click.prevent="eliminar_categoria({{$categoria->id}})"><i class="fi-rs-trash"></i></a></td>
        </form>        
        </tr>
    @endforeach
    <tr>
        <form wire:submit.prevent="agregar_categoria" method="POST">
            <td><input type="text" placeholder="Agregar Categoria" wire:model="nombre"/></td>
            {{-- <td><input type="se" placeholder="Agregar Categoria"></td> --}}
            <td><button type="submit">Agregar</button></td>

        </form>
       
    </tr>  
</tbody>
                            </table>
{{$categorias->links()}}
                        </div>
                    </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
</div>

