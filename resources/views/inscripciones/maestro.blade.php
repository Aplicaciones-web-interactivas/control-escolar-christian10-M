@extends('layouts.app')

@section('content')

<h1 class="text-2xl font-bold mb-6">Mis Grupos Asignados</h1>

<div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">

    @forelse($grupos as $grupo)

        <div class="bg-white p-6 rounded-2xl shadow-md hover:shadow-xl transition">

            <h2 class="text-lg font-semibold text-gray-800 mb-2">{{ $grupo->nombre }}</h2>
            <p class="text-sm text-gray-500 mb-1">📘 {{ $grupo->horario->materia->nombre }}</p>
            <p class="text-sm text-gray-500 mb-1">📅 {{ $grupo->horario->dias }}</p>
            <p class="text-sm text-gray-500">
                ⏰ {{ $grupo->horario->hora_inicio }} - {{ $grupo->horario->hora_fin }}
            </p>

        </div>

    @empty
        <p class="text-gray-500">No tienes grupos asignados.</p>
    @endforelse

</div>

@endsection