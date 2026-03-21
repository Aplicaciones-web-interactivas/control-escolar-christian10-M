<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Grupo;
use App\Models\Inscripcion;
use Illuminate\Support\Facades\Auth;

class InscripcionController extends Controller
{
    public function index()
    {
        $usuario_id = session('usuario_id');
        // Todos los grupos disponibles
        $grupos = Grupo::with(['horario.materia','horario.maestro'])->get();

        // Mis inscripciones
        $misInscripciones = Inscripcion::with('grupo.horario.materia','grupo.horario.maestro')
            ->where('usuario_id', $usuario_id)
            ->get();

        return view('inscripciones.index', compact('grupos','misInscripciones'));
    }

    public function store($grupo_id)
    {
        $usuario_id = session('usuario_id');        // evitar duplicados
        $existe = Inscripcion::where('usuario_id', $usuario_id)
            ->where('grupo_id', $grupo_id)
            ->exists();

        if (!$existe) {
            Inscripcion::create([
                'usuario_id' => $usuario_id,
                'grupo_id' => $grupo_id
            ]);
        }

        return back();
    }

    public function destroy($id)
    {
        $inscripcion = Inscripcion::findOrFail($id);
        $inscripcion->delete();

        return back();
    }
}
