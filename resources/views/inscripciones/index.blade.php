@extends('layouts.app')

@section('content')

<h1 class="text-2xl font-bold mb-6">
Inscripciones
</h1>

{{-- 🔹 OFERTA ACADÉMICA --}}
<h2 class="text-xl font-semibold mb-4">
Oferta de Cursos
</h2>

<!-- Buscador reutilizable -->
<x-search placeholder="Buscar grupo, materia o profesor..." />

<div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6 mb-10">

@foreach($grupos as $grupo)

@php
    $inscrito = $misInscripciones->contains('grupo_id', $grupo->id);
@endphp

<div class="p-5 rounded-xl shadow transition
{{ $inscrito ? 'bg-gray-200 opacity-70' : 'bg-white hover:shadow-lg' }}">

    <h3 class="text-lg font-bold mb-2">
        {{ $grupo->nombre }}
    </h3>

    <p class="text-gray-600 text-sm">
        {{ $grupo->horario->materia->nombre }}
    </p>

    <p class="text-gray-600 text-sm mb-2">
        {{ $grupo->horario->maestro->nombre }}
    </p>

    <p class="text-xs text-gray-500 mb-3">
        {{ $grupo->horario->dias }} <br>
        {{ $grupo->horario->hora_inicio }} - {{ $grupo->horario->hora_fin }}
    </p>

    @if($inscrito)

        <button
        disabled
        class="w-full bg-gray-400 text-white py-2 rounded cursor-not-allowed">
            Ya inscrito
        </button>

    @else

        <form
        action="/inscribirse/{{ $grupo->id }}"
        method="POST"
        onsubmit="return confirm('¿Seguro que deseas inscribirte a este grupo?')">

            @csrf

            <button
            class="w-full bg-green-600 hover:bg-green-700 text-white py-2 rounded transition">
                Inscribirme
            </button>

        </form>

    @endif

</div>

@endforeach

</div>


{{-- 🔹 MIS INSCRIPCIONES --}}
<h2 class="text-xl font-semibold mb-4">
Mis Inscripciones
</h2>

<div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">

@forelse($misInscripciones as $inscripcion)

<div class="bg-blue-50 border border-blue-200 p-5 rounded-xl shadow">

    <h3 class="text-lg font-bold mb-2">
        {{ $inscripcion->grupo->nombre }}
    </h3>

    <p class="text-gray-700 text-sm">
        {{ $inscripcion->grupo->horario->materia->nombre }}
    </p>

    <p class="text-gray-700 text-sm mb-2">
        {{ $inscripcion->grupo->horario->maestro->nombre }}
    </p>

    <p class="text-xs text-gray-500 mb-3">
        {{ $inscripcion->grupo->horario->dias }} <br>
        {{ $inscripcion->grupo->horario->hora_inicio }} - {{ $inscripcion->grupo->horario->hora_fin }}
    </p>

    <form
    action="/inscripciones/{{ $inscripcion->id }}"
    method="POST"
    onsubmit="return confirm('¿Deseas darte de baja de este grupo?')">

        @csrf
        @method('DELETE')

        <button
        class="w-full bg-red-600 hover:bg-red-700 text-white py-2 rounded transition">
            Dar de baja
        </button>

    </form>

</div>

@empty

<p class="text-gray-500">
    No tienes inscripciones aún.
</p>

@endforelse

</div>

@endsection