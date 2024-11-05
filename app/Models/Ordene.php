<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Ordene extends Model
{
    use HasFactory;

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class,'id_user', 'id');
    }

    public function ordersDetails(): HasMany
    {
        return $this->hasMany(Orden_detalle::class, 'id_orden', 'id' );
    }

    protected $fillable = [
        'total',
        'subtotal',
        'bono',
        'envio',
        'estado',
        'metodopago',
        'comentarios',
        'cordenadas',
        'transaction_uuid',
        'usuario_remoto', 'nombre', 'direccion', 'pais', 'provincia', 'municipio', 'telefono',
        'id_user'
    ];

}
