<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Vendedore extends Model
{
    use HasFactory;
    public function user (){

        return $this->belongsTo(User::class);
     }

    public function productos (): HasMany {

        return $this->hasMany(Producto::class,'id_vendedor');
    }
}
