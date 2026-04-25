@extends('layouts.app')
@section('content')
<div class="container py-3">
    <div class="d-flex justify-content-between mb-3">
        <h2>👤 Agentes Aduanales</h2>
        <a href="{{ route('agente-aduanal.create') }}" class="btn btn-success">➕ Nuevo Agente</a>
    </div>
    @if(session('mensaje'))<div class="alert alert-success">{{ session('mensaje') }}</div>@endif
    <table class="table table-bordered table-hover shadow-sm">
        <thead class="table-dark">
            <tr><th>Nombre</th><th>Patente</th><th>Aduana</th><th>Teléfono</th><th>RFC</th><th>Importaciones</th><th>Acciones</th></tr>
        </thead>
        <tbody>
            @forelse($agentes as $agente)
            <tr>
                <td>{{ $agente->nombre_agente }}</td>
                <td>{{ $agente->num_patente }}</td>
                <td>{{ $agente->aduana_adscrita }}</td>
                <td>{{ $agente->telefono ?? '—' }}</td>
                <td>{{ $agente->RFC_agente ?? '—' }}</td>
                <td><span class="badge bg-primary">{{ $agente->importaciones_count }}</span></td>
                <td>
                    <a href="{{ route('agente-aduanal.edit', $agente->id_agente) }}" class="btn btn-sm btn-warning">Editar</a>
                    <form action="{{ route('agente-aduanal.destroy', $agente->id_agente) }}" method="POST" class="d-inline">
                        @csrf @method('DELETE')
                        <button class="btn btn-sm btn-danger" onclick="return confirm('¿Eliminar?')">Borrar</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr><td colspan="7" class="text-center text-muted">Sin agentes registrados</td></tr>
            @endforelse
        </tbody>
    </table>
    {{ $agentes->links() }}
</div>
@endsection