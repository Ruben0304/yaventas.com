<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ordene extends Model
{
    use HasFactory;

    public function user()
    {

        return $this->belongsTo(User::class);
    }

    protected $fillable = [
        'total',
        'subtotal',
        'bono',
        'envio',
        'metodopago',
        'comentarios',
        'cordenadas',
        'transaction_uuid',
        'usuario_remoto', 'nombre', 'direccion', 'pais', 'provincia', 'municipio', 'telefono',
        'id_user'
    ];
}
