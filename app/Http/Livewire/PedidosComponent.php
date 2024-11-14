<?php

namespace App\Http\Livewire;

use App\Models\Orden_detalle;
use App\Models\Ordene;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class PedidosComponent extends Component
{
    public function detalles(){



        // $carrito_exist=Cart::where('id_user',$request->uid)->where('id_producto',$request->pid)->first();

        // if ($carrito_exist) {



        // $actcarrito=Carrito::find($carrito_exist->id);
        // $actcarrito->cantidad=$request->cant+$carrito_exist->cantidad;
        // $actcarrito->save();
        // }else {
        //     Carrito::create([
        //         'id_user' => $request->uid,
        //         'id_producto' => $request->pid,
        //         'cantidad' => $request->cant
        //     ]);
        // }


        return redirect(route('detalles'));

    }

    public function render()
    {


        return view('livewire.pedidos-component',['ordenes'=>Ordene::where('id_user',''.Auth::user()->id.'')->orderBy('created_at','desc')->get(),
        'orden_detalles'=>Orden_detalle::all()]);
    }
}


