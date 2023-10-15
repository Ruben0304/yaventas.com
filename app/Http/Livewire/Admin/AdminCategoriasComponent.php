<?php

namespace App\Http\Livewire\Admin;

use App\Models\Categoria;
use Livewire\Component;
use Livewire\WithPagination;

class AdminCategoriasComponent extends Component
{
    public $nombre;
    public $editar;
    public $cid;
    use WithPagination; 
    public function render()
    {
        $categorias=Categoria::orderBy('created_at', 'desc')->paginate(10);
        return view('livewire.admin.admin-categorias-component',[
            
            'categorias'=>$categorias
    ]);
    }
    public function agregar_categoria()
    {
        Categoria::create([
            'nombre'=> $this->nombre,
            
       ]);
    
    }
    public function eliminar_categoria($id)
    {
        Categoria::destroy($id);
    
    }
   
    
}
