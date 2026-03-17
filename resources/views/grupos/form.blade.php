@extends('layouts.app')

@section('content')

<h1 class="text-2xl font-bold mb-6">

@if(isset($grupo))
Editar Grupo
@else
Agregar Grupo
@endif

</h1>


<form
method="POST"
action="{{ isset($grupo) ? '/grupos/'.$grupo->id : '/grupos' }}">

@csrf

@if(isset($grupo))
@method('PUT')
@endif


<label>Nombre del grupo</label>

<input
type="text"
name="nombre"
value="{{ $grupo->nombre ?? '' }}"
class="border p-2 w-full mb-4">


<label>Horario</label>

<select name="horario_id"
class="border p-2 w-full mb-4">

@foreach($horarios as $horario)

<option
value="{{ $horario->id }}"
{{ isset($grupo) && $grupo->horario_id == $horario->id ? 'selected' : '' }}>

{{ $horario->materia->nombre }} - {{ $horario->maestro->nombre }}

</option>

@endforeach

</select>


<button
class="bg-blue-600 text-white px-4 py-2 rounded">

@if(isset($grupo))
Actualizar
@else
Guardar
@endif

</button>

</form>

@endsection