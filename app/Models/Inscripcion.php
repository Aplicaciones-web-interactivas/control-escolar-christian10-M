<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Inscripcion extends Model
{
    protected $fillable = [
        'grupo_id',
        'usuario_id'
    ];

    public function grupo()
    {
        return $this->belongsTo(Grupo::class);
    }

    public function usuario()
    {
        return $this->belongsTo(Usuario::class);
    }
}