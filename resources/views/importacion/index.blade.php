@extends('layouts.app')

@section('content')
<div class="container-fluid py-3">
    <div class="d-flex justify-content-between mb-3">
        <h2>📦 Importaciones</h2>
        <a href="{{ route('importacion.create') }}" class="btn btn-success">➕ Nueva Importación</a>
    </div>

    @if(session('mensaje'))
        <div class="alert alert-success">{{ session('mensaje') }}</div>
    @endif

    {{-- Filtros --}}
    <form method="GET" class="card card-body mb-3 shadow-sm">
        <div class="row g-2 align-items-end">
            <div class="col-md-4">
                <label class="form-label small fw-bold">Buscar por número</label>
                <input type="text" name="buscar" class="form-control form-control-sm"
                       value="{{ request('buscar') }}" placeholder="IMP-2026-001">
            </div>
            <div class="col-md-3">
                <label class="form-label small fw-bold">Estado</label>
                <select name="estado" class="form-select form-select-sm">
                    <option value="">Todos</option>
                    @foreach(['borrador','en_tramite','en_aduana','liberada','entregada','cancelada'] as $e)
                        <option value="{{ $e }}" {{ request('estado') === $e ? 'selected' : '' }}>
                            {{ ucfirst(str_replace('_',' ', $e)) }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-2">
                <button class="btn btn-primary btn-sm w-100">🔍 Filtrar</button>
            </div>
            <div class="col-md-2">
                <a href="{{ route('importacion.index') }}" class="btn btn-outline-secondary btn-sm w-100">Limpiar</a>
            </div>
        </div>
    </form>

    <table class="table table-bordered table-hover shadow-sm bg-white">
        <thead class="table-dark">
            <tr>
                <th>No.</th>
                <th>Empresa MX</th>
                <th>Empresa Extranjera</th>
                <th>País</th>
                <th>Estado</th>
                <th>Total CIF</th>
                <th>Fecha Arribo</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @forelse($importaciones as $imp)
                <tr>
                    <td><strong>{{ $imp->numero_importacion }}</strong></td>
                    <td>{{ $imp->empresaImportadora?->razon_social ?? '—' }}</td>
                    <td>{{ $imp->empresaExtranjera?->nombre_empresa ?? $imp->proveedor ?? '—' }}</td>
                    <td>{{ $imp->pais_origen }}</td>
                    <td><span class="badge bg-{{ $imp->estado_color }}">{{ $imp->estado_label }}</span></td>
                    <td>${{ number_format($imp->total_cif, 2) }}</td>
                    <td>{{ $imp->fecha_arribo?->format('d/m/Y') ?? '—' }}</td>
                    <td>
                        <a href="{{ route('importacion.show', $imp->id_importacion) }}"
                           class="btn btn-sm btn-info">Ver</a>
                        <a href="{{ route('importacion.edit', $imp->id_importacion) }}"
                           class="btn btn-sm btn-warning">Editar</a>
                        <form action="{{ route('importacion.destroy', $imp->id_importacion) }}"
                              method="POST" class="d-inline">
                            @csrf @method('DELETE')
                            <button class="btn btn-sm btn-danger"
                                    onclick="return confirm('¿Eliminar importación?')">Borrar</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr><td colspan="8" class="text-center text-muted">Sin importaciones</td></tr>
            @endforelse
        </tbody>
    </table>

    {{ $importaciones->withQueryString()->links() }}
</div>
@endsection
