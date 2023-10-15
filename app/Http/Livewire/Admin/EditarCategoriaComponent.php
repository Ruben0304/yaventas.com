<?php

namespace App\Http\Livewire\Admin;

use App\Models\Categoria;
use Illuminate\Http\Request;
use Livewire\Component;

class EditarCategoriaComponent extends Component
{
    
    
    public function render(Request $request)
    {
        $categoria=Categoria::find($request->id);
        return view('livewire.admin.editar-categoria-component',['categoria'=>$categoria]);
    }
}
