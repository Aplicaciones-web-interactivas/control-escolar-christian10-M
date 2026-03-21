@extends('layouts.app')

@section('content')

<div class="max-w-xl mx-auto bg-white p-8 rounded-2xl shadow-md">

<h1 class="text-2xl font-bold mb-6 text-gray-800">

@if(isset($horario))
Editar Horario
@else
Agregar Horario
@endif

</h1>

<form method="POST"
action="{{ isset($horario) ? '/horarios/'.$horario->id : '/horarios' }}">

@csrf

@if(isset($horario))
@method('PUT')
@endif

<!-- Materia -->
<div class="mb-4">
<label class="block text-sm font-semibold text-gray-600 mb-1">
Materia
</label>

<select name="materia_id"
class="w-full border border-gray-300 p-2 rounded-lg focus:ring-2 focus:ring-blue-500">

@foreach($materias as $materia)
<option value="{{ $materia->id }}"
{{ isset($horario) && $horario->materia_id == $materia->id ? 'selected' : '' }}>
{{ $materia->nombre }}
</option>
@endforeach

</select>
</div>

<!-- Profesor -->
<div class="mb-4">
<label class="block text-sm font-semibold text-gray-600 mb-1">
Profesor
</label>

<select name="usuario_id"
class="w-full border border-gray-300 p-2 rounded-lg focus:ring-2 focus:ring-blue-500">

@foreach($maestros as $maestro)
<option value="{{ $maestro->id }}"
{{ isset($horario) && $horario->usuario_id == $maestro->id ? 'selected' : '' }}>
{{ $maestro->nombre }}
</option>
@endforeach

</select>
</div>

<!-- Hora inicio -->
<div class="mb-4">
<label class="block text-sm font-semibold text-gray-600 mb-1">
Hora inicio
</label>

<input type="time"
name="hora_inicio"
value="{{ $horario->hora_inicio ?? '' }}"
class="w-full border border-gray-300 p-2 rounded-lg focus:ring-2 focus:ring-blue-500">
</div>

<!-- Hora fin -->
<div class="mb-4">
<label class="block text-sm font-semibold text-gray-600 mb-1">
Hora fin
</label>

<input type="time"
name="hora_fin"
value="{{ $horario->hora_fin ?? '' }}"
class="w-full border border-gray-300 p-2 rounded-lg focus:ring-2 focus:ring-blue-500">
</div>

<!-- Días -->
<div class="mb-6">
<label class="block text-sm font-semibold text-gray-600 mb-1">
Días
</label>

<input type="text"
name="dias"
value="{{ $horario->dias ?? '' }}"
placeholder="Ej: Lunes - Miércoles"
class="w-full border border-gray-300 p-2 rounded-lg focus:ring-2 focus:ring-blue-500">
</div>

<button class="w-full bg-blue-600 hover:bg-blue-700 transition text-white py-2 rounded-lg font-semibold">
Guardar
</button>

</form>

</div>

@endsection