<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Inscripcion extends Model
{
    protected $table = 'inscripciones';
    
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

    public function calificacion()
{
    return $this->hasOne(Calificacion::class, 'grupo_id', 'grupo_id')
        ->whereColumn('usuario_id', 'usuario_id');
}
}