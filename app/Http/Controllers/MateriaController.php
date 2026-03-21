<?php

namespace App\Http\Controllers;

use App\Models\Materia;
use Illuminate\Http\Request;

class MateriaController extends Controller
{

    public function index(Request $request)
{
    $buscar = $request->buscar;

    $materias = Materia::when($buscar, function($query) use ($buscar){
        $query->where('nombre','like',"%$buscar%")
              ->orWhere('clave','like',"%$buscar%");
    })
    ->get();

    return view('materias.index', compact('materias','buscar'));
}

    public function create()
    {
        return view('materias.form');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required',
            'clave' => 'required|unique:materias'
        ]);

        Materia::create($request->all());

        return redirect('/materias');
    }

    public function edit($id)
    {
        $materia = Materia::findOrFail($id);
        return view('materias.form', compact('materia'));
    }

    public function update(Request $request, $id)
    {
        $materia = Materia::findOrFail($id);

        $request->validate([
            'nombre' => 'required',
            'clave' => 'required'
        ]);

        $materia->update($request->all());

        return redirect('/materias');
    }

    public function destroy($id)
    {
        $materia = Materia::findOrFail($id);
        $materia->delete();

        return redirect('/materias');
    }

}