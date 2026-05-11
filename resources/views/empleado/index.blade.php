Mostrar las lista de empleados
@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Lista de empleados</h2>

    @if (session('mensaje'))
        <div class="alert alert-success">{{ session('mensaje') }}</div>
    @endif

    <a href="{{ url('/empleado/create') }}" class="btn btn-success mb-3">Agregar empleado</a>

    <table class="table table-light table-bordered">
        <thead class="thead-light">
            <tr>
                <th>#</th>
                <th>Foto</th>
                <th>Nombre</th>
                <th>Apellido Paterno</th>
                <th>Apellido Materno</th>
                <th>Correo</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($empleados as $empleado)
            <tr>
                <td>{{ $empleado->id }}</td>
                <td>
                    @if ($empleado->Foto)
                        <img src="{{ asset('storage/' . $empleado->Foto) }}" width="60">
                    @endif
                </td>
                <td>{{ $empleado->Nombre }}</td>
                <td>{{ $empleado->ApellidoPaterno }}</td>
                <td>{{ $empleado->ApellidoMaterno }}</td>
                <td>{{ $empleado->correo }}</td>
                <td>
                    <a href="{{ url('/empleado/' . $empleado->id . '/edit') }}" class="btn btn-warning btn-sm">Editar</a>

                    <form action="{{ url('/empleado/' . $empleado->id) }}" method="post" style="display:inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm"
                            onclick="return confirm('¿Quieres borrar este empleado?')">
                            Borrar
                        </button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    {{ $empleados->links() }}
</div>
@endsection