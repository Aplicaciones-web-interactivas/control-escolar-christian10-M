@extends('layouts.app')

@section('content')

<h1 class="text-2xl font-bold mb-6">Mis Tareas</h1>

<div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">

    @forelse($tareas as $tarea)

        @php
            $yaEntrego = $entregadas->contains($tarea->id);
        @endphp

        <div class="bg-white p-6 rounded-2xl shadow-md hover:shadow-xl transition
            {{ $yaEntrego ? 'border-l-4 border-green-500' : 'border-l-4 border-yellow-500' }}">

            <h2 class="text-lg font-bold mb-1">{{ $tarea->titulo }}</h2>

            <p class="text-sm text-gray-500 mb-1">
                📘 {{ $tarea->grupo->horario->materia->nombre }}
            </p>

            <p class="text-sm text-gray-500 mb-1">
                👨‍🏫 {{ $tarea->grupo->horario->maestro->nombre }}
            </p>

            <p class="text-sm text-gray-500 mb-3">
                📅 Entrega: {{ $tarea->fecha_entrega }}
            </p>

            @if($tarea->descripcion)
                <p class="text-sm text-gray-600 mb-3">
                    {{ $tarea->descripcion }}
                </p>
            @endif

            @if($yaEntrego)
                <span class="block text-center bg-green-100 text-green-700 py-2 rounded font-semibold text-sm">
                    ✅ Entregada
                </span>
            @else
                <a href="/tareas/{{ $tarea->id }}/subir"
                    class="block text-center bg-blue-600 hover:bg-blue-700 text-white py-2 rounded transition">
                    Subir entrega
                </a>
            @endif

        </div>

    @empty

        <p class="text-gray-500">No tienes tareas pendientes.</p>

    @endforelse

</div>

@endsection