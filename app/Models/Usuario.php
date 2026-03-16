<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Usuario extends Model
{
    protected $fillable = [
        'nombre',
        'clave_institucional',
        'password',
        'rol',
        'activo'
    ];

    public function horarios()
    {
        return $this->hasMany(Horario::class);
    }

    public function inscripciones()
    {
        return $this->hasMany(Inscripcion::class);
    }

    public function calificaciones()
    {
        return $this->hasMany(Calificacion::class);
    }
}