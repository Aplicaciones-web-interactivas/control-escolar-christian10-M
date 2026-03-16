<!DOCTYPE html>
<html>
<head>
<title>Registro</title>
@vite('resources/css/app.css')
</head>

<body class="bg-gray-100 flex items-center justify-center h-screen">

<div class="bg-white p-8 rounded shadow w-96">

<h2 class="text-2xl mb-6 text-center">Registro</h2>

@if ($errors->any())
<div class="bg-red-100 p-3 mb-4">
    <ul>
        @foreach ($errors->all() as $error)
            <li class="text-red-600">{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

<form method="POST" action="/registro">
@csrf

<input type="text" name="nombre"
placeholder="Nombre"
class="w-full border p-2 mb-4">

<input type="text" name="clave_institucional"
placeholder="Clave institucional"
class="w-full border p-2 mb-4">

<input type="password" name="password"
placeholder="Contraseña"
class="w-full border p-2 mb-4">

<select name="rol" class="w-full border p-2 mb-4">
<option value="alumno">Alumno</option>
<option value="maestro">Maestro</option>
</select>

<button class="w-full bg-green-600 text-white p-2 rounded">
Registrarse
</button>

</form>

<a href="/" class="text-blue-500 text-sm block mt-4 text-center">
Volver al login
</a>

</div>

</body>
</html>