<?php

namespace App\Http\Livewire;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class ShoppingCart extends Component
{
    public $cartItems;
    public $subtotal = 0;
    public $cartCount = 0;
    public $whatsapp = false;

    protected $listeners = ['cartUpdated' => 'loadCart'];

    public function mount()
    {
        $this->loadCart();
    }

    public function loadCart()
    {
        if (Auth::check()) {
            $this->cartItems = Auth::user()->carrito()->get();
            $this->calculateSubtotal();
            $this->cartCount = $this->cartItems->count();
        } else {
            $this->cartItems = new Collection();
            $this->cartCount = 0;
            $this->subtotal = 0;
        }
    }

    public function removeFromCart($itemId)
    {
        if (Auth::check()) {
            // Asumiendo que tienes un modelo Carrito
            $cartItem = \App\Models\Carrito::find($itemId);
            if ($cartItem && $cartItem->id_user === Auth::id()) {
                $cartItem->delete();
                $this->loadCart();
                $this->emit('cartUpdated');
            }
        }
    }

    private function calculateSubtotal()
    {
        $this->subtotal = $this->cartItems->sum(function ($item) {
            $price = $this->whatsapp
                ? $item->producto->preciocup
                : $item->producto->preciocup + 0.1 * $item->producto->preciocup;
            return $price * $item->cantidad;
        });
    }

    public function render()
    {
        return view('livewire.shopping-cart');
    }
}
