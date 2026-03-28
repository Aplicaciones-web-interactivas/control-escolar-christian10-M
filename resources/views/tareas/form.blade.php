@extends('layouts.app')

@section('content')

<div class="max-w-xl mx-auto bg-white p-8 rounded-2xl shadow-md">

    <h1 class="text-2xl font-bold mb-2">Agregar Tarea</h1>

    <p class="text-gray-500 text-sm mb-6">
        Grupo: {{ $grupo->nombre }}
    </p>

    <form method="POST" action="/tareas/grupo/{{ $grupo->id }}/crear">
        @csrf

        <div class="mb-4">
            <label class="block text-sm font-semibold text-gray-600 mb-1">
                Título
            </label>
            <input type="text" name="titulo"
                class="w-full border border-gray-300 p-2 rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none">
        </div>

        <div class="mb-4">
            <label class="block text-sm font-semibold text-gray-600 mb-1">
                Descripción (opcional)
            </label>
            <textarea name="descripcion" rows="3"
                class="w-full border border-gray-300 p-2 rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none"></textarea>
        </div>

        <div class="mb-6">
            <label class="block text-sm font-semibold text-gray-600 mb-1">
                Fecha de entrega
            </label>
            <input type="date" name="fecha_entrega"
                class="w-full border border-gray-300 p-2 rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none">
        </div>

        <button class="w-full bg-blue-600 hover:bg-blue-700 transition text-white py-2 rounded-lg font-semibold">
            Guardar Tarea
        </button>

    </form>

</div>

@endsection