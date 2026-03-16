<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Horario extends Model
{
    protected $fillable = [
        'materia_id',
        'usuario_id',
        'hora_inicio',
        'hora_fin',
        'dias'
    ];

    public function materia()
    {
        return $this->belongsTo(Materia::class);
    }

    public function usuario()
    {
        return $this->belongsTo(Usuario::class);
    }

    public function grupos()
    {
        return $this->hasMany(Grupo::class);
    }
}