<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Orden_detalle extends Model
{
    use HasFactory;
    public function user (){

        return $this->belongsTo(User::class,'id_user','id');
     }

     public function orden (){

        return $this->belongsTo(Ordene::class,'id_orden','id');
     }

     public function producto (){

      return $this->belongsTo(Producto::class, 'id_producto','id');
   }
    
    protected $fillable = [
        'cantidad',
        'precio',
        'moneda',
        'total',
      'id_user',
        'id_producto',
     'id_orden'
    ];
    

}
