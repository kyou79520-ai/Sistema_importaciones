@extends('layouts.app')

@section('content')
<div class="container py-3">
    <div class="d-flex justify-content-between mb-3">
        <h2>🏢 Empresas Importadoras</h2>
        <a href="{{ route('empresa-importadora.create') }}" class="btn btn-success">➕ Nueva</a>
    </div>

    @if(session('mensaje'))
        <div class="alert alert-success">{{ session('mensaje') }}</div>
    @endif

    <table class="table table-bordered table-hover shadow-sm">
        <thead class="table-dark">
            <tr>
                <th>RFC</th>
                <th>Razón Social</th>
                <th>Padrón</th>
                <th>Giro</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @forelse($empresas as $emp)
                <tr>
                    <td><code>{{ $emp->RFC_empresa }}</code></td>
                    <td><strong>{{ $emp->razon_social }}</strong></td>
                    <td>
                        @if($emp->padron_importadores)
                            <span class="badge bg-success">Sí</span>
                        @else
                            <span class="badge bg-secondary">No</span>
                        @endif
                    </td>
                    <td>{{ $emp->giro_comercial ?? '—' }}</td>
                    <td>
                        <a href="{{ route('empresa-importadora.edit', $emp->id_empresa_mx) }}"
                           class="btn btn-sm btn-warning">Editar</a>
                        <form action="{{ route('empresa-importadora.destroy', $emp->id_empresa_mx) }}"
                              method="POST" class="d-inline">
                            @csrf @method('DELETE')
                            <button class="btn btn-sm btn-danger"
                                    onclick="return confirm('¿Eliminar empresa?')">Borrar</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr><td colspan="5" class="text-center text-muted">Sin empresas registradas</td></tr>
            @endforelse
        </tbody>
    </table>

    {{ $empresas->links() }}
</div>
@endsection
