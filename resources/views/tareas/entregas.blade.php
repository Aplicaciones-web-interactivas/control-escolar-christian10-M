@extends('layouts.app')

@section('content')

<div class="mb-6">
    <h1 class="text-2xl font-bold mb-1">Entregas — {{ $tarea->titulo }}</h1>
    <p class="text-gray-500 text-sm">
        📘 {{ $tarea->grupo->horario->materia->nombre }} |
        📅 Fecha límite: {{ $tarea->fecha_entrega }}
    </p>
</div>

<div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">

    @forelse($tarea->entregas as $entrega)

        <div class="bg-white p-6 rounded-2xl shadow-md hover:shadow-xl transition">

            <h2 class="text-lg font-semibold mb-1">
                {{ $entrega->usuario->nombre }}
            </h2>

            <p class="text-sm text-gray-500 mb-4">
                📎 Entregado el {{ $entrega->created_at->format('d/m/Y') }}
            </p>

            <a href="{{ asset('storage/' . $entrega->archivo) }}"
                target="_blank"
                class="block text-center bg-blue-600 hover:bg-blue-700 text-white py-2 rounded transition text-sm">
                Ver PDF
            </a>

        </div>

    @empty

        <p class="text-gray-500">Ningún alumno ha entregado aún.</p>

    @endforelse

</div>

@endsection