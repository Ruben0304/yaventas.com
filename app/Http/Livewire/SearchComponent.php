<?php

namespace App\Http\Livewire;

use App\Models\Carrito;
use App\Models\Categoria;
use App\Models\Oferta;
use App\Models\Producto;
use Livewire\Component;
use Illuminate\Http\Request;
use Livewire\WithPagination;
class SearchComponent extends Component
{
    use WithPagination;
public $minimo = 1;
public $maximo = 5000;
public $orderBy = "Default";
public $buscar;
public $peticion;

public function mount(){
    $this->fill(request()->only('buscar'));
    $this->peticion = '%'.$this->buscar.'%';
}


public function cambiar_orden($order){
    $this->orderBy = $order;
}

    public function render()
    {   
         
       
        if ($this->orderBy == 'Precio: Menor a Mayor') {
            $productos=  Producto::where('nombre','like',$this->peticion)->orWhere('id_categoria', '=', $this->peticion)->whereBetween('preciocup',[$this->minimo,$this->maximo])->orderBy('preciocup','ASC')->paginate(12);
        
        }
        else if ($this->orderBy == ('Precio: Mayor a Menor')) {
            $productos =  Producto::where('nombre','like',$this->peticion)->orWhere('id_categoria', '=', $this->peticion)->whereBetween('preciocup',[$this->minimo,$this->maximo])->orderBy('preciocup','DESC')->paginate(12);
        
        }
        else if ($this->orderBy == 'Ultimos productos') {
            $productos =  Producto::where('nombre','like',$this->peticion)->orWhere('id_categoria', '=', $this->peticion)->whereBetween('preciocup',[$this->minimo,$this->maximo])->orderBy('created_at','DESC')->paginate(12);
        
        }
        else {
            $productos =  Producto::where('nombre','like',$this->peticion)->whereBetween('preciocup',[$this->minimo,$this->maximo])->paginate(12);
        
        }
        $categorias=Categoria::all();
        
      
            

                   
                  
                    $oferta=Oferta::where('fecha_final', '>=', date('Y-m-d'))->get();
                      return view('livewire.comprar-component',[
                          
                          'productos'=>$productos,
                          'categorias'=>$categorias,
                          
                          'oferta'=>$oferta,
                          
                      ]
                  );
                      
                  
       
    }
    
}
