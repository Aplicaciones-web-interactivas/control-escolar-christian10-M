@extends('layouts.app')

@section('content')

<h1 class="text-2xl font-bold mb-6">Calificaciones</h1>

<div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">

@foreach($inscripciones as $inscripcion)

    @php
        $cal = $inscripcion->calificacion->calificacion ?? null;
    @endphp

    <div class="bg-white p-5 rounded-xl shadow hover:shadow-lg transition">

        {{-- Solo admin y maestro ven el nombre del alumno --}}
        @if(session('usuario_rol') !== 'alumno')
            <h2 class="text-lg font-bold mb-1">
                {{ $inscripcion->usuario->nombre }}
            </h2>
        @endif

        <p class="text-sm text-gray-600">
            Grupo: {{ $inscripcion->grupo->nombre }}
        </p>

        <p class="text-sm text-gray-600 mb-3">
            {{ $inscripcion->grupo->horario->materia->nombre }}
        </p>

        {{-- Calificación --}}
        @if($cal !== null)

            <div class="mb-4">
                <span class="text-sm text-gray-500">Calificación:</span>

                <div class="text-xl font-bold {{ $cal >= 60 ? 'text-green-600' : 'text-red-600' }}">
                    {{ $cal }}
                </div>

                <span class="text-xs {{ $cal >= 60 ? 'text-green-600' : 'text-red-600' }}">
                    {{ $cal >= 60 ? 'Aprobado' : 'Reprobado' }}
                </span>
            </div>

        @else

            <div class="mb-4 text-gray-400 text-sm">
                Sin calificar
            </div>

        @endif

        {{-- Botón editar solo para admin y maestro --}}
        @if(session('usuario_rol') !== 'alumno')
            <a href="/calificaciones/{{ $inscripcion->id }}/edit"
               class="block text-center bg-blue-600 hover:bg-blue-700 text-white py-2 rounded transition">
                Calificar
            </a>
        @endif

    </div>

@endforeach

</div>

@endsection