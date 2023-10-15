<?php

namespace App\Http\Livewire\Admin;

use App\Models\Carrito;
use App\Models\Producto;
use Livewire\Component;
use Livewire\WithPagination;

class AdminProductosComponent extends Component
{
    use WithPagination;
    public function render()
    {
        $productos = Producto::orderBy('created_at', 'desc')->paginate(10);

        return view('livewire.admin.admin-productos-component', [
            'productos' => $productos,

        ]);
    }
    public function eliminar_producto($id)
    {
        //Eliminando productos





        $producto = Producto::find($id)->first();
        $carrito = Carrito::where('id_producto', $id)->get();
        $detalle = Carrito::where('id_producto', $id)->get();
        $error = null;

       


            foreach ($carrito as $item) {
                Carrito::destroy([
                    'id' => $item->id,


                ]);
            }



            Producto::destroy([
                'id' => $id,


            ]);
        }
    }

