@extends('layouts.app')

@section('content')

<h1 class="text-3xl font-bold mb-6">
Panel de Control
</h1>

<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
<div class="bg-white p-6 rounded shadow">
<h2 class="text-xl font-semibold">Materias</h2>
<a href="/materias" class="text-blue-600">Administrar</a>
</div>

<div class="bg-white p-6 rounded shadow">
<h2 class="text-xl font-semibold">Horarios</h2>
<a href="/horarios" class="text-blue-600">Administrar</a>
</div>

<div class="bg-white p-6 rounded shadow">
<h2 class="text-xl font-semibold">Grupos</h2>
<a href="/grupos" class="text-blue-600">Administrar</a>
</div>

<div class="bg-white p-6 rounded shadow">
<h2 class="text-xl font-semibold">Inscripciones</h2>
<a href="/inscripciones" class="text-blue-600">Administrar</a>
</div>

<div class="bg-white p-6 rounded shadow">
<h2 class="text-xl font-semibold">Calificaciones</h2>
<a href="/calificaciones" class="text-blue-600">Administrar</a>
</div>

</div>

@endsection