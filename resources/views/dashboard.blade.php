@extends('layouts.app')

@section('content')

<h1 class="text-3xl font-bold mb-8 text-gray-800">
Panel de Control
</h1>

<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">

    <a href="/materias" class="bg-white p-6 rounded-2xl shadow-md hover:shadow-xl transition transform hover:-translate-y-1">
        <div class="flex items-center gap-4">
            <div class="bg-blue-100 text-blue-600 p-3 rounded-full text-xl">
                📚
            </div>
            <div>
                <h2 class="text-lg font-semibold text-gray-800">Materias</h2>
                <p class="text-gray-500 text-sm">Gestionar materias</p>
            </div>
        </div>
    </a>

    <a href="/horarios" class="bg-white p-6 rounded-2xl shadow-md hover:shadow-xl transition transform hover:-translate-y-1">
        <div class="flex items-center gap-4">
            <div class="bg-green-100 text-green-600 p-3 rounded-full text-xl">
                ⏰
            </div>
            <div>
                <h2 class="text-lg font-semibold text-gray-800">Horarios</h2>
                <p class="text-gray-500 text-sm">Organizar horarios</p>
            </div>
        </div>
    </a>

    <a href="/grupos" class="bg-white p-6 rounded-2xl shadow-md hover:shadow-xl transition transform hover:-translate-y-1">
        <div class="flex items-center gap-4">
            <div class="bg-purple-100 text-purple-600 p-3 rounded-full text-xl">
                👥
            </div>
            <div>
                <h2 class="text-lg font-semibold text-gray-800">Grupos</h2>
                <p class="text-gray-500 text-sm">Administrar grupos</p>
            </div>
        </div>
    </a>

    <a href="/inscripciones" class="bg-white p-6 rounded-2xl shadow-md hover:shadow-xl transition transform hover:-translate-y-1">
        <div class="flex items-center gap-4">
            <div class="bg-yellow-100 text-yellow-600 p-3 rounded-full text-xl">
                📝
            </div>
            <div>
                <h2 class="text-lg font-semibold text-gray-800">Inscripciones</h2>
                <p class="text-gray-500 text-sm">Gestionar inscripciones</p>
            </div>
        </div>
    </a>

    <a href="/calificaciones" class="bg-white p-6 rounded-2xl shadow-md hover:shadow-xl transition transform hover:-translate-y-1">
        <div class="flex items-center gap-4">
            <div class="bg-red-100 text-red-600 p-3 rounded-full text-xl">
                📊
            </div>
            <div>
                <h2 class="text-lg font-semibold text-gray-800">Calificaciones</h2>
                <p class="text-gray-500 text-sm">Evaluar alumnos</p>
            </div>
        </div>
    </a>

</div>

@endsection