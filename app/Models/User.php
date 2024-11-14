<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'phone',
        'password',
        'idsocial',
        'redsocial',
        'utype',
        'last_code_sent_at',
        'code_attempts',
        'verification_code',
        'verificado',
        'password', 'nombre_apellidos', 'direccion', 'municipio', 'provincia'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function orders():HasMany
    {
        return $this->hasMany(Ordene::class,'id_user', 'id');
    }

    public function carrito():HasMany
    {
        return $this->hasMany(Carrito::class,'id_user');
    }

    public function ordersDetails():HasMany
    {
        return $this->hasMany(Orden_detalle::class,'id_user');
    }



}
