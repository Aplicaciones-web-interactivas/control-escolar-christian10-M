<?php

namespace App\Http\Controllers;

use App\Models\Grupo;
use App\Models\Horario;
use Illuminate\Http\Request;

class GrupoController extends Controller
{

    public function index(Request $request)
    {
        $buscar = $request->buscar;

        $grupos = Grupo::with(['horario.materia','horario.maestro'])

        ->when($buscar, function($query) use ($buscar){
        $query->where(function($q) use ($buscar){

        $q->where('nombre','like',"%$buscar%")

        ->orWhereHas('horario.materia', function($q2) use ($buscar){
            $q2->where('nombre','like',"%$buscar%");
        })

        ->orWhereHas('horario.maestro', function($q2) use ($buscar){
            $q2->where('nombre','like',"%$buscar%");
        });

    });
})
        ->get();

        return view('grupos.index', compact('grupos','buscar'));
    }


    public function create()
    {
        $horarios = Horario::with(['materia','maestro'])->get();

        return view('grupos.form', compact('horarios'));
    }


    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required',
            'horario_id' => 'required'
        ]);

        Grupo::create($request->all());

        return redirect('/grupos');

    }


    public function edit($id)
    {

        $grupo = Grupo::findOrFail($id);

        $horarios = Horario::with(['materia','maestro'])->get();

        return view('grupos.form', compact('grupo','horarios'));

    }


    public function update(Request $request, $id)
    {

        $grupo = Grupo::findOrFail($id);

        $grupo->update($request->all());

        return redirect('/grupos');

    }


    public function destroy($id)
    {

        $grupo = Grupo::findOrFail($id);

        $grupo->delete();

        return redirect('/grupos');

    }

}