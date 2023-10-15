<?php

namespace App\Http\Livewire;

use App\Models\Carrito;
use App\Models\Categoria;
use Livewire\Component;

class CarritoComponent extends Component
{
    public function quitar_carrito($id){

    

        Carrito::destroy(['id' => $id]);
    
    
    
        
    
    }
    public function limpiar_carrito($id){

    

        Carrito::where('id_user', $id)->delete();
    
    
    
        
    
    }


//restar carrito
public function restar_carrito($id ){

    $actcarrito=Carrito::find($id);

    if ($actcarrito->cantidad<($actcarrito->producto->stock)+1) {
        
        if ($actcarrito->cantidad==1) {
            Carrito::destroy([
                'id' => $id,
            ]);
        }else {
            $actcarrito->cantidad-=1;
            $actcarrito->save();
        } 
    }else {
        $actcarrito->cantidad=$actcarrito->producto->stock;
        $actcarrito->save();
    }



   
   
       
   

}

//sumar carrito
public function sumar_carrito($id){

    

   
    $actcarrito=Carrito::find($id);
    if ($actcarrito->cantidad<$actcarrito->producto->stock) {
        
        $actcarrito->cantidad+=1;
        $actcarrito->save();
    }else {
        $actcarrito->cantidad=$actcarrito->producto->stock;
        
        $actcarrito->save();
    }
 

}


    public function render()
    {
      
       

        return view('livewire.carrito-component',[
            'carrito'=>Carrito::all(),
           
            'categorias'=>Categoria::all()
        ]
    );

       
    }
}
