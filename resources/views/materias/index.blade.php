@extends('layouts.app')

@section('content')

<div class="flex justify-between items-center mb-8">

<h1 class="text-3xl font-bold text-gray-800">
Materias
</h1>

<a href="/materias/create"
class="bg-blue-600 hover:bg-blue-700 transition text-white px-4 py-2 rounded-lg font-semibold shadow">
Agregar Materia
</a>

</div>

<x-search placeholder="Buscar por materia..." />

<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">

@foreach($materias as $materia)

<div class="bg-white p-6 rounded-2xl shadow-md hover:shadow-xl transition transform hover:-translate-y-1">

<h2 class="text-xl font-semibold text-gray-800 mb-2">
{{ $materia->nombre }}
</h2>

<p class="text-gray-500 text-sm">
Clave: {{ $materia->clave }}
</p>

<div class="mt-5 flex gap-2">

<a href="/materias/{{ $materia->id }}/edit"
class="bg-yellow-500 hover:bg-yellow-600 transition text-white px-3 py-1 rounded-lg text-sm">
Editar
</a>

<form method="POST"
action="/materias/{{ $materia->id }}"
onsubmit="return confirm('¿Eliminar materia?')">

@csrf
@method('DELETE')

<button class="bg-red-500 hover:bg-red-600 transition text-white px-3 py-1 rounded-lg text-sm">
Eliminar
</button>

</form>

</div>

</div>

@endforeach

</div>

@endsection