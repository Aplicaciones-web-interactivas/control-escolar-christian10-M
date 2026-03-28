@extends('layouts.app')

@section('content')

<h1 class="text-2xl font-bold mb-6">Calificar alumno</h1>

<div class="bg-white p-5 rounded-xl shadow mb-6">

    <h2 class="text-lg font-bold mb-1">
        {{ $inscripcion->usuario->nombre }}
    </h2>

    <p class="text-gray-600 text-sm">
        Grupo: {{ $inscripcion->grupo->nombre }}
    </p>

    <p class="text-gray-600 text-sm">
        Materia: {{ $inscripcion->grupo->horario->materia->nombre }}
    </p>

    {{-- Mostrar calificación actual si ya tiene --}}
    @if($calificacion)
        @php $cal = $calificacion->calificacion; @endphp
        <p class="mt-3 font-semibold {{ $cal >= 60 ? 'text-green-600' : 'text-red-600' }}">
            Calificación actual: {{ $cal }} — {{ $cal >= 60 ? 'Aprobado' : 'Reprobado' }}
        </p>
    @endif

</div>

<div class="bg-white p-6 rounded-xl shadow max-w-md">

    <form action="/calificaciones/{{ $inscripcion->id }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-4">
            <label class="block text-sm text-gray-600 mb-1">
                Calificación (0 - 100)
            </label>

            <input
                type="number"
                name="calificacion"
                value="{{ $calificacion->calificacion ?? '' }}"
                min="0"
                max="100"
                class="w-full border rounded-lg p-2 focus:ring-2 focus:ring-blue-400 focus:outline-none"
            >
        </div>

        <button class="w-full bg-green-600 hover:bg-green-700 text-white py-2 rounded transition">
            Guardar calificación
        </button>

    </form>

</div>

@endsection