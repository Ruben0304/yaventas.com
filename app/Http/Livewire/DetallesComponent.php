<?php

namespace App\Http\Livewire;

use App\Models\Carrito;
use App\Models\Categoria;
use App\Models\Producto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class DetallesComponent extends Component
{
    public function login($id)
    {
        setcookie('product', $id, time() + 20 * 60);
            return redirect(route('login'));
        
    }
    public function agregar_carrito($id, $cant)
    {
        
            $carrito_exist = Carrito::where('id_user', Auth::user()->id)->where('id_producto', $id)->first();

            if ($carrito_exist) {



                $actcarrito = Carrito::find($carrito_exist->id);
                $actcarrito->cantidad = $cant + $carrito_exist->cantidad;
                $actcarrito->save();
            } else {
                Carrito::create([
                    'id_user' => Auth::user()->id,
                    'id_producto' => $id,
                    'cantidad' => $cant
                ]);
            
            return redirect(route('carrito'));
        }
    }
    public function renderi()
    {
        return redirect(route('home'));
    }
    public function render(Request $request)
    {
        $producto = Producto::find($request->id);
        $productos = Producto::where('nombre', $producto->nombre)->get();

        return view('livewire.detalles-component', [
            'producto' => $producto,
            'productos' => $productos,
            'valoracion' => $producto->valoracion,


            'categorias' => Categoria::all()
        ]);
    }
}
