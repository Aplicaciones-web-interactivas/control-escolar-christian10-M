<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tarea;
use App\Models\Grupo;
use App\Models\EntregaTarea;

class TareaController extends Controller
{
    // Lista de grupos (punto de entrada según rol)
    public function index()
    {
        $rol = session('usuario_rol');
        $usuario_id = session('usuario_id');

        if ($rol === 'alumno') {
            // El alumno ve sus tareas pendientes (grupos en los que está inscrito)
            $tareas = Tarea::with('grupo.horario.materia', 'grupo.horario.maestro')
                ->whereHas('grupo.inscripciones', function ($q) use ($usuario_id) {
                    $q->where('usuario_id', $usuario_id);
                })
                ->get();

            // Checamos cuáles ya entregó
            $entregadas = EntregaTarea::where('usuario_id', $usuario_id)
                ->pluck('tarea_id');

            return view('tareas.alumno', compact('tareas', 'entregadas'));

        } elseif ($rol === 'maestro') {
            // Maestro ve sus grupos
            $grupos = Grupo::with(['horario.materia', 'horario.maestro'])
                ->whereHas('horario', function ($q) use ($usuario_id) {
                    $q->where('usuario_id', $usuario_id);
                })
                ->get();

            return view('tareas.maestro', compact('grupos'));

        } else {
            // Admin ve todos los grupos
            $grupos = Grupo::with(['horario.materia', 'horario.maestro'])->get();

            return view('tareas.admin', compact('grupos'));
        }
    }

    // Ver tareas de un grupo específico (maestro y admin)
    public function verGrupo($grupo_id)
    {
        $grupo = Grupo::with('horario.materia', 'horario.maestro')->findOrFail($grupo_id);

        $tareas = Tarea::with('entregas.usuario')
            ->where('grupo_id', $grupo_id)
            ->get();

        return view('tareas.grupo', compact('grupo', 'tareas'));
    }

    // Formulario para agregar tarea
    public function create($grupo_id)
    {
        $grupo = Grupo::findOrFail($grupo_id);

        return view('tareas.form', compact('grupo'));
    }

    // Guardar tarea nueva
    public function store(Request $request, $grupo_id)
    {
        $request->validate([
            'titulo'         => 'required',
            'descripcion'    => 'nullable',
            'fecha_entrega'  => 'required|date'
        ]);

        Tarea::create([
            'titulo'        => $request->titulo,
            'descripcion'   => $request->descripcion,
            'fecha_entrega' => $request->fecha_entrega,
            'grupo_id'      => $grupo_id
        ]);

        return redirect('/tareas/grupo/' . $grupo_id);
    }

    // Ver entregas de una tarea (maestro y admin)
    public function verEntregas($tarea_id)
    {
        $tarea = Tarea::with('grupo.horario.materia', 'entregas.usuario')
            ->findOrFail($tarea_id);

        return view('tareas.entregas', compact('tarea'));
    }

    // Formulario para que alumno suba su PDF
    public function verTarea($tarea_id)
    {
        $usuario_id = session('usuario_id');

        $tarea = Tarea::with('grupo.horario.materia')->findOrFail($tarea_id);

        $entrega = EntregaTarea::where('tarea_id', $tarea_id)
            ->where('usuario_id', $usuario_id)
            ->first();

        return view('tareas.subir', compact('tarea', 'entrega'));
    }

    // Guardar el PDF del alumno
    public function subirEntrega(Request $request, $tarea_id)
    {
        $request->validate([
            'archivo' => 'required|file|mimes:pdf|max:5120'
        ]);

        $usuario_id = session('usuario_id');

        // Guardamos el archivo en storage/app/public/entregas
        $ruta = $request->file('archivo')->store('entregas', 'public');

        // Si ya había entregado, actualizamos
        EntregaTarea::updateOrCreate(
            [
                'tarea_id'   => $tarea_id,
                'usuario_id' => $usuario_id
            ],
            [
                'archivo' => $ruta
            ]
        );

        return redirect('/tareas');
    }
}