<?php

namespace App\Http\Controllers;

use App\Models\Carrito;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public static function agregar_carrito($id, $cant)
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
        }


        return redirect(route('home'));

    }

    public static function quitar_carrito($id)
    {


        Carrito::destroy(['id' => $id]);


    }

    public static function limpiar_carrito($id)
    {


        Carrito::where('id_user', $id)->delete();


    }


//restar carrito
    public static function restar_carrito($id)
    {

        $actcarrito = Carrito::find($id);

        if ($actcarrito->cantidad < ($actcarrito->producto->stock) + 1) {

            if ($actcarrito->cantidad == 1) {
                Carrito::destroy([
                    'id' => $id,
                ]);
            } else {
                $actcarrito->cantidad -= 1;
                $actcarrito->save();
            }
        } else {
            $actcarrito->cantidad = $actcarrito->producto->stock;
            $actcarrito->save();
        }


    }

//sumar carrito
    public static function sumar_carrito($id)
    {


        $actcarrito = Carrito::find($id);
        if ($actcarrito->cantidad < $actcarrito->producto->stock) {

            $actcarrito->cantidad += 1;
            $actcarrito->save();
        } else {
            $actcarrito->cantidad = $actcarrito->producto->stock;

            $actcarrito->save();
        }


    }
}
