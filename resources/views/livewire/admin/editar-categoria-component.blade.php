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
Editar Categoria
                        </div>
                        <div class="card-body">
                           <form action="{{route('actualizar_categoria')}}" method="post">
                            @csrf
                          @method('PUT')
                        <div class="mb-3 mt-3">
                            <label for="nombre" class="form-label">Nombre</label>
<input type="text" name="nombre" class="form-control" value="{{$categoria->nombre}}">
<input type="hidden" name="id" class="form-control" value="{{$categoria->id}}">
@error('name')
    <p class="text-danger">{{$message}}</p>
@enderror
                        </div>
<button type="submit" class="btn btn-primary float-end">Aceptar</button>
                           </form>
                        </div>
                    </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
</div>
