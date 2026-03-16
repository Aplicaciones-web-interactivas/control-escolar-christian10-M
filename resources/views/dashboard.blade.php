<h1>Bienvenido {{ session('usuario_nombre') }}</h1>

<form method="POST" action="/logout">
@csrf
<button>Cerrar sesión</button>
</form>