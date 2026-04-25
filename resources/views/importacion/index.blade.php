@extends('layouts.app')
@section('content')
<div class="container-fluid py-3">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2>📦 Importaciones</h2>
        <a href="{{ route('importacion.create') }}" class="btn btn-success">➕ Nueva Importación</a>
    </div>
 
    @if(session('mensaje'))
        <div class="alert alert-success alert-dismissible fade show">{{ session('mensaje') }}<button type="button" class="btn-close" data-bs-dismiss="alert"></button></div>
    @endif
 
    {{-- Filtros --}}
    <form method="GET" class="row g-2 mb-3">
        <div class="col-md-4">
            <input type="text" name="buscar" class="form-control" placeholder="Buscar por número..." value="{{ request('buscar') }}">
        </div>
        <div class="col-md-3">
            <select name="estado" class="form-select">
                <option value="">-- Todos los estados --</option>
                @foreach(['borrador','en_tramite','en_aduana','liberada','entregada','cancelada'] as $e)
                    <option value="{{ $e }}" @selected(request('estado') == $e)>{{ ucfirst(str_replace('_',' ',$e)) }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-md-2">
            <button type="submit" class="btn btn-primary w-100">Filtrar</button>
        </div>
        <div class="col-md-2">
            <a href="{{ route('importacion.index') }}" class="btn btn-outline-secondary w-100">Limpiar</a>
        </div>
    </form>
 
    <div class="card shadow-sm">
        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <thead class="table-dark">
                    <tr>
                        <th>#</th>
                        <th>No. Importación</th>
                        <th>Empresa Extranjera</th>
                        <th>País</th>
                        <th>Fecha Arribo</th>
                        <th>Estado</th>
                        <th>Total CIF</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($importaciones as $imp)
                    <tr>
                        <td>{{ $imp->id_importacion }}</td>
                        <td><strong>{{ $imp->numero_importacion }}</strong></td>
                        <td>{{ $imp->empresaExtranjera?->nombre_empresa ?? $imp->proveedor ?? '—' }}</td>
                        <td>{{ $imp->pais_origen }}</td>
                        <td>{{ $imp->fecha_arribo?->format('d/m/Y') ?? '—' }}</td>
                        <td><span class="badge bg-{{ $imp->estado_color }}">{{ $imp->estado_label }}</span></td>
                        <td>${{ number_format($imp->total_cif, 2) }}</td>
                        <td>
                            <a href="{{ route('importacion.show', $imp->id_importacion) }}" class="btn btn-sm btn-outline-info">Ver</a>
                            <a href="{{ route('importacion.edit', $imp->id_importacion) }}" class="btn btn-sm btn-warning">Editar</a>
                            <form action="{{ route('importacion.destroy', $imp->id_importacion) }}" method="POST" class="d-inline">
                                @csrf @method('DELETE')
                                <button class="btn btn-sm btn-danger" onclick="return confirm('¿Eliminar?')">Borrar</button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr><td colspan="8" class="text-center py-4 text-muted">No hay importaciones registradas</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    <div class="mt-3">{{ $importaciones->withQueryString()->links() }}</div>
</div>
@endsection