<?php

namespace App\Http\Livewire;

use App\Models\Categoria;
use Livewire\Component;

class Navigation extends Component
{
    public $activeMenu;
    public $categorias = null;

    public function mount()
    {
        $this->activeMenu = request()->route()->getName();
        $this->categorias = Categoria::all();

    }

    public function setActiveMenu($route)
    {
        $this->activeMenu = $route;
    }

    public function render()
    {
        return view('livewire.navigation');
    }
}
