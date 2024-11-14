<?php

namespace App\Http\Livewire\Admin;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class AdminPedidos extends Component
{
    public function render()
    {
        $ordenes = Auth::user()->orders()->paginate(8);
        $orden_detalles = Auth::user()->ordersDetails()->paginate(8);

        $completados = $ordenes->filter(function ($orden) {
            return $orden->estado == 'COMPLETADA';
        })->count();

        return view('livewire.admin.admin-pedidos', [
            'ordenes' => $ordenes,
            'orden_detalles' => $orden_detalles,
            'completados' => $completados,
        ]);
    }
}
