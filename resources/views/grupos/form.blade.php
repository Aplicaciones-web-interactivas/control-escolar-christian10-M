@extends('layouts.app')

@section('content')

<div class="max-w-xl mx-auto bg-white p-8 rounded-2xl shadow-md">

<h1 class="text-2xl font-bold mb-6 text-gray-800">

@if(isset($grupo))
Editar Grupo
@else
Agregar Grupo
@endif

</h1>

<form method="POST"
action="{{ isset($grupo) ? '/grupos/'.$grupo->id : '/grupos' }}">

@csrf

@if(isset($grupo))
@method('PUT')
@endif

<!-- Nombre -->
<div class="mb-4">
<label class="block text-sm font-semibold text-gray-600 mb-1">
Nombre del grupo
</label>

<input
type="text"
name="nombre"
value="{{ $grupo->nombre ?? '' }}"
class="w-full border border-gray-300 p-2 rounded-lg focus:ring-2 focus:ring-blue-500">
</div>

<!-- Horario -->
<div class="mb-6">
<label class="block text-sm font-semibold text-gray-600 mb-1">
Horario
</label>

<select name="horario_id"
class="w-full border border-gray-300 p-2 rounded-lg focus:ring-2 focus:ring-blue-500">

@foreach($horarios as $horario)

<option
value="{{ $horario->id }}"
{{ isset($grupo) && $grupo->horario_id == $horario->id ? 'selected' : '' }}>

{{ $horario->materia->nombre }} | {{ $horario->maestro->nombre }} | {{ $horario->dias }}

</option>

@endforeach

</select>
</div>

<button class="w-full bg-blue-600 hover:bg-blue-700 transition text-white py-2 rounded-lg font-semibold">
Guardar
</button>

</form>

</div>

@endsection