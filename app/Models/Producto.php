<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Producto extends Model
{
    use HasFactory;

    public function vendedor (){

        return $this->belongsTo(Vendedore::class,'id_vendedor','id');
     }

     public function categoria (){

        return $this->belongsTo(Categoria::class,'id_categoria','id');
     }

    public function carritos(): BelongsToMany
    {
        return $this->belongsToMany(Carrito::class, 'id_producto');
    }

     protected $fillable = [
        'nombre',
     'preciocup',
     'preciousd',
     'id_vendedor',
     'foto',
     'foto_2',
     'foto_3',
     'id_categoria',
     'color',
     'descripcion',
     'stock'
    ];




}
