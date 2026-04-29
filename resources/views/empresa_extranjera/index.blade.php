@extends('layouts.app')

@section('content')
<div class="container py-3">
    <div class="d-flex justify-content-between mb-3">
        <h2>🌐 Empresas Extranjeras</h2>
        <a href="{{ route('empresa-extranjera.create') }}" class="btn btn-success">➕ Nueva</a>
    </div>

    @if(session('mensaje'))
        <div class="alert alert-success">{{ session('mensaje') }}</div>
    @endif

    <table class="table table-bordered table-hover shadow-sm">
        <thead class="table-dark">
            <tr>
                <th>Empresa</th>
                <th>País</th>
                <th>Moneda</th>
                <th>Tax ID</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @forelse($empresas as $emp)
                <tr>
                    <td><strong>{{ $emp->nombre_empresa }}</strong></td>
                    <td>{{ $emp->pais_origen }}</td>
                    <td>{{ $emp->moneda_default ?? '—' }}</td>
                    <td>{{ $emp->num_tax_id ?? '—' }}</td>
                    <td>
                        <a href="{{ route('empresa-extranjera.edit', $emp->id_empresa) }}"
                           class="btn btn-sm btn-warning">Editar</a>
                        <form action="{{ route('empresa-extranjera.destroy', $emp->id_empresa) }}"
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
