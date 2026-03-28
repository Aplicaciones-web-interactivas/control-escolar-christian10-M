@extends('layouts.app')

@section('content')

<div class="flex justify-between items-center mb-8">

    <h1 class="text-3xl font-bold text-gray-800">Horarios</h1>

    @if(session('usuario_rol') === 'admin')
    <a href="/horarios/create"
        class="bg-blue-600 hover:bg-blue-700 transition text-white px-4 py-2 rounded-lg font-semibold shadow">
        Agregar Horario
    </a>
    @endif

</div>

<x-search placeholder="Buscar por materia o profesor..." />

<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">

    @foreach($horarios as $horario)

    <div class="bg-white p-6 rounded-2xl shadow-md hover:shadow-xl transition transform hover:-translate-y-1">

        <h2 class="text-lg font-semibold text-gray-800 mb-2">{{ $horario->materia->nombre }}</h2>

        <p class="text-sm text-gray-500 mb-1">👨‍🏫 {{ $horario->maestro->nombre }}</p>
        <p class="text-sm text-gray-500 mb-1">📅 {{ $horario->dias }}</p>
        <p class="text-sm text-gray-500">⏰ {{ $horario->hora_inicio }} - {{ $horario->hora_fin }}</p>

        @if(session('usuario_rol') === 'admin')
        <div class="mt-5 flex gap-2">

            <a href="/horarios/{{ $horario->id }}/edit"
                class="bg-yellow-500 hover:bg-yellow-600 transition text-white px-3 py-1 rounded-lg text-sm">
                Editar
            </a>

            <form method="POST" action="/horarios/{{ $horario->id }}"
                onsubmit="return confirm('¿Eliminar horario?')">
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