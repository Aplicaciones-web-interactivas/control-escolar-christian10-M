@extends('layouts.app')

@section('content')

<h2 class="text-xl font-bold mb-4">Oferta de Cursos</h2>

@foreach($grupos as $grupo)
<div class="border p-4 mb-3 rounded">

    <h3 class="font-bold">{{ $grupo->nombre }}</h3>

    <p>{{ $grupo->horario->materia->nombre }}</p>
    <p>{{ $grupo->horario->maestro->nombre }}</p>

    <form action="/inscribirse/{{ $grupo->id }}" method="POST">
        @csrf
        <button class="bg-green-600 text-white px-3 py-1 rounded">
            Inscribirme
        </button>
    </form>

</div>
@endforeach

<h2 class="text-xl font-bold mt-8 mb-4">Mis Inscripciones</h2>

@foreach($misInscripciones as $inscripcion)
<div class="border p-4 mb-3 rounded bg-gray-100">

    <h3 class="font-bold">
        {{ $inscripcion->grupo->nombre }}
    </h3>

    <p>{{ $inscripcion->grupo->horario->materia->nombre }}</p>
    <p>{{ $inscripcion->grupo->horario->maestro->nombre }}</p>

    <form action="/inscripciones/{{ $inscripcion->id }}" method="POST">
        @csrf
        @method('DELETE')

        <button class="bg-red-600 text-white px-3 py-1 rounded">
            Dar de baja
        </button>
    </form>

</div>
@endforeach

@endsection