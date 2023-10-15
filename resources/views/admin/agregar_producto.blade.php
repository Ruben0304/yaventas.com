@extends('admin.template')
@section('contenido')
    
{{-- Agregar Productos --}}

<form action="{{route('crear_producto')}}" method="POST" enctype="multipart/form-data">
   @csrf
    <div class="formulario">
    
   
    
    <div class="inputs">
        <div class="form-group">
            <label for="example-text-input" class="form-control-label">Imagen</label>
            <input class="form-control" type="file"  name="foto" accept="image/*" required>
        </div>

     <div class="form-group">
        <label for="example-text-input" class="form-control-label">Nombre</label>
        <input class="form-control" type="text"  name="nombre" required>
    </div>
      
    <div class="form-group">
        <label for="example-number-input" class="form-control-label">Precio CUP</label>
        <input class="form-control" type="number" value="null" name="preciocup">
    </div>
    
    <div class="form-group">
        <label for="example-number-input" class="form-control-label">Precio USD</label>
        <input class="form-control" type="number" value="null" name="preciousd">
    </div>

    <div class="form-group">
        <label for="example-number-input" class="form-control-label">Stock</label>
        <input class="form-control" type="number" value="0" name="stock" required>
    </div>

    

    <input class="form-control" type="hidden" value="{{Auth::user()->id}}" name="uid" required>
    <button type="submit" class="btn bg-gradient-success">Agregar</button>

</div>
</div>

</form>




@endsection