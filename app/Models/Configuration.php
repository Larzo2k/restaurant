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
        'logotipo',
        'favicon',
        'image_login'
    ];
    public static function updateConfiguration($name = "", $telefono = "", $cod = "", $access_token = "", $image_login = "", $logotipo = "", $favicon = "")
    {
        $configuraciones = Configuration::first();
        $configuraciones->name = $name;
        if($logotipo != ""){
            $configuraciones->logotipo = $logotipo;
        }
        if($favicon != ""){
            $configuraciones->favicon = $favicon;
        }
        if($image_login != ""){
            $configuraciones->image_login = $image_login;
        }
        $configuraciones->update();
        return $configuraciones;
    }
}