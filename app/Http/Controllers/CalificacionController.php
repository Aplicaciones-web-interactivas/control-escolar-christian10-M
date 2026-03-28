<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Inscripcion;
use App\Models\Calificacion;

class CalificacionController extends Controller
{
    public function index()
    {
        $rol = session('usuario_rol');
        $usuario_id = session('usuario_id');

        if ($rol === 'admin') {
            // Admin ve todas las inscripciones
            $inscripciones = Inscripcion::with('grupo.horario.materia', 'grupo.horario.maestro', 'usuario')
                ->get();

        } elseif ($rol === 'maestro') {
            // Maestro solo ve inscripciones de sus grupos
            $inscripciones = Inscripcion::with('grupo.horario.materia', 'grupo.horario.maestro', 'usuario')
                ->whereHas('grupo.horario', function ($q) use ($usuario_id) {
                    $q->where('usuario_id', $usuario_id);
                })
                ->get();

        } else {
            // Alumno solo ve sus propias inscripciones
            $inscripciones = Inscripcion::with('grupo.horario.materia', 'grupo.horario.maestro', 'usuario')
                ->where('usuario_id', $usuario_id)
                ->get();
        }

        return view('calificaciones.index', compact('inscripciones'));
    }

    public function edit($id)
    {
        $inscripcion = Inscripcion::with('grupo.horario.materia', 'grupo.horario.maestro', 'usuario')
            ->findOrFail($id);

        $calificacion = Calificacion::where('grupo_id', $inscripcion->grupo_id)
            ->where('usuario_id', $inscripcion->usuario_id)
            ->first();

        return view('calificaciones.form', compact('inscripcion', 'calificacion'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'calificacion' => 'required|numeric|min:0|max:100'
        ]);

        $inscripcion = Inscripcion::findOrFail($id);

        Calificacion::updateOrCreate(
            [
                'grupo_id'   => $inscripcion->grupo_id,
                'usuario_id' => $inscripcion->usuario_id
            ],
            [
                'calificacion' => $request->calificacion
            ]
        );

        return redirect('/calificaciones');
    }
}