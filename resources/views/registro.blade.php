<!DOCTYPE html>
<html>
<head>
<title>Registro</title>
@vite('resources/css/app.css')
</head>

<body class="bg-gradient-to-br from-blue-500 to-indigo-600 flex items-center justify-center min-h-screen">

<div class="bg-white p-8 rounded-2xl shadow-xl w-96">

<h2 class="text-3xl font-bold mb-6 text-center text-gray-800">
Crear cuenta
</h2>

@if ($errors->any())
<div class="bg-red-100 text-red-700 p-3 rounded mb-4 text-sm">
    <ul class="list-disc pl-5">
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

<form method="POST" action="/registro">
@csrf

<input type="text" name="nombre"
placeholder="Nombre"
class="w-full border border-gray-300 p-2 mb-4 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">

<input type="text" name="clave_institucional"
placeholder="Clave institucional"
class="w-full border border-gray-300 p-2 mb-4 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">

<input type="password" name="password"
placeholder="Contraseña"
class="w-full border border-gray-300 p-2 mb-4 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">

<select name="rol"
class="w-full border border-gray-300 p-2 mb-4 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
    <option value="alumno">Alumno</option>
    <option value="maestro">Maestro</option>
</select>

<button class="w-full bg-green-600 hover:bg-green-700 transition text-white p-2 rounded-lg font-semibold">
Registrarse
</button>

</form>

<a href="/" class="text-blue-500 text-sm block mt-4 text-center hover:underline">
Volver al login
</a>

</div>

</body>
</html>