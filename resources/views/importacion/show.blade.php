@extends('layouts.app')

@section('content')
<div class="container-fluid py-3">
    <div class="d-flex justify-content-between mb-3">
        <h2>📦 Importación: {{ $importacion->numero_importacion }}</h2>
        <div>
            <a href="{{ route('importacion.edit', $importacion->id_importacion) }}" class="btn btn-warning">✏️ Editar</a>
            <a href="{{ route('importacion.index') }}" class="btn btn-outline-secondary">← Volver</a>
        </div>
    </div>

    @if(session('mensaje'))
        <div class="alert alert-success">{{ session('mensaje') }}</div>
    @endif

    <div class="row g-3">
        {{-- Datos generales --}}
        <div class="col-md-6">
            <div class="card shadow-sm h-100">
                <div class="card-header fw-bold">Datos Generales</div>
                <div class="card-body">
                    <table class="table table-sm mb-0">
                        <tr><th>No. Importación</th><td>{{ $importacion->numero_importacion }}</td></tr>
                        <tr>
                            <th>Estado</th>
                            <td><span class="badge bg-{{ $importacion->estado_color }}">{{ $importacion->estado_label }}</span></td>
                        </tr>
                        <tr><th>País Origen</th><td>{{ $importacion->pais_origen }}</td></tr>
                        <tr><th>Proveedor</th><td>{{ $importacion->proveedor ?? '—' }}</td></tr>
                        <tr><th>Empresa Extranjera</th><td>{{ $importacion->empresaExtranjera?->nombre_empresa ?? '—' }}</td></tr>
                        <tr><th>Empresa Importadora</th><td>{{ $importacion->empresaImportadora?->razon_social ?? '—' }}</td></tr>
                        <tr><th>Fecha Arribo</th><td>{{ $importacion->fecha_arribo?->format('d/m/Y') ?? '—' }}</td></tr>
                        <tr><th>Creado por</th><td>{{ $importacion->usuario?->nombre_completo ?? '—' }}</td></tr>
                        <tr><th>Total CIF</th><td><strong>${{ number_format($importacion->total_cif, 2) }}</strong></td></tr>
                        <tr><th>Total Impuestos</th><td>${{ number_format($importacion->total_impuestos, 2) }}</td></tr>
                        <tr><th>Total Aduanales</th><td>${{ number_format($importacion->total_aduanales, 2) }}</td></tr>
                    </table>
                </div>
            </div>
        </div>

        {{-- Agentes --}}
        <div class="col-md-6">
            <div class="card shadow-sm h-100">
                <div class="card-header fw-bold">Agentes Aduanales</div>
                <div class="card-body">
                    @forelse($importacion->agentes ?? [] as $ag)
                        <div class="mb-2 p-2 border rounded">
                            <strong>{{ $ag->nombre_agente }}</strong><br>
                            <small class="text-muted">Patente: {{ $ag->num_patente }} | Aduana: {{ $ag->aduana_adscrita }}</small>
                        </div>
                    @empty
                        <p class="text-muted mb-0">Sin agentes asignados</p>
                    @endforelse
                </div>
            </div>
        </div>
    </div>

    {{-- Partidas --}}
    <div class="card shadow-sm mt-3">
        <div class="card-header fw-bold d-flex justify-content-between">
            <span>📋 Partidas ({{ $importacion->items->count() }})</span>
        </div>
        <div class="card-body">
            <form action="{{ route('importacion.items.store', $importacion->id_importacion) }}" method="POST">
                @csrf
                <div class="row g-2 mb-3 align-items-end">
                    <div class="col-md-3"><input type="text" name="descripcion" class="form-control form-control-sm" placeholder="Descripción *" required></div>
                    <div class="col-md-1"><input type="number" name="cantidad" class="form-control form-control-sm" placeholder="Cantidad" step="0.01" min="0" required></div>
                    <div class="col-md-2">
                        <select name="unidad_medida" class="form-select form-select-sm">
                            @foreach(['PZA','KG','LT','MT','M2','M3','JUEGO','PAR','CAJA','ROLLO'] as $u)
                                <option>{{ $u }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-2"><input type="number" name="valor_unitario" class="form-control form-control-sm" placeholder="Valor unit. USD" step="0.01" min="0" required></div>
                    <div class="col-md-1"><input type="number" name="peso_kg" class="form-control form-control-sm" placeholder="Peso Kg" step="0.01"></div>
                    <div class="col-md-1"><input type="text" name="codigo_hs" class="form-control form-control-sm" placeholder="Cód. HS"></div>
                    <div class="col-md-2"><button class="btn btn-success btn-sm w-100">➕ Agregar</button></div>
                </div>
            </form>

            <table class="table table-sm table-bordered">
                <thead class="table-light">
                    <tr><th>#</th><th>Descripción</th><th>HS</th><th>Cant</th><th>Unid</th><th>Valor U.</th><th>Total</th><th>Peso Kg</th><th></th></tr>
                </thead>
                <tbody>
                    @forelse($importacion->items ?? [] as $item)
                        <tr>
                            <td>{{ $item->numero_linea }}</td>
                            <td>{{ $item->descripcion }}</td>
                            <td>{{ $item->codigo_hs ?? '—' }}</td>
                            <td>{{ number_format($item->cantidad, 2) }}</td>
                            <td>{{ $item->unidad_medida }}</td>
                            <td>${{ number_format($item->valor_unitario, 2) }}</td>
                            <td><strong>${{ number_format($item->valor_total, 2) }}</strong></td>
                            <td>{{ $item->peso_kg ? number_format($item->peso_kg, 2) : '—' }}</td>
                            <td>
                                <form action="{{ route('importacion.items.destroy', $item->id_item) }}" method="POST" class="d-inline">
                                    @csrf @method('DELETE')
                                    <button class="btn btn-sm btn-outline-danger" onclick="return confirm('¿Eliminar partida?')">🗑️</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="9" class="text-center text-muted">Sin partidas</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    {{-- Documentos --}}
    <div class="card shadow-sm mt-3">
        <div class="card-header fw-bold">📎 Documentos ({{ $importacion->documentos->count() }})</div>
        <div class="card-body">
            <form action="{{ route('importacion.documentos.store', $importacion->id_importacion) }}"
                  method="POST" enctype="multipart/form-data" class="mb-3">
                @csrf
                <div class="row g-2 align-items-end">
                    <div class="col-md-4">
                        <select name="tipo_documento" class="form-select form-select-sm">
                            @foreach(['Factura','Pedimento','BL','Packing List','Certificado de Origen','Otro'] as $t)
                                <option>{{ $t }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-6"><input type="file" name="archivo" class="form-control form-control-sm" required></div>
                    <div class="col-md-2"><button class="btn btn-primary btn-sm w-100">📤 Subir</button></div>
                </div>
            </form>

            <table class="table table-sm">
                <thead class="table-light">
                    <tr><th>Tipo</th><th>Archivo</th><th>Subió</th><th>Validado</th><th>Acciones</th></tr>
                </thead>
                <tbody>
                    @forelse($importacion->documentos ?? [] as $doc)
                        <tr>
                            <td>{{ $doc->tipo_documento }}</td>
                            <td><a href="{{ asset('storage/' . $doc->ruta_archivo) }}" target="_blank">Ver</a></td>
                            <td>{{ $doc->fecha_subida?->format('d/m/Y') ?? '—' }}</td>
                            <td>
                                @if($doc->validado)
                                    <span class="badge bg-success">Validado</span>
                                @else
                                    <form action="{{ route('documentos.validar', $doc->id_documento) }}" method="POST" class="d-inline">
                                        @csrf
                                        <button class="btn btn-sm btn-outline-success">Validar</button>
                                    </form>
                                @endif
                            </td>
                            <td>
                                <form action="{{ route('documentos.destroy', $doc->id_documento) }}" method="POST" class="d-inline">
                                    @csrf @method('DELETE')
                                    <button class="btn btn-sm btn-outline-danger" onclick="return confirm('¿Eliminar?')">🗑️</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="5" class="text-center text-muted">Sin documentos</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    {{-- Pagos --}}
    <div class="card shadow-sm mt-3">
        <div class="card-header fw-bold">💵 Pagos ({{ ($importacion->pagos ?? collect())->count() }})</div>
        <div class="card-body">
            <form action="{{ route('importacion.pagos.store', $importacion->id_importacion) }}" method="POST" class="mb-3">
                @csrf
                <div class="row g-2 align-items-end">
                    <div class="col-md-2"><input type="date" name="fecha_pago" class="form-control form-control-sm" value="{{ date('Y-m-d') }}" required></div>
                    <div class="col-md-3">
                        <select name="metodo_pago" class="form-select form-select-sm">
                            @foreach(['SPEI','Transferencia','Cheque','Tarjeta','Efectivo'] as $m)
                                <option>{{ $m }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-2"><input type="number" name="monto" class="form-control form-control-sm" placeholder="Monto" step="0.01" min="0" required></div>
                    <div class="col-md-1">
                        <select name="moneda" class="form-select form-select-sm">
                            <option>MXN</option><option>USD</option><option>EUR</option>
                        </select>
                    </div>
                    <div class="col-md-2"><input type="text" name="num_comprobante" class="form-control form-control-sm" placeholder="Comprobante"></div>
                    <div class="col-md-2"><button class="btn btn-success btn-sm w-100">➕ Pago</button></div>
                </div>
            </form>

            <table class="table table-sm mb-0">
                <thead class="table-light">
                    <tr><th>Fecha</th><th>Método</th><th>Comprobante</th><th>Monto</th><th>Moneda</th><th></th></tr>
                </thead>
                <tbody>
                    @forelse($importacion->pagos ?? [] as $pago)
                        <tr>
                            <td>{{ \Carbon\Carbon::parse($pago->fecha_pago)->format('d/m/Y') }}</td>
                            <td>{{ $pago->metodo_pago }}</td>
                            <td>{{ $pago->num_comprobante ?? '—' }}</td>
                            <td><strong>${{ number_format($pago->monto, 2) }}</strong></td>
                            <td>{{ $pago->moneda }}</td>
                            <td>
                                <form action="{{ route('importacion.pagos.destroy', $pago->id_pago) }}" method="POST" class="d-inline">
                                    @csrf @method('DELETE')
                                    <button class="btn btn-sm btn-outline-danger" onclick="return confirm('¿Eliminar pago?')">🗑️</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="6" class="text-center text-muted">Sin pagos</td></tr>
                    @endforelse
                </tbody>
                @if(($importacion->pagos ?? collect())->count() > 0)
                    <tfoot class="table-light">
                        <tr>
                            <th colspan="3" class="text-end">Total pagado:</th>
                            <th>${{ number_format($importacion->pagos->sum('monto'), 2) }}</th>
                            <th colspan="2"></th>
                        </tr>
                    </tfoot>
                @endif
            </table>
        </div>
    </div>

    {{-- Costos --}}
    <div class="card shadow-sm mt-3">
        <div class="card-header fw-bold">💰 Costos Adicionales ({{ ($importacion->costos ?? collect())->count() }})</div>
        <div class="card-body">
            <form action="{{ route('importacion.costos.store', $importacion->id_importacion) }}" method="POST" class="mb-3">
                @csrf
                <div class="row g-2 align-items-end">
                    <div class="col-md-3"><input type="text" name="concepto" class="form-control form-control-sm" placeholder="Concepto (ej: Flete marítimo)" required></div>
                    <div class="col-md-2"><input type="number" name="monto" class="form-control form-control-sm" placeholder="Monto" step="0.01" min="0" required></div>
                    <div class="col-md-1">
                        <select name="moneda" class="form-select form-select-sm">
                            <option>MXN</option><option>USD</option><option>EUR</option>
                        </select>
                    </div>
                    <div class="col-md-4"><input type="text" name="descripcion" class="form-control form-control-sm" placeholder="Descripción (opcional)"></div>
                    <div class="col-md-2"><button class="btn btn-success btn-sm w-100">➕ Costo</button></div>
                </div>
            </form>

            <table class="table table-sm mb-0">
                <thead class="table-light">
                    <tr><th>Concepto</th><th>Descripción</th><th>Monto</th><th>Moneda</th><th></th></tr>
                </thead>
                <tbody>
                    @forelse($importacion->costos ?? [] as $costo)
                        <tr>
                            <td><strong>{{ $costo->concepto }}</strong></td>
                            <td>{{ $costo->descripcion ?? '—' }}</td>
                            <td>${{ number_format($costo->monto, 2) }}</td>
                            <td>{{ $costo->moneda }}</td>
                            <td>
                                <form action="{{ route('importacion.costos.destroy', $costo->id_costo) }}" method="POST" class="d-inline">
                                    @csrf @method('DELETE')
                                    <button class="btn btn-sm btn-outline-danger" onclick="return confirm('¿Eliminar costo?')">🗑️</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="5" class="text-center text-muted">Sin costos adicionales</td></tr>
                    @endforelse
                </tbody>
                @if(($importacion->costos ?? collect())->count() > 0)
                    <tfoot class="table-light">
                        <tr>
                            <th colspan="2" class="text-end">Total costos:</th>
                            <th>${{ number_format($importacion->costos->sum('monto'), 2) }}</th>
                            <th colspan="2"></th>
                        </tr>
                    </tfoot>
                @endif
            </table>
        </div>
    </div>

</div>
@endsection