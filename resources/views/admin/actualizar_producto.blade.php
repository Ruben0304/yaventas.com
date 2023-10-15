@extends('admin.template')
@section('contenido')
    
<section class="formularios">
{{-- Actualizar Productos --}}

<form action="{{route('buscar_producto_id')}}" method="POST" >
    @csrf
     <div class="formulario">
     
    
     
     
 
      <div class="form-group">
         <label for="example-text-input" class="form-control-label">Id del producto</label>
         <input class="form-control" type="text"  name="id" required>
     </div>
     </div>
     <button type="submit" class="btn bg-gradient-success">Buscar</button>
     <input class="form-control" type="hidden" value="{{Auth::user()->id}}" name="uid" required>
 </div>
 </div>
 
 </form>

 @if (isset($producto_encontrado))

 @if ($error=="no pertenece a vendedor")

     <script>alert("El producto no le pertenece. Intente introducir nuevamente el Id o contacte con nosotros.")</script>
     @else
     



<form action="{{route('actualizando_producto')}}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')
     <div class="formulario">
 
 <div class="form-group">
    <label for="example-text-input" class="form-control-label">Nombre</label>
    <input class="form-control" type="text"  name="nombre" value="{{$producto_encontrado->nombre}}" required>
</div>

     <div class="form-group">
         <label for="example-number-input" class="form-control-label">Precio CUP</label>
         <input class="form-control" type="number" value="{{$producto_encontrado->preciocup}}" name="preciocup">
     </div>
     
     <div class="form-group">
         <label for="example-number-input" class="form-control-label">Precio USD</label>
         <input class="form-control" type="number" value="{{$producto_encontrado->preciousd}}" name="preciousd">
     </div>
 
    
     <div class="form-group">
         <label for="example-number-input" class="form-control-label">Stock</label>
         <input class="form-control" type="number" value="{{$producto_encontrado->stock}}" name="stock" required>
     </div>
     <hr>

    <h4>Oferta por tiempo limitado (Opcional)</h4>
     <div class="form-group">
         <label for="example-number-input" class="form-control-label">Hasta que dia sera la oferta ?</label>
         <input class="form-control" type="date" name="duraciono" >
     </div>
     <div class="form-group">
         <label for="example-number-input" class="form-control-label">Precio CUP</label>
         <input class="form-control" type="number" value="null" name="preciocupo">
     </div>
     
     <div class="form-group">
         <label for="example-number-input" class="form-control-label">Precio USD</label>
         <input class="form-control" type="number" value="null" name="preciousdo">
     </div>
     <div class="form-group">
        <label for="example-text-input" class="form-control-label">Motivo de la oferta (Opcional)</label>
        <input class="form-control" type="text"  name="motivo"  placeholder="No sera visible para el cliente.">
    </div>
     <span style="color: red; font-weight:bold">CUIDADO: Si pone el producto en oferta no podra deshacerlo hasta que se cumpla la fecha que usted determino como fin de la rebaja. Esto lo hacemos por cuestion de seriedad con nuestros clientes. </span>
     <hr>
     <div class="form-group">
        <input class="form-control" type="hidden" value="{{$producto_encontrado->id}}" name="id" required>
         <input class="form-control" type="hidden" value="{{Auth::user()->id}}" name="uid" required>
     </div>
     <button type="submit" class="btn bg-gradient-success">Actualizar</button>
 
 </div>
 </div>
 
 </form>
 

 @endif
 @else
 @endif
</section>
@endsection