@extends('layouts.app')

@section('content')

<h1 class="text-2xl font-bold mb-6">Calificaciones</h1>

@foreach($inscripciones as $inscripcion)

<div class="border p-4 mb-4 rounded">

    <h2 class="font-bold">
        {{ $inscripcion->usuario->nombre }}
    </h2>

    <p>Grupo: {{ $inscripcion->grupo->nombre }}</p>
    <p>Materia: {{ $inscripcion->grupo->horario->materia->nombre }}</p>

    <a href="/calificaciones/{{ $inscripcion->id }}/edit"
       class="bg-blue-600 text-white px-3 py-1 rounded">
        Calificar
    </a>

</div>

@endforeach

@endsection