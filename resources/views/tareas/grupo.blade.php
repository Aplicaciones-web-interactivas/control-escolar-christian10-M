@extends('layouts.app')

@section('content')

<div class="flex justify-between items-center mb-6">

    <div>
        <h1 class="text-2xl font-bold">{{ $grupo->nombre }}</h1>
        <p class="text-gray-500 text-sm">{{ $grupo->horario->materia->nombre }}</p>
    </div>

    <a href="/tareas/grupo/{{ $grupo->id }}/crear"
        class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-lg font-semibold shadow transition">
        Agregar tarea
    </a>

</div>

<div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">

    @forelse($tareas as $tarea)

        <div class="bg-white p-6 rounded-2xl shadow-md hover:shadow-xl transition">

            <h2 class="text-lg font-bold mb-1">{{ $tarea->titulo }}</h2>

            <p class="text-sm text-gray-500 mb-1">
                📅 Entrega: {{ $tarea->fecha_entrega }}
            </p>

            @if($tarea->descripcion)
                <p class="text-sm text-gray-600 mb-3">
                    {{ $tarea->descripcion }}
                </p>
            @endif

            <p class="text-sm text-gray-500 mb-4">
                📎 {{ $tarea->entregas->count() }} entrega(s)
            </p>

            <a href="/tareas/{{ $tarea->id }}/entregas"
                class="block text-center bg-blue-600 hover:bg-blue-700 text-white py-2 rounded transition text-sm">
                Revisar entregas
            </a>

        </div>

    @empty

        <p class="text-gray-500">Este grupo no tiene tareas aún.</p>

    @endforelse

</div>

@endsection