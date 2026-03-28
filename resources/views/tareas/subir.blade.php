@extends('layouts.app')

@section('content')

<div class="max-w-xl mx-auto">

    <div class="bg-white p-6 rounded-2xl shadow mb-6">

        <h1 class="text-2xl font-bold mb-1">{{ $tarea->titulo }}</h1>

        <p class="text-sm text-gray-500 mb-1">
            📘 {{ $tarea->grupo->horario->materia->nombre }}
        </p>

        <p class="text-sm text-gray-500 mb-1">
            📅 Fecha de entrega: {{ $tarea->fecha_entrega }}
        </p>

        @if($tarea->descripcion)
            <p class="text-gray-600 text-sm mt-2">
                {{ $tarea->descripcion }}
            </p>
        @endif

    </div>

    <div class="bg-white p-6 rounded-2xl shadow">

        @if($entrega)
            <div class="mb-4 p-3 bg-green-50 border border-green-200 rounded-lg">
                <p class="text-green-700 text-sm font-semibold">✅ Ya entregaste esta tarea</p>
                <a href="{{ asset('storage/' . $entrega->archivo) }}"
                    target="_blank"
                    class="text-blue-500 text-sm hover:underline">
                    Ver mi entrega
                </a>
            </div>
            <p class="text-sm text-gray-500 mb-4">¿Quieres reemplazarla? Sube otro archivo:</p>
        @else
            <h2 class="text-lg font-semibold mb-4">Subir entrega</h2>
        @endif

        <form method="POST"
            action="/tareas/{{ $tarea->id }}/subir"
            enctype="multipart/form-data">
            @csrf

            @if($errors->any())
                <div class="bg-red-100 text-red-700 p-3 rounded mb-4 text-sm">
                    @foreach($errors->all() as $error)
                        <p>{{ $error }}</p>
                    @endforeach
                </div>
            @endif

            <div class="mb-6">
                <label class="block text-sm font-semibold text-gray-600 mb-1">
                    Archivo PDF (máx. 5MB)
                </label>
                <input type="file" name="archivo" accept=".pdf"
                    class="w-full border border-gray-300 p-2 rounded-lg focus:outline-none">
            </div>

            <button class="w-full bg-blue-600 hover:bg-blue-700 transition text-white py-2 rounded-lg font-semibold">
                Subir PDF
            </button>

        </form>

    </div>

</div>

@endsection