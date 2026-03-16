<!DOCTYPE html>
<html>
<head>
<title>Login</title>
@vite('resources/css/app.css')
</head>

<body class="bg-gray-100 flex items-center justify-center h-screen">

<div class="bg-white p-8 rounded shadow w-96">

<h2 class="text-2xl mb-6 text-center">Login</h2>

@if(session('error'))
<p class="text-red-500">{{ session('error') }}</p>
@endif

<form method="POST" action="/login">
@csrf

<input type="text" name="clave_institucional"
placeholder="Clave institucional"
class="w-full border p-2 mb-4">

<input type="password" name="password"
placeholder="Contraseña"
class="w-full border p-2 mb-4">

<button class="w-full bg-blue-600 text-white p-2 rounded">
Entrar
</button>

</form>

<a href="/registro" class="text-blue-500 text-sm block mt-4 text-center">
Crear cuenta
</a>

</div>

</body>
</html>