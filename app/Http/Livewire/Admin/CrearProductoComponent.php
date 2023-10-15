<?php

namespace App\Http\Livewire\Admin;

use App\Models\Categoria;
use App\Models\Vendedore;
use Livewire\Component;

class CrearProductoComponent extends Component
{
    public function render()
    {
        $vendedores=Vendedore::all();
        $categoria=Categoria::all();
        return view('livewire.admin.crear-producto-component',['vendedores'=>$vendedores,'categorias'=>$categoria]);
    
      

    }
   
}
