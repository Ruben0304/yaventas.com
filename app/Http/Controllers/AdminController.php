<?php

namespace App\Http\Controllers;

use App\Models\Ordene;
use App\Models\Visita;
use App\Models\Producto;
use App\Models\Vendedore;
use App\Models\Carrito;
use App\Models\Categoria;
use App\Models\Oferta;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class AdminController extends Controller
{
  //dashboard
    public function dashboard(){
          
        $cantidad=Visita::where('created_at','LIKE','%'.date('Y-m-d').'%')->count();
        $ingresos_totales=Ordene::sum('total');
        return view('admin.dashboard',[
        
            'visitas'=>$cantidad,
            'ingresos_totales'=>$ingresos_totales
        ]);
    }

    //Agregar productos
    public function agregar_producto(){return view('admin.agregar_producto',[]);}
    
    //Actualizar productos
    public function actualizar_producto(){
          
        
        
        return view('admin.actualizar_producto',[]);
    }
    
    //Actualizar productos
    public function eliminar_producto(){
          
        
        
        return view('admin.eliminar_producto',[]);
    }


   
   
    //Creando productos
    public function crear_producto( Request $request){
        
        if ($_FILES['foto2']['name'] != "") {
            $foto_nombre2=$_FILES['foto2']['name'];
            $nombrefinal2='fotos_productos2/'.$request->vendedor.(date('u')+date('s')).Str::slug($request->nombre).$foto_nombre2;
            move_uploaded_file($_FILES['foto2']['tmp_name'], $nombrefinal2);
        }
        else{
            $nombrefinal2=null;
        }
        if ($_FILES['foto3']['name'] != "") {
            $foto_nombre3=$_FILES['foto3']['name'];
            $nombrefinal3='fotos_productos3/'.$request->vendedor.(date('u')+date('s')).Str::slug($request->nombre).$foto_nombre3;
            move_uploaded_file($_FILES['foto3']['tmp_name'], $nombrefinal3);
        }
        else{
            $nombrefinal3=null;
        }
    //    $id_vendedor=Vendedore::where('id_user',$request->uid)->first()->id;
       $foto_nombre=$_FILES['foto']['name'];
       
       
       $nombrefinal='fotos_productos/'.$request->vendedor.(date('u')+date('s')).Str::slug($request->nombre).$foto_nombre;
       
       
       
       if (move_uploaded_file($_FILES['foto']['tmp_name'], $nombrefinal)){
       
        $color=$request->color;
        Producto::create([
             'nombre'=> $request->nombre,
             'preciocup'=> $request->preciocup,
             'color'=> $color,
            //  'preciousd'=> $request->preciousd,
             'stock'=> $request->stock,
             'id_vendedor'=> $request->vendedor,
             'id_categoria'=> $request->categoria,
             'foto'=> $nombrefinal,
             'foto_2'=> $nombrefinal2,
             'foto_3'=> $nombrefinal3
        ]);
    }
        else{
            echo "Ocurrió algún error al subir el fichero. No pudo guardarse.";
     }
        return redirect(route('admin.productos'));
    }

    //Actualizando productos
    public function actualizando_producto(Request $request){
        $producto=Producto::find($request->id);
        if ($_FILES['foto2']['name'] != "") {
            $foto_nombre2=$_FILES['foto2']['name'];
            $nombrefinal2='fotos_productos2/'.$request->vendedor.(date('u')+date('s')).Str::slug($request->nombre).$foto_nombre2;
            move_uploaded_file($_FILES['foto2']['tmp_name'], $nombrefinal2);
            $producto->foto_2=$nombrefinal2;
        }
        else{
            $nombrefinal2=null;
        }
        
        if ($_FILES['foto']['name'] != "") {
            $foto_nombre=$_FILES['foto']['name'];
            $nombrefinal='fotos_productos/'.$request->vendedor.(date('u')+date('s')).Str::slug($request->nombre).$foto_nombre;
            move_uploaded_file($_FILES['foto']['tmp_name'], $nombrefinal);
            $producto->foto=$nombrefinal;
        }
        else{
            $nombrefinal=null;
        }
        
        
        if ($_FILES['foto3']['name'] != "") {
            $foto_nombre3=$_FILES['foto3']['name'];
            $nombrefinal3='fotos_productos3/'.$request->vendedor.(date('u')+date('s')).Str::slug($request->nombre).$foto_nombre3;
            move_uploaded_file($_FILES['foto3']['tmp_name'], $nombrefinal3);
            $producto->foto_3=$nombrefinal3;
        }
        else{
            $nombrefinal3=null;
        }
        
        $producto->nombre=$request->nombre;
            $producto->preciocup=$request->preciocup;
            $producto->id_vendedor=$request->vendedor;
            $producto->id_categoria=$request->categoria;
            $producto->stock=$request->stock;
            $producto->descripcion=$request->descripcion;
            $producto->color=$request->color;
            $producto->save();
        
            if ($request->duraciono!=null) {
                if ($request->preciousdo !=null or $request->preciocupo !=null) {
                    
               Oferta::create([
                'id_producto' => $request->id,
                
                'preciocup'=> $request->preciocupo,
                'fecha_final'=> $request->duraciono,
                'motivo'=> $request->motivo,
                'fecha_inicial'=> date('Y-m-d'),
                 ]);
            }
        }
        
           

        return redirect(route('admin.productos'));
    }

    //Eliminando productos
    public function eliminando_producto(Request $request){
      
     
    
     
        $producto=Producto::find($request->id)->first();
        $carrito=Carrito::where('id_producto',$request->id)->get();
        $error=null;

        if ($producto->id_vendedor != $request->uid and $producto->id_vendedor != 1) {
            $error="no pertenece a vendedor";
        }
        else {
            
        

        foreach($carrito as $item){
            Carrito::destroy([
                'id' => $item->id,
               
                
            ]);
            
        }
           
       
        
        Producto::destroy([
            'id' => $request->id,
           
            
        ]);
    }
        
           

        return view('admin.eliminar_producto',['error'=>$error]);
    }

    //Buscar productos para actualizar
    public function buscar_producto_id(Request $request){
         
        $producto_encontrado=Producto::where('id', $request->id)->first();
        $error=null;
        if ($producto_encontrado==null) {
            return view('admin.actualizar_producto',[ 
                'error'=>$error
            ]);
        }
        elseif ($producto_encontrado->id_vendedor != $request->uid and $producto_encontrado->id_vendedor != 1) {
            $error="no pertenece a vendedor";
            return view('admin.actualizar_producto',[ 
                'producto_encontrado'=>$producto_encontrado,
                'error'=>$error
            ]);
        }
       
        else {
            return view('admin.actualizar_producto',[ 
                'producto_encontrado'=>$producto_encontrado,
                'error'=>$error
            ]);
        }
        
    }

    public function actualizar_categoria(Request $request){
         
        $categoria=Categoria::find($request->id);
        $categoria->nombre=$request->nombre;
        $categoria->save();
        return redirect(route('admin.categorias'));
        
        
    }

    

    
}
