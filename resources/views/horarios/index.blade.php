@extends('layouts.app')

@section('content')

<div class="flex justify-between mb-6">

<h1 class="text-2xl font-bold">
Horarios
</h1>

<a href="/horarios/create"
class="bg-blue-600 text-white px-4 py-2 rounded">
Agregar Horario
</a>

</div>


<form method="GET" class="mb-6">

<input type="text"
name="buscar"
value="{{ $buscar }}"
placeholder="Buscar por materia..."
class="border p-2 w-full">

</form>


<div class="grid grid-cols-3 gap-6">

@foreach($horarios as $horario)

<div class="bg-white p-6 rounded shadow">

<h2 class="text-xl font-semibold">

{{ $horario->materia->nombre }}

</h2>

<p>
Profesor: {{ $horario->maestro->nombre }}
</p>

<p>
{{ $horario->dias }}
</p>

<p>
{{ $horario->hora_inicio }} - {{ $horario->hora_fin }}
</p>


<div class="mt-4 flex space-x-2">

<a href="/horarios/{{ $horario->id }}/edit"
class="bg-yellow-500 text-white px-3 py-1 rounded">
Editar
</a>

<form method="POST"
action="/horarios/{{ $horario->id }}"
onsubmit="return confirm('¿Eliminar horario?')">

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