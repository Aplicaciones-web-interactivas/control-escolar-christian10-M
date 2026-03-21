@extends('layouts.app')

@section('content')

<h1 class="text-2xl font-bold mb-6">Calificar</h1>

<div class="border p-4 rounded mb-4">

    <h2 class="font-bold">
        {{ $inscripcion->usuario->nombre }}
    </h2>

    <p>Grupo: {{ $inscripcion->grupo->nombre }}</p>
    <p>Materia: {{ $inscripcion->grupo->horario->materia->nombre }}</p>

</div>

<form action="/calificaciones/{{ $inscripcion->id }}" method="POST">
    @csrf
    @method('PUT')

    <label class="block mb-2">Calificación</label>

    <input
        type="number"
        name="calificacion"
        value="{{ $calificacion->calificacion ?? '' }}"
        class="border p-2 rounded w-full"
        min="0"
        max="100"
    >

    <button class="bg-green-600 text-white px-4 py-2 rounded mt-4">
        Guardar
    </button>

</form>

@endsection