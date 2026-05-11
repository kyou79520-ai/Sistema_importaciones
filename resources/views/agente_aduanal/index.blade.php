@extends('layouts.app')

@section('content')
<div class="container py-3">
    <div class="d-flex justify-content-between mb-3">
        <h2>👤 Agentes Aduanales</h2>
        <a href="{{ route('agente-aduanal.create') }}" class="btn btn-success">➕ Nuevo Agente</a>
    </div>

    @if(session('mensaje'))
        <div class="alert alert-success">{{ session('mensaje') }}</div>
    @endif

    <table class="table table-bordered table-hover shadow-sm">
        <thead class="table-dark">
            <tr>
                <th>Nombre</th>
                <th>Patente</th>
                <th>Aduana</th>
                <th>RFC</th>
                <th>Importaciones</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @forelse($agentes as $ag)
                <tr>
                    <td><strong>{{ $ag->nombre_agente }}</strong></td>
                    <td><code>{{ $ag->num_patente }}</code></td>
                    <td>{{ $ag->aduana_adscrita }}</td>
                    <td>{{ $ag->RFC_agente ?? '—' }}</td>
                    <td><span class="badge bg-info">{{ $ag->importaciones_count }}</span></td>
                    <td>
                        <a href="{{ route('agente-aduanal.edit', $ag->id_agente) }}"
                           class="btn btn-sm btn-warning">Editar</a>
                        <form action="{{ route('agente-aduanal.destroy', $ag->id_agente) }}"
                              method="POST" class="d-inline">
                            @csrf @method('DELETE')
                            <button class="btn btn-sm btn-danger"
                                    onclick="return confirm('¿Eliminar agente?')">Borrar</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr><td colspan="6" class="text-center text-muted">Sin agentes registrados</td></tr>
            @endforelse
        </tbody>
    </table>

    {{ $agentes->links() }}
</div>
@endsection
