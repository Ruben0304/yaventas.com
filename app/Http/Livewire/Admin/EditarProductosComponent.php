<?php

namespace App\Http\Livewire\Admin;

use App\Models\Categoria;
use App\Models\Producto;
use App\Models\Vendedore;
use Illuminate\Http\Request;
use Livewire\Component;

class EditarProductosComponent extends Component
{
    public function render(Request $request)
    {
        $vendedores=Vendedore::all();
        $categoria=Categoria::all();
        $producto=Producto::find($request->id);
        return view('livewire.admin.editar-productos-component',['vendedores'=>$vendedores,'categorias'=>$categoria,'producto'=>$producto]);
}
}