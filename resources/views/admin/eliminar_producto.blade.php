@extends('admin.template')
@section('contenido')
    
{{-- Eliminar Productos --}}
@if (isset($error))
@if ($error=="no pertenece a vendedor")

<script>alert("El producto no le pertenece. Intente introducir nuevamente el Id o contacte con nosotros.")</script>
@endif

    
@endif

<form action="{{route('eliminando_producto')}}" method="POST" >
   @csrf
   @method('DELETE')
     <div class="formulario">
     
    <div class="form-group">
         <label for="example-text-input" class="form-control-label">Id del producto</label>
         <input class="form-control" type="text"  name="id" required>
     </div>
     </div>

    
     
     <button type="submit" class="btn bg-gradient-success" onclick="return  confirm('Esta seguro/a de que desea eliminar el producto')">Eliminar</button>
 
 </div>
 </div>
 
 </form>

 

@endsection