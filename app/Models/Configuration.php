<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Configuration extends Model
{
    use HasFactory;
    protected $table = 'configuration';

    protected $primaryKey = 'id';

    public $incrementing = false;

    protected $keyType = 'string';

    public $timestamps = true;
    protected $fillable = [
        'id',
        'name',
        'cod',
        'telefono',
        'access_token',
        'logotipo',
        'favicon',
        'image_login'
    ];
    public static function updateConfiguration($name = "", $telefono = "", $cod = "", $access_token = "", $image_login = "", $logotipo = "", $favicon = "")
    {
        $configuraciones = Configuration::first();
        $configuraciones->update([
            'name' => $name,
            'cod' => $cod,
            'telefono' => $telefono,
            'access_token' => $access_token,
            'logotipo' => $logotipo,
            'favicon' => $favicon,
            'image_login' => $image_login,
        ]);
        return $configuraciones;
    }
}