<?php

namespace App\Http\Controllers;

use App\Models\Horario;
use App\Models\Materia;
use App\Models\Usuario;
use Illuminate\Http\Request;

class HorarioController extends Controller
{

    public function index(Request $request)
    {

        $buscar = $request->buscar;

        $horarios = Horario::with(['materia','maestro'])

        ->when($buscar, function($query) use ($buscar){
            $query->whereHas('materia', function($q) use ($buscar){
                $q->where('nombre','like',"%$buscar%");
            })
            ->orWhereHas('maestro', function($q) use ($buscar){
                $q->where('nombre','like',"%$buscar%");
            });
        })

        ->get();

        return view('horarios.index', compact('horarios','buscar'));
    }


    public function create()
    {
        $materias = Materia::all();

        $maestros = Usuario::where('rol','maestro')->get();

        return view('horarios.form', compact('materias','maestros'));
    }


    public function store(Request $request)
    {

        $request->validate([
            'materia_id' => 'required',
            'usuario_id' => 'required',
            'hora_inicio' => 'required',
            'hora_fin' => 'required',
            'dias' => 'required'
        ]);

        Horario::create($request->all());

        return redirect('/horarios');

    }


    public function edit($id)
    {

        $horario = Horario::findOrFail($id);

        $materias = Materia::all();

        $maestros = Usuario::where('rol','maestro')->get();

        return view('horarios.form', compact('horario','materias','maestros'));

    }


    public function update(Request $request, $id)
    {

        $horario = Horario::findOrFail($id);

        $horario->update($request->all());

        return redirect('/horarios');

    }


    public function destroy($id)
    {

        $horario = Horario::findOrFail($id);

        $horario->delete();

        return redirect('/horarios');

    }

}