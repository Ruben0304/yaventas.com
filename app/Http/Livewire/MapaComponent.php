<?php

namespace App\Http\Livewire;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Livewire\Component;

class MapaComponent extends Component
{

    public $location = '';

    public function setLocation($lng, $lat)
    {
        $this->location = "{$lng},{$lat}";
    }

    public function continueToCheckout()
    {
        if ($this->location) {
            return redirect()->route('caja', ['location' => $this->location]);
        }
    }
    public function render()
    {
        return view('livewire.mapa-component');
    }
}
