<?php

namespace App\Http\Livewire;

use Livewire\Component;

class MapaComponent extends Component
{
    public $location = '';

    protected $listeners = ['locationUpdated'];

    public function locationUpdated($lng, $lat)
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
