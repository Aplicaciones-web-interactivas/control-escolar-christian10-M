<form method="GET" class="mb-6">
    <div class="relative">

        <input
            type="text"
            name="buscar"
            value="{{ request('buscar') }}"
            placeholder="{{ $placeholder ?? 'Buscar...' }}"
            class="w-full border border-gray-300 rounded-lg p-2 pl-10 pr-10 focus:outline-none focus:ring-2 focus:ring-blue-500"
        >

        <!-- Icono izquierda -->
        <span class="absolute left-3 top-2.5 text-gray-400">
            🔍
        </span>

        <!-- Botón limpiar -->
        @if(request('buscar'))
        <a href="{{ url()->current() }}"
           class="absolute right-3 top-2.5 text-gray-400 hover:text-red-500">
            ✖
        </a>
        @endif

    </div>
</form>