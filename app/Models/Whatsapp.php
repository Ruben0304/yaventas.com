<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Whatsapp extends Model
{
    use HasFactory;
    public function user (){

        return $this->belongsTo(User::class,'id_user','id');
     }

     
    
    protected $fillable = [
       
      'id_user',
        'telefono',
    
    ];
}
