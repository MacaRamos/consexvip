<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;

class Rol extends Model
{
    protected $table = 'roles';
    protected $fillable = ['id', 'nombre'];
    public $timestamps = false;

    public function usuarios()
    {
        return $this->belongsToMany(User::class)->withTimestamps();
    }

    public function modulosRol(){
        return $this->hasMany(ModuloRol::class, 'rol_id', 'id');
    }
}
