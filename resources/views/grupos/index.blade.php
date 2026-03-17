@extends('layouts.app')

@section('content')

<h1 class="text-2xl font-bold mb-6">Grupos</h1>

<a href="/grupos/create"
class="bg-blue-600 text-white px-4 py-2 rounded">

Agregar Grupo

</a>


<form method="GET" class="my-4">

<input
type="text"
name="buscar"
value="{{ $buscar }}"
placeholder="Buscar grupo, materia o profesor"
class="border p-2 rounded w-full">

</form>


@foreach($grupos as $grupo)

<div class="border p-4 rounded mb-4">

<h2 class="text-lg font-bold">

{{ $grupo->nombre }}

</h2>


<p>

Materia:
{{ $grupo->horario->materia->nombre }}

</p>


<p>

Profesor:
{{ $grupo->horario->maestro->nombre }}

</p>


<p>

{{ $grupo->horario->dias }}

</p>


<p>

{{ $grupo->horario->hora_inicio }} - {{ $grupo->horario->hora_fin }}

</p>


<a
href="/grupos/{{ $grupo->id }}/edit"
class="text-blue-600">

Editar

</a>


<form
action="/grupos/{{ $grupo->id }}"
method="POST"
class="inline">

@csrf
@method('DELETE')

<button class="text-red-600">

Eliminar

</button>

</form>

</div>

@endforeach

@endsection