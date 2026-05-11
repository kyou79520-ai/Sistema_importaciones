@extends('layouts.app')

@section('content')
<div class="container py-3">
    <div class="d-flex justify-content-between mb-3">
        <h2>🗝️ Permisos del Sistema</h2>
        <a href="{{ route('permiso.create') }}" class="btn btn-success">➕ Nuevo Permiso</a>
    </div>

    @if(session('mensaje'))
        <div class="alert alert-success">{{ session('mensaje') }}</div>
    @endif

    <table class="table table-bordered table-hover shadow-sm">
        <thead class="table-dark">
            <tr><th>Módulo</th><th>Nombre</th><th>Descripción</th><th>Acciones</th></tr>
        </thead>
        <tbody>
            @forelse($permisos as $p)
                <tr>
                    <td><span class="badge bg-secondary">{{ $p->modulo }}</span></td>
                    <td><code>{{ $p->nombre }}</code></td>
                    <td>{{ $p->descripcion ?? '—' }}</td>
                    <td>
                        <a href="{{ route('permiso.edit', $p->id_permiso) }}" class="btn btn-sm btn-warning">Editar</a>
                        <form action="{{ route('permiso.destroy', $p->id_permiso) }}" method="POST" class="d-inline">
                            @csrf @method('DELETE')
                            <button class="btn btn-sm btn-danger" onclick="return confirm('¿Eliminar?')">Borrar</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr><td colspan="4" class="text-center text-muted">Sin permisos</td></tr>
            @endforelse
        </tbody>
    </table>

    {{ $permisos->links() }}
</div>
@endsection
