<?php

namespace App\Http\Livewire;

use App\Models\Carrito;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class ProductCard extends Component
{

    public $producto;
    public $whatsapp;

    public function mount($producto, $whatsapp)
    {
        $this->producto = $producto;
        $this->whatsapp = $whatsapp;
    }

    public function agregarAlCarrito()
    {
        // Asegúrate de que el usuario esté autenticado
        if (Auth::check()) {
            // Obtener el carrito del usuario o crear uno nuevo si no existe
            $carrito = Carrito::firstOrCreate(
                ['id_user' => Auth::id(), 'id_producto' => $this->producto->id],
                ['cantidad' => 0]
            );

            // Incrementar la cantidad
            $carrito->increment('cantidad');

            // Redirigir al carrito
            return redirect()->route('carrito');
        }
        else{
            return redirect()->route('login');
        }
    }
    public function render()
    {
        return view('livewire.product-card');
    }
}
