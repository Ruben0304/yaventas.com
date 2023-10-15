<?php

namespace App\Http\Livewire;

use App\Models\Ordene;
use App\Models\Whatsapp;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class DashboardComponent extends Component
{
    public function render()
    {
        $whatsapp = Whatsapp::where('id_user', Auth::user()->id)->first() ?? false;
        $ordenes = Ordene::where('id_user', Auth::user()->id)->orderBy('created_at','desc')->first();
        return view('livewire.dashboard-component',['ordenes' => $ordenes,'whatsapp' => $whatsapp]);
    }
}
