<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Oferta extends Model
{
    use HasFactory;
    
    public function producto (){

        return $this->belongsTo(Producto::class, 'id_producto','id');
     }

    protected $fillable = [
        'preciousd',
        'preciocup',
        'fecha_final',
        'motivo',
       
        'id_producto',
     'fecha_inicial'
    ];
}
