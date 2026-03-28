<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>Control Escolar</title>
@vite('resources/css/app.css')
</head>

<body class="bg-gray-100">

<nav class="bg-blue-600 text-white p-4">
<div class="max-w-7xl mx-auto flex justify-between">

<div class="space-x-4">

<a href="/dashboard" class="font-bold">Home</a>

<a href="/materias">Materias</a>

<a href="/horarios">Horarios</a>

<a href="/grupos">Grupos</a>

<a href="/inscripciones">Inscripciones</a>

<a href="/calificaciones">Calificaciones</a>

<a href="/tareas">Tareas</a>


</div>

<div>

<span class="mr-4">
{{ session('usuario_nombre') }}
</span>

<form method="POST" action="/logout" class="inline">
@csrf
<button class="bg-red-500 px-3 py-1 rounded">
Salir
</button>
</form>

</div>

</div>
</nav>

<div class="max-w-7xl mx-auto p-6">

@yield('content')

</div>

</body>
</html>