<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Sistema de Importaciones') }}</title>

    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    📦 {{ config('app.name', 'Sistema Importaciones') }}
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                        data-bs-target="#navbarSupportedContent">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto">
                        @auth
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('dashboard') }}">🏠 Dashboard</a>
                            </li>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown">📦 Importaciones</a>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="{{ route('importacion.index') }}">Ver todas</a></li>
                                    <li><a class="dropdown-item" href="{{ route('importacion.create') }}">Nueva importación</a></li>
                                </ul>
                            </li>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown">📁 Catálogos</a>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="{{ route('agente-aduanal.index') }}">Agentes Aduanales</a></li>
                                    <li><a class="dropdown-item" href="{{ route('empresa-extranjera.index') }}">Empresas Extranjeras</a></li>
                                    <li><a class="dropdown-item" href="{{ route('empresa-importadora.index') }}">Empresas Importadoras</a></li>
                                    <li><hr class="dropdown-divider"></li>
                                    <li><a class="dropdown-item" href="{{ route('empleado.index') }}">Empleados</a></li>
                                </ul>
                            </li>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown">⚙️ Admin</a>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="{{ route('usuario.index') }}">Usuarios</a></li>
                                    <li><a class="dropdown-item" href="{{ route('rol.index') }}">Roles</a></li>
                                    <li><a class="dropdown-item" href="{{ route('permiso.index') }}">Permisos</a></li>
                                </ul>
                            </li>
                        @endauth
                    </ul>

                    <ul class="navbar-nav ms-auto">
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">Iniciar sesión</a>
                                </li>
                            @endif
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">Registrarse</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#"
                                   role="button" data-bs-toggle="dropdown" v-pre>
                                    {{ Auth::user()->nombre_completo }}
                                </a>
                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="#"
                                       onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                        🚪 Cerrar Sesión
                                    </a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>
    </div>
</body>
</html>
