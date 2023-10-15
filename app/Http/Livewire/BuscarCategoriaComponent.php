<?php

namespace App\Http\Livewire;

use App\Models\Categoria;
use App\Models\Oferta;
use App\Models\Producto;
use Illuminate\Http\Request;
use Livewire\Component;

class BuscarCategoriaComponent extends Component
{
    public function render(Request $request)
    {
        
            $categoria = $request->categoria;
            
                    $productos=  Producto::where('id_categoria',$categoria)->get();
                    $productosnuevos=Producto::orderBy('created_at', 'DESC')->paginate(3);
                    $oferta=Oferta::where('fecha_final', '>=', date('Y-m-d'))->get();
                      return view('livewire.comprar-component',[
                          
                          'productos'=>$productos,
                          'categorias'=>Categoria::all(),
                          'productosnuevos' => $productosnuevos,
                          'oferta'=>$oferta,
                          
                      ]
                  );
                      
                  
       
    }
}
