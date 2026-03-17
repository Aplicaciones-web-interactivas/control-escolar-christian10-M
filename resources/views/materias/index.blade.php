@extends('layouts.app')

@section('content')

<div class="flex justify-between mb-6">

<h1 class="text-2xl font-bold">
Materias
</h1>

<a href="/materias/create"
class="bg-blue-600 text-white px-4 py-2 rounded">
Agregar Materia
</a>

</div>

<div class="grid grid-cols-3 gap-6">

@foreach($materias as $materia)

<div class="bg-white p-6 rounded shadow">

<h2 class="text-xl font-semibold">
{{ $materia->nombre }}
</h2>

<p class="text-gray-500">
Clave: {{ $materia->clave }}
</p>

<div class="mt-4 flex space-x-2">

<a href="/materias/{{ $materia->id }}/edit"
class="bg-yellow-500 text-white px-3 py-1 rounded">
Editar
</a>

<form method="POST"
action="/materias/{{ $materia->id }}"
onsubmit="return confirm('¿Eliminar materia?')">

@csrf
@method('DELETE')

<button class="bg-red-500 text-white px-3 py-1 rounded">
Eliminar
</button>

</form>

</div>

</div>

@endforeach

</div>

@endsection