<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    const ESTADO_ACTIVO = 1;
    const ESTADO_INACTIVO = 0;
    use HasApiTokens, HasFactory, Notifiable;

    // Establecer que el id es un UUID (cadena)
    protected $primaryKey = 'id';  // Esto sigue siendo el 'id' por defecto
    public $incrementing = false;  // El id no es autoincrementable
    protected $keyType = 'string';  // El tipo de la clave primaria es un string (UUID)
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'id',
        'name',
        'email',
        'password',
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
}