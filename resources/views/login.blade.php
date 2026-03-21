<!DOCTYPE html>
<html>
<head>
<title>Login</title>
@vite('resources/css/app.css')
</head>

<body class="bg-gradient-to-br from-blue-500 to-indigo-600 flex items-center justify-center h-screen">

<div class="bg-white p-8 rounded-2xl shadow-xl w-96">

<h2 class="text-3xl font-bold mb-6 text-center text-gray-800">
Bienvenido
</h2>

@if(session('error'))
<div class="bg-red-100 text-red-700 p-3 rounded mb-4 text-sm">
    {{ session('error') }}
</div>
@endif

<form method="POST" action="/login">
@csrf

<input type="text" name="clave_institucional"
placeholder="Clave institucional"
class="w-full border border-gray-300 p-2 mb-4 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">

<input type="password" name="password"
placeholder="Contraseña"
class="w-full border border-gray-300 p-2 mb-4 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">

<button class="w-full bg-blue-600 hover:bg-blue-700 transition text-white p-2 rounded-lg font-semibold">
Entrar
</button>

</form>

<a href="/registro" class="text-blue-500 text-sm block mt-4 text-center hover:underline">
Crear cuenta
</a>

</div>

</body>
</html>