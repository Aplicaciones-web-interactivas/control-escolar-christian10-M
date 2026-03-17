@extends('layouts.app')

@section('content')

<h1 class="text-2xl font-bold mb-6">

@if(isset($materia))
Actualizar Materia
@else
Agregar Materia
@endif

</h1>

<form method="POST"
action="{{ isset($materia) ? '/materias/'.$materia->id : '/materias' }}">

@csrf

@if(isset($materia))
@method('PUT')
@endif

<div class="mb-4">

<label>Nombre</label>

<input type="text"
name="nombre"
value="{{ $materia->nombre ?? '' }}"
class="border p-2 w-full">

</div>

<div class="mb-4">

<label>Clave</label>

<input type="text"
name="clave"
value="{{ $materia->clave ?? '' }}"
class="border p-2 w-full">

</div>

<button class="bg-blue-600 text-white px-4 py-2 rounded">

@if(isset($materia))
Actualizar Materia
@else
Agregar Materia
@endif

</button>

</form>

@endsection