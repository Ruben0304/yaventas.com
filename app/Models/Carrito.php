<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Carrito extends Model
{
    use HasFactory;
    public function user (){

        return $this->belongsTo(User::class);
     }

     public function producto (){

        return $this->belongsTo(Producto::class, 'id_producto','id');
     }

     protected $fillable = [
      'id_user',
      'id_producto',
      'cantidad',
      
  ];

}
