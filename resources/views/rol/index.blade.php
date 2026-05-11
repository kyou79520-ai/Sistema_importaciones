{{-- ARCHIVO: resources/views/rol/index.blade.php --}}
@extends('layouts.app')
@section('content')
<div class="container py-3">
    <div class="d-flex justify-content-between mb-3">
        <h2>🔐 Roles del Sistema</h2>
        <a href="{{ route('rol.create') }}" class="btn btn-success">➕ Nuevo Rol</a>
    </div>
    @if(session('mensaje'))<div class="alert alert-success">{{ session('mensaje') }}</div>@endif
    <table class="table table-bordered table-hover shadow-sm">
        <thead class="table-dark">
            <tr><th>Nombre</th><th>Descripción</th><th>Usuarios</th><th>Permisos</th><th>Acciones</th></tr>
        </thead>
        <tbody>
            @forelse($roles as $rol)
            <tr>
                <td><strong>{{ $rol->nombre }}</strong></td>
                <td>{{ $rol->descripcion ?? '—' }}</td>
                <td><span class="badge bg-info">{{ $rol->usuarios_count }}</span></td>
                <td><span class="badge bg-secondary">{{ $rol->permisos_count }}</span></td>
                <td>
                    <a href="{{ route('rol.edit', $rol->id_rol) }}" class="btn btn-sm btn-warning">Editar</a>
                    <form action="{{ route('rol.destroy', $rol->id_rol) }}" method="POST" class="d-inline">
                        @csrf @method('DELETE')
                        <button class="btn btn-sm btn-danger" onclick="return confirm('¿Eliminar rol?')">Borrar</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr><td colspan="5" class="text-center text-muted">Sin roles</td></tr>
            @endforelse
        </tbody>
    </table>
    {{ $roles->links() }}
</div>
@endsection