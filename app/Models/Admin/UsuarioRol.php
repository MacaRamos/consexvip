<?php

namespace App\Models\Admin;

use App\User;
use Illuminate\Database\Eloquent\Model;

class UsuarioRol extends Model
{
    protected $dateFormat = 'Y-d-m H:i:s.v';
    protected $table = 'usuarios_rol';
    protected $fillable = ['rol_id', 'usuario_id', 'rol_estado'];// campos que se guardan en la base de datos
    protected $guarded = ['rol_id', 'usuario_id', 'rol_estado'];
    public $timestamps = false;

    public function usuario(){
        return $this->hasOne(User::class, 'id', 'usuario_id');
    }

    public function rol(){
        return $this->hasOne(Rol::class, 'id', 'rol_id');
    }
}
