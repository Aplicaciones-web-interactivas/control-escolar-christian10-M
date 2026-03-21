<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Grupo;
use App\Models\Inscripcion;
use Illuminate\Support\Facades\Auth;

class InscripcionController extends Controller
{
    public function index(Request $request)
{
    $usuario_id = session('usuario_id');
    $buscar = $request->buscar;

    // 🔹 Oferta académica (con búsqueda)
    $grupos = Grupo::with(['horario.materia','horario.maestro'])
        ->when($buscar, function($query) use ($buscar){
            $query->where('nombre','like',"%$buscar%")

            ->orWhereHas('horario.materia', function($q) use ($buscar){
                $q->where('nombre','like',"%$buscar%");
            })

            ->orWhereHas('horario.maestro', function($q) use ($buscar){
                $q->where('nombre','like',"%$buscar%");
            });
        })
        ->get();

    // 🔹 Mis inscripciones (NO se filtran)
    $misInscripciones = Inscripcion::with('grupo.horario.materia','grupo.horario.maestro')
        ->where('usuario_id', $usuario_id)
        ->get();

    return view('inscripciones.index', compact('grupos','misInscripciones','buscar'));
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
