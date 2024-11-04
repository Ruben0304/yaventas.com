<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Navigation extends Component
{
    public $activeMenu;

    public function mount()
    {
        $this->activeMenu = request()->route()->getName();
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
