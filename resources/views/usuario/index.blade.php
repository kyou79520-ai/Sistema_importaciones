@extends('layouts.app')
@section('content')
<div class="container py-3">
    <div class="d-flex justify-content-between mb-3">
        <h2>👥 Usuarios del Sistema</h2>
        <a href="{{ route('usuario.create') }}" class="btn btn-success">➕ Nuevo Usuario</a>
    </div>
    @if(session('mensaje'))<div class="alert alert-success">{{ session('mensaje') }}</div>@endif
    <table class="table table-bordered table-hover shadow-sm">
        <thead class="table-dark">
            <tr><th>Usuario</th><th>Nombre</th><th>Email</th><th>Roles</th><th>Activo</th><th>Acciones</th></tr>
        </thead>
        <tbody>
            @forelse($usuarios as $u)
            <tr>
                <td><strong>{{ $u->nombre_usuario }}</strong></td>
                <td>{{ $u->nombre_completo }}</td>
                <td>{{ $u->email }}</td>
                <td>
                    @foreach($u->roles as $rol)
                        <span class="badge bg-primary">{{ $rol->nombre }}</span>
                    @endforeach
                </td>
                <td>
                    @if($u->activo)
                        <span class="badge bg-success">Activo</span>
                    @else
                        <span class="badge bg-secondary">Inactivo</span>
                    @endif
                </td>
                <td>
                    <a href="{{ route('usuario.edit', $u->id_usuario) }}" class="btn btn-sm btn-warning">Editar</a>
                    <form action="{{ route('usuario.destroy', $u->id_usuario) }}" method="POST" class="d-inline">
                        @csrf @method('DELETE')
                        <button class="btn btn-sm btn-danger" onclick="return confirm('¿Eliminar usuario?')">Borrar</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr><td colspan="6" class="text-center text-muted">Sin usuarios</td></tr>
            @endforelse
        </tbody>
    </table>
    {{ $usuarios->links() }}
</div>
@endsection