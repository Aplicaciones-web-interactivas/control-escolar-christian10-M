@extends('layouts.app')

@section('content')

<div class="max-w-xl mx-auto bg-white p-8 rounded-2xl shadow-md">

<h1 class="text-2xl font-bold mb-6 text-gray-800">

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
<label class="block text-sm font-semibold text-gray-600 mb-1">
Nombre
</label>

<input type="text"
name="nombre"
value="{{ $materia->nombre ?? '' }}"
class="w-full border border-gray-300 p-2 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
</div>

<div class="mb-6">
<label class="block text-sm font-semibold text-gray-600 mb-1">
Clave
</label>

<input type="text"
name="clave"
value="{{ $materia->clave ?? '' }}"
class="w-full border border-gray-300 p-2 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
</div>

<button class="w-full bg-blue-600 hover:bg-blue-700 transition text-white py-2 rounded-lg font-semibold">

@if(isset($materia))
Actualizar Materia
@else
Agregar Materia
@endif

</button>

</form>

</div>

@endsection