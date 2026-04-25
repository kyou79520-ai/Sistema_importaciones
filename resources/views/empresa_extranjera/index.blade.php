@extends('layouts.app')
@section('content')
<div class="container py-3">
    <div class="d-flex justify-content-between mb-3">
        <h2>🌐 Empresas Extranjeras</h2>
        <a href="{{ route('empresa-extranjera.create') }}" class="btn btn-success">➕ Nueva Empresa</a>
    </div>
    @if(session('mensaje'))<div class="alert alert-success">{{ session('mensaje') }}</div>@endif
    <table class="table table-bordered table-hover">
        <thead class="table-dark"><tr><th>Nombre</th><th>País</th><th>Contacto</th><th>Moneda</th><th>Tax ID</th><th>Acciones</th></tr></thead>
        <tbody>
            @forelse($empresas as $e)
            <tr>
                <td>{{ $e->nombre_empresa }}</td>
                <td>{{ $e->pais_origen }}</td>
                <td>{{ $e->contacto ?? '—' }}</td>
                <td>{{ $e->moneda_default }}</td>
                <td>{{ $e->num_tax_id ?? '—' }}</td>
                <td>
                    <a href="{{ route('empresa-extranjera.edit', $e->id_empresa) }}" class="btn btn-sm btn-warning">Editar</a>
                    <form action="{{ route('empresa-extranjera.destroy', $e->id_empresa) }}" method="POST" class="d-inline">
                        @csrf @method('DELETE')
                        <button class="btn btn-sm btn-danger" onclick="return confirm('¿Eliminar?')">Borrar</button>
                    </form>
                </td>
            </tr>
            @empty<tr><td colspan="6" class="text-center text-muted">Sin empresas registradas</td></tr>@endforelse
        </tbody>
    </table>
    {{ $empresas->links() }}
</div>
@endsection