<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Grupo;
use App\Models\Inscripcion;

class InscripcionController extends Controller
{
    public function index(Request $request)
    {
        $rol = session('usuario_rol');
        $usuario_id = session('usuario_id');
        $buscar = $request->buscar;

        if ($rol === 'alumno') {
            // Oferta académica con búsqueda
            $grupos = Grupo::with(['horario.materia', 'horario.maestro'])
                ->when($buscar, function ($query) use ($buscar) {
                    $query->where('nombre', 'like', "%$buscar%")
                        ->orWhereHas('horario.materia', function ($q) use ($buscar) {
                            $q->where('nombre', 'like', "%$buscar%");
                        })
                        ->orWhereHas('horario.maestro', function ($q) use ($buscar) {
                            $q->where('nombre', 'like', "%$buscar%");
                        });
                })
                ->get();

            // Sus inscripciones actuales
            $misInscripciones = Inscripcion::with('grupo.horario.materia', 'grupo.horario.maestro')
                ->where('usuario_id', $usuario_id)
                ->get();

            return view('inscripciones.alumno', compact('grupos', 'misInscripciones', 'buscar'));

        } elseif ($rol === 'maestro') {
            // Solo los grupos que le fueron asignados
            $grupos = Grupo::with(['horario.materia', 'horario.maestro'])
                ->whereHas('horario', function ($q) use ($usuario_id) {
                    $q->where('usuario_id', $usuario_id);
                })
                ->get();

            return view('inscripciones.maestro', compact('grupos'));

        } else {
            // Admin ve todos los grupos
            $grupos = Grupo::with(['horario.materia', 'horario.maestro'])->get();

            return view('inscripciones.admin', compact('grupos'));
        }
    }

    public function store($grupo_id)
    {
        $usuario_id = session('usuario_id');

        $existe = Inscripcion::where('usuario_id', $usuario_id)
            ->where('grupo_id', $grupo_id)
            ->exists();

        if (!$existe) {
            Inscripcion::create([
                'usuario_id' => $usuario_id,
                'grupo_id'   => $grupo_id
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