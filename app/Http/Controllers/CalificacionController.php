<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Inscripcion;
use App\Models\Calificacion;

class CalificacionController extends Controller
{
    // 🔹 LISTA DE INSCRIPCIONES
    public function index()
    {
        $inscripciones = Inscripcion::with('grupo.horario.materia','grupo.horario.maestro','usuario')
            ->get();

        return view('calificaciones.index', compact('inscripciones'));
    }

    // 🔹 FORMULARIO DE CALIFICACION
    public function edit($id)
    {
        $inscripcion = Inscripcion::with('grupo.horario.materia','grupo.horario.maestro','usuario')
            ->findOrFail($id);

        // buscar si ya tiene calificacion
        $calificacion = Calificacion::where('grupo_id', $inscripcion->grupo_id)
            ->where('usuario_id', $inscripcion->usuario_id)
            ->first();

        return view('calificaciones.form', compact('inscripcion','calificacion'));
    }

    // 🔹 GUARDAR / ACTUALIZAR
    public function update(Request $request, $id)
    {
        $request->validate([
            'calificacion' => 'required|numeric|min:0|max:100'
        ]);

        $inscripcion = Inscripcion::findOrFail($id);

        Calificacion::updateOrCreate(
            [
                'grupo_id' => $inscripcion->grupo_id,
                'usuario_id' => $inscripcion->usuario_id
            ],
            [
                'calificacion' => $request->calificacion
            ]
        );

        return redirect('/calificaciones');
    }
}