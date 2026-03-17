@extends('layouts.app')

@section('content')

<h1 class="text-2xl font-bold mb-6">

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


<label>Materia</label>

<select name="materia_id" class="border p-2 w-full mb-4">

@foreach($materias as $materia)

<option value="{{ $materia->id }}"
{{ isset($horario) && $horario->materia_id == $materia->id ? 'selected' : '' }}>

{{ $materia->nombre }}

</option>

@endforeach

</select>



<label>Profesor</label>

<select name="usuario_id" class="border p-2 w-full mb-4">

@foreach($maestros as $maestro)

<option value="{{ $maestro->id }}"
{{ isset($horario) && $horario->usuario_id == $maestro->id ? 'selected' : '' }}>

{{ $maestro->nombre }}

</option>

@endforeach

</select>



<label>Hora inicio</label>

<input type="time"
name="hora_inicio"
value="{{ $horario->hora_inicio ?? '' }}"
class="border p-2 w-full mb-4">


<label>Hora fin</label>

<input type="time"
name="hora_fin"
value="{{ $horario->hora_fin ?? '' }}"
class="border p-2 w-full mb-4">


<label>Días</label>

<input type="text"
name="dias"
value="{{ $horario->dias ?? '' }}"
placeholder="Ej: Lunes-Miercoles"
class="border p-2 w-full mb-4">


<button class="bg-blue-600 text-white px-4 py-2 rounded">

@if(isset($horario))
Actualizar
@else
Guardar
@endif

</button>

</form>

@endsection