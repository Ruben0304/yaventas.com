<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Qvapaypago extends Model
{
    use HasFactory;

    public function orden (){

        return $this->belongsTo(Ordene::class, 'id_orden','id');
     }

    protected $fillable = [
        'transaction_uuid',
        'id_orden'
        
    ];
}
