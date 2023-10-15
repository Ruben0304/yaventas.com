<?php

namespace App\Http\Livewire;


use App\Models\Categoria;
use App\Models\Dato;
use App\Models\Oferta;
use App\Models\Producto;
use App\Models\User;
use App\Models\Visita;
use Livewire\Component;
use App\Http\Livewire\CarritoComponent;
use App\Models\Carrito;
use App\Models\Whatsapp;
use Illuminate\Http\Request;
use Cart;
use Illuminate\Support\Facades\Auth;

class HomeComponent extends Component
{

    public function agregar_carrito($id,$cant){

        $carrito_exist=Carrito::where('id_user',Auth::user()->id)->where('id_producto',$id)->first();
    
        if ($carrito_exist) {
            
        
    
        $actcarrito=Carrito::find($carrito_exist->id);
        $actcarrito->cantidad=$cant+$carrito_exist->cantidad;
        $actcarrito->save();
        }else {
            Carrito::create([
                'id_user' => Auth::user()->id,
                'id_producto' => $id,
                'cantidad' => $cant
            ]);
        }
    
       
       return redirect(route('home'));
    
    }

    public function render()
    {
        // if (isset($_COOKIE['moneda'])) {
        //     if ($_COOKIE['moneda']!='cup' && $_COOKIE['moneda']!='usd') {
                // setcookie( 'moneda', 'cup', time() + 365 * 24 * 60 * 60); 
        //     }
        if (isset($_COOKIE['gpt'])) {
            
        }
        else {
            setcookie('gpt', 'Aqui te va a responder', 0);
            redirect(route('home'));
        }
       
           
     
        //    if (isset($_COOKIE['visita'])) {
        //    }
        //    else {
        //     setcookie( 'visita', 'creada', time() +  60 * 60); 
        //     $visita=  Visita::create([
        //         'ip' => $_SERVER["REMOTE_ADDR"] ?? "",]);
        //     }

    $productos=Producto::where('stock', '>',0)->orderBy('preciocup','DESC')->take(8)->get();
    $productos_baratos=Producto::where('stock', '>',0)->orderBy('preciocup','ASC')->take(8)->get();
    $productos_nuevos=Producto::where('stock', '>',0)->orderBy('created_at','DESC')->take(8)->get();
    $usuario=User::all();
    $categoria=Categoria::all();
    $oferta=Oferta::where('fecha_final', '>=', date('Y-m-d'))->get();
    $whatsapp = Whatsapp::all();
    // dd(date_diff($final, $hoy)->d);
   
           return view('livewire.home-component',[
            'productos_populares'=> $productos,
            'productos_baratos'=> $productos_baratos,
            'productos_nuevos'=> $productos_nuevos,
            'usuario'=>$usuario,
            'categoria'=>$categoria,
            'whatsapp'=>$whatsapp,
            'oferta'=>$oferta,
        ]);
        }
        
            // 'home'=>HomeController::class
        
        
           
        
    
}
