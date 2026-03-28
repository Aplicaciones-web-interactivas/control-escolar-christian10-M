@extends('layouts.app')

@section('content')

<div class="flex justify-between items-center mb-8">

    <h1 class="text-3xl font-bold text-gray-800">Grupos</h1>

    @if(session('usuario_rol') === 'admin')
    <a href="/grupos/create"
        class="bg-blue-600 hover:bg-blue-700 transition text-white px-4 py-2 rounded-lg font-semibold shadow">
        Agregar Grupo
    </a>
    @endif

</div>

<x-search placeholder="Buscar grupo, materia o profesor..." />

<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">

    @foreach($grupos as $grupo)

    <div class="bg-white p-6 rounded-2xl shadow-md hover:shadow-xl transition transform hover:-translate-y-1">

        <h2 class="text-lg font-semibold text-gray-800 mb-2">{{ $grupo->nombre }}</h2>

        <p class="text-sm text-gray-500 mb-1">📘 {{ $grupo->horario->materia->nombre }}</p>
        <p class="text-sm text-gray-500 mb-1">👨‍🏫 {{ $grupo->horario->maestro->nombre }}</p>
        <p class="text-sm text-gray-500 mb-1">📅 {{ $grupo->horario->dias }}</p>
        <p class="text-sm text-gray-500">⏰ {{ $grupo->horario->hora_inicio }} - {{ $grupo->horario->hora_fin }}</p>

        @if(session('usuario_rol') === 'admin')
        <div class="mt-5 flex gap-2">

            <a href="/grupos/{{ $grupo->id }}/edit"
                class="bg-yellow-500 hover:bg-yellow-600 transition text-white px-3 py-1 rounded-lg text-sm">
                Editar
            </a>

            <form action="/grupos/{{ $grupo->id }}" method="POST"
                onsubmit="return confirm('¿Eliminar grupo?')">
                @csrf
                @method('DELETE')
                <button class="bg-red-500 hover:bg-red-600 transition text-white px-3 py-1 rounded-lg text-sm">
                    Eliminar
                </button>
            </form>

        </div>
        @endif

    </div>

    @endforeach

</div>

@endsection