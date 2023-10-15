<?php

namespace App\Http\Controllers;

use App\Models\Visita;
use App\Models\Producto;
use App\Models\Carrito;
use App\Models\Categoria;
use App\Models\Dato;
use App\Models\Oferta;
use App\Models\Orden_detalle;
use App\Models\Ordene;
use App\Models\User;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    
   
   
    //Detalles producto
    public function detalles (Request $request){
       
        $producto=Producto::find($request->id);
        $valoracion=$producto['valoracion'];
        $color=Dato::where('nombre','color')->first()->valor;
        return view('detalles',[
            'producto'=>$producto,
            'carrito'=>Carrito::all(),
            'valoracion'=>$valoracion,
            'color'=>$color,
            'categorias'=>Categoria::all()
            
    ]);
       
    }

 //Mis Ordenes
 public function ordenes (){
         
       

    
    
    $color=Dato::where('nombre','color')->first()->valor;
    return view('ordenes',[
        
        'carrito'=>Carrito::all(),
       
        'color'=>$color,
        'categorias'=>Categoria::all()
        
]);
   
}
//iframe tabla_productos
// public function tabla_productos (){
         
       

//     return view('admin.tabla_productos',[
//         'ordenes'=>Ordene::where('id_user',''.Auth::user()->id.'')->get(),
//         'orden_detalles'=>Orden_detalle::all(),
//     ]);
   
// }


    //iframe tabla
    public function tabla (){
         
       

        return view('admin.tabla',[
            'ordenes'=>Ordene::where('id_user',''.Auth::user()->id.'')->orderBy('created_at','desc')->get(),
            'orden_detalles'=>Orden_detalle::all(),
        ]);
       
    }

    
    //cambiar a cup
    public function cup (){
        setcookie( 'moneda', 'cup', time() + 365 * 24 * 60 * 60); 
       

        return redirect(route('home'));
       
    }

    //cambiar a usd
    public function usd (){
       
            setcookie( 'moneda', 'usd', time() + 365 * 24 * 60 * 60); 
        
            
       return redirect(route('home'));
    }

    //Ir a Contacto
    public function contacto (){
        $color=Dato::where('nombre','color')->first()->valor;
        return view('contacto',[
            'carrito'=>Carrito::all(),
            'color'=>$color,
            'categorias'=>Categoria::all()
        ]);
    }










//Agregar a carrito
public function agregar_carrito(Request $request ){

    $carrito_exist=Carrito::where('id_user',$request->uid)->where('id_producto',$request->pid)->first();

    if ($carrito_exist) {
        
    

    $actcarrito=Carrito::find($carrito_exist->id);
    $actcarrito->cantidad=$request->cant+$carrito_exist->cantidad;
    $actcarrito->save();
    }else {
        Carrito::create([
            'id_user' => $request->uid,
            'id_producto' => $request->pid,
            'cantidad' => $request->cant
        ]);
    }

   
    return back();

}



//Quitar carrito
public function quitar_carrito(Request $request ){

    

    Carrito::destroy([
        'id' => $request->id,
       
        
    ]);



    return back();

}
//Limpiar carrito
public function limpiar_carrito( ){

    $carrito=Carrito::where('id_user',Auth::user()->id);

    $carrito->destroy();



    return back();

}











public function ir_a_pagar(Request $request ){

    $id=$request->uid;
    $total=$request->total;
    $metodopago=$request->metodopago;
    $carrito_por_usuario=Carrito::where('id_user',$id);
   
    
    Ordene::create([
          
      
            'id_user' => $id,
            'total' =>  $total,
            'subtotal' => $total,
            'metodopago' => 'qvapay'

    ]);


    foreach ($carrito_por_usuario as $item) {
        Carrito::destroy([
            'id' => $item->id,
        ]);
}


    
        return redirect(route('home'));

}


   
    
    
      public function cambiar_color (Request $request){
        $dato=Dato::where('nombre','color')->first();
          $color=$request->color;
                $dato->valor=$color;
                $dato->save();
                  return back();
              
                  
              }
             
             //pagina de reservas
              public function reservar (Request $request){
               
                          return view('reservar');
                      
                          
                      } 



    public function prueba (Request $sandbox){
        
       

return $sandbox->all();
        // return view('home');
        // return header("Refresh:0");
    }
    





}



