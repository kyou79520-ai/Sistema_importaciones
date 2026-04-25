@extends('layouts.app')
@section('content')
<div class="container-fluid py-3">
    <h2 class="mb-4">📦 Dashboard - Sistema de Importaciones</h2>
 
    {{-- Tarjetas de estadísticas --}}
    <div class="row g-3 mb-4">
        <div class="col-md-2">
            <div class="card text-white bg-primary shadow-sm">
                <div class="card-body text-center">
                    <div class="fs-2 fw-bold">{{ $stats['total_importaciones'] }}</div>
                    <div class="small">Total Importaciones</div>
                </div>
            </div>
        </div>
        <div class="col-md-2">
            <div class="card text-white bg-info shadow-sm">
                <div class="card-body text-center">
                    <div class="fs-2 fw-bold">{{ $stats['en_tramite'] }}</div>
                    <div class="small">En Trámite</div>
                </div>
            </div>
        </div>
        <div class="col-md-2">
            <div class="card text-white bg-warning shadow-sm">
                <div class="card-body text-center">
                    <div class="fs-2 fw-bold">{{ $stats['en_aduana'] }}</div>
                    <div class="small">En Aduana</div>
                </div>
            </div>
        </div>
        <div class="col-md-2">
            <div class="card text-white bg-success shadow-sm">
                <div class="card-body text-center">
                    <div class="fs-2 fw-bold">{{ $stats['liberadas'] }}</div>
                    <div class="small">Liberadas</div>
                </div>
            </div>
        </div>
        <div class="col-md-2">
            <div class="card text-white bg-dark shadow-sm">
                <div class="card-body text-center">
                    <div class="fs-5 fw-bold">${{ number_format($stats['total_pagos'],0) }}</div>
                    <div class="small">Total Pagos</div>
                </div>
            </div>
        </div>
        <div class="col-md-2">
            <div class="card text-white bg-danger shadow-sm">
                <div class="card-body text-center">
                    <div class="fs-2 fw-bold">{{ $stats['docs_pendientes'] }}</div>
                    <div class="small">Docs. sin validar</div>
                </div>
            </div>
        </div>
    </div>
 
    {{-- Accesos rápidos --}}
    <div class="row g-3 mb-4">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header fw-bold">Accesos Rápidos</div>
                <div class="card-body d-flex flex-wrap gap-2">
                    <a href="{{ route('importacion.create') }}" class="btn btn-primary">➕ Nueva Importación</a>
                    <a href="{{ route('importacion.index') }}" class="btn btn-outline-primary">📋 Ver Importaciones</a>
                    <a href="{{ route('agente-aduanal.index') }}" class="btn btn-outline-secondary">👤 Agentes Aduanales</a>
                    <a href="{{ route('empresa-extranjera.index') }}" class="btn btn-outline-secondary">🌐 Empresas Extranjeras</a>
                    <a href="{{ route('empresa-importadora.index') }}" class="btn btn-outline-secondary">🏢 Empresas Importadoras</a>
                </div>
            </div>
        </div>
    </div>
 
    {{-- Importaciones recientes --}}
    <div class="card shadow-sm">
        <div class="card-header fw-bold">Importaciones Recientes</div>
        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <thead class="table-light">
                    <tr>
                        <th>No. Importación</th>
                        <th>Proveedor/Empresa</th>
                        <th>País Origen</th>
                        <th>Estado</th>
                        <th>Fecha Arribo</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($recientes as $imp)
                    <tr>
                        <td><strong>{{ $imp->numero_importacion }}</strong></td>
                        <td>{{ $imp->empresaExtranjera?->nombre_empresa ?? $imp->proveedor ?? '—' }}</td>
                        <td>{{ $imp->pais_origen }}</td>
                        <td>
                            <span class="badge bg-{{ $imp->estado_color }}">{{ $imp->estado_label }}</span>
                        </td>
                        <td>{{ $imp->fecha_arribo?->format('d/m/Y') ?? '—' }}</td>
                        <td>
                            <a href="{{ route('importacion.show', $imp->id_importacion) }}" class="btn btn-sm btn-outline-primary">Ver</a>
                        </td>
                    </tr>
                    @empty
                    <tr><td colspan="6" class="text-center text-muted py-3">No hay importaciones registradas</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection