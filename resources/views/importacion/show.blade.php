@extends('layouts.app')
@section('content')
<div class="container-fluid py-3">
    @if(session('mensaje'))
        <div class="alert alert-success alert-dismissible fade show">{{ session('mensaje') }}<button type="button" class="btn-close" data-bs-dismiss="alert"></button></div>
    @endif
 
    {{-- Encabezado --}}
    <div class="d-flex justify-content-between align-items-start mb-3">
        <div>
            <h2>📦 Importación: <strong>{{ $importacion->numero_importacion }}</strong></h2>
            <span class="badge bg-{{ $importacion->estado_color }} fs-6">{{ $importacion->estado_label }}</span>
        </div>
        <div class="d-flex gap-2">
            {{-- Cambiar estado --}}
            <form action="{{ route('importacion.estado', $importacion->id_importacion) }}" method="POST" class="d-flex gap-1">
                @csrf
                <select name="estado" class="form-select form-select-sm">
                    @foreach(['borrador','en_tramite','en_aduana','liberada','entregada','cancelada'] as $e)
                        <option value="{{ $e }}" @selected($importacion->estado == $e)>{{ ucfirst(str_replace('_',' ',$e)) }}</option>
                    @endforeach
                </select>
                <button type="submit" class="btn btn-sm btn-outline-primary">Cambiar Estado</button>
            </form>
            <a href="{{ route('importacion.edit', $importacion->id_importacion) }}" class="btn btn-warning btn-sm">✏️ Editar</a>
            <a href="{{ route('importacion.index') }}" class="btn btn-outline-secondary btn-sm">← Volver</a>
        </div>
    </div>
 
    <div class="row g-3">
        {{-- Info general --}}
        <div class="col-md-6">
            <div class="card shadow-sm h-100">
                <div class="card-header fw-bold">Información General</div>
                <div class="card-body">
                    <table class="table table-sm mb-0">
                        <tr><th>País Origen</th><td>{{ $importacion->pais_origen }}</td></tr>
                        <tr><th>Proveedor</th><td>{{ $importacion->proveedor ?? '—' }}</td></tr>
                        <tr><th>Empresa Extranjera</th><td>{{ $importacion->empresaExtranjera?->nombre_empresa ?? '—' }}</td></tr>
                        <tr><th>Empresa Importadora</th><td>{{ $importacion->empresaImportadora?->razon_social ?? '—' }}</td></tr>
                        <tr><th>Fecha Arribo</th><td>{{ $importacion->fecha_arribo?->format('d/m/Y') ?? '—' }}</td></tr>
                        <tr><th>Creado por</th><td>{{ $importacion->usuario?->nombre_completo ?? '—' }}</td></tr>
                        <tr><th>Total CIF</th><td><strong>${{ number_format($importacion->total_cif,2) }}</strong></td></tr>
                        <tr><th>Total Impuestos</th><td>${{ number_format($importacion->total_impuestos,2) }}</td></tr>
                        <tr><th>Total Aduanales</th><td>${{ number_format($importacion->total_aduanales,2) }}</td></tr>
                    </table>
                </div>
            </div>
        </div>
 
        {{-- Agentes --}}
        <div class="col-md-6">
            <div class="card shadow-sm h-100">
                <div class="card-header fw-bold">Agentes Aduanales</div>
                <div class="card-body">
                    @forelse($importacion->agentes as $ag)
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
 
    {{-- Partidas / Items --}}
    <div class="card shadow-sm mt-3">
        <div class="card-header fw-bold d-flex justify-content-between">
            <span>📋 Partidas de la Importación ({{ $importacion->items->count() }})</span>
        </div>
        <div class="card-body">
            {{-- Formulario agregar item --}}
            <form action="{{ route('importacion.items.store', $importacion->id_importacion) }}" method="POST">
                @csrf
                <div class="row g-2 mb-3 align-items-end">
                    <div class="col-md-3"><input type="text" name="descripcion" class="form-control form-control-sm" placeholder="Descripción *" required></div>
                    <div class="col-md-1"><input type="number" name="cantidad" class="form-control form-control-sm" placeholder="Cantidad" step="0.0001" min="0" required></div>
                    <div class="col-md-2">
                        <select name="unidad_medida" class="form-select form-select-sm">
                            @foreach(['PZA','KG','LT','MT','M2','M3','JUEGO','PAR','CAJA','ROLLO'] as $u)
                                <option>{{ $u }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-2"><input type="number" name="valor_unitario" class="form-control form-control-sm" placeholder="Valor unitario USD" step="0.0001" min="0" required></div>
                    <div class="col-md-1"><input type="number" name="peso_kg" class="form-control form-control-sm" placeholder="Peso Kg" step="0.001"></div>
                    <div class="col-md-1"><input type="text" name="codigo_hs" class="form-control form-control-sm" placeholder="Cód. HS"></div>
                    <div class="col-md-2"><button type="submit" class="btn btn-success btn-sm w-100">➕ Agregar</button></div>
                </div>
            </form>
            <div class="table-responsive">
                <table class="table table-bordered table-sm mb-0">
                    <thead class="table-light"><tr><th>#</th><th>Descripción</th><th>Cantidad</th><th>U/M</th><th>V. Unitario</th><th>V. Total</th><th>Peso Kg</th><th>Cód. HS</th><th></th></tr></thead>
                    <tbody>
                        @forelse($importacion->items->sortBy('numero_linea') as $item)
                        <tr>
                            <td>{{ $item->numero_linea }}</td>
                            <td>{{ $item->descripcion }}</td>
                            <td>{{ number_format($item->cantidad,4) }}</td>
                            <td>{{ $item->unidad_medida }}</td>
                            <td>${{ number_format($item->valor_unitario,4) }}</td>
                            <td><strong>${{ number_format($item->valor_total,2) }}</strong></td>
                            <td>{{ $item->peso_kg ? number_format($item->peso_kg,3).' kg' : '—' }}</td>
                            <td>{{ $item->codigo_hs ?? '—' }}</td>
                            <td>
                                <form action="{{ route('importacion.items.destroy', $item->id_item) }}" method="POST">
                                    @csrf @method('DELETE')
                                    <button class="btn btn-danger btn-sm" onclick="return confirm('¿Eliminar partida?')">🗑</button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr><td colspan="9" class="text-center text-muted">Sin partidas registradas</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
 
    <div class="row g-3 mt-1">
        {{-- Impuestos --}}
        <div class="col-md-6">
            <div class="card shadow-sm">
                <div class="card-header fw-bold">🧾 Impuestos</div>
                <div class="card-body">
                    <form action="{{ route('importacion.impuestos.store', $importacion->id_importacion) }}" method="POST" class="row g-2 mb-3">
                        @csrf
                        <div class="col-md-3">
                            <select name="tipo_impuesto" class="form-select form-select-sm" required>
                                @foreach(['IGI','IVA','DTA','PRV','IEPS','otro'] as $t)
                                    <option>{{ $t }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-3"><input type="number" name="base_imponible" class="form-control form-control-sm" placeholder="Base imponible" step="0.01" required></div>
                        <div class="col-md-3"><input type="number" name="tasa_porcentaje" class="form-control form-control-sm" placeholder="Tasa %" step="0.01" required></div>
                        <div class="col-md-3"><button class="btn btn-success btn-sm w-100">➕</button></div>
                    </form>
                    <table class="table table-sm mb-0">
                        <thead class="table-light"><tr><th>Tipo</th><th>Base</th><th>Tasa</th><th>Monto</th><th></th></tr></thead>
                        <tbody>
                            @forelse($importacion->impuestos as $imp)
                            <tr>
                                <td>{{ $imp->tipo_impuesto }}</td>
                                <td>${{ number_format($imp->base_imponible,2) }}</td>
                                <td>{{ number_format($imp->tasa_porcentaje*100,2) }}%</td>
                                <td><strong>${{ number_format($imp->monto,2) }}</strong></td>
                                <td>
                                    <form action="{{ route('impuestos.destroy', $imp->id_impuesto) }}" method="POST">
                                        @csrf @method('DELETE')
                                        <button class="btn btn-danger btn-sm">🗑</button>
                                    </form>
                                </td>
                            </tr>
                            @empty<tr><td colspan="5" class="text-center text-muted">Sin impuestos</td></tr>@endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
 
        {{-- Pagos --}}
        <div class="col-md-6">
            <div class="card shadow-sm">
                <div class="card-header fw-bold">💰 Pagos</div>
                <div class="card-body">
                    <form action="{{ route('importacion.pagos.store', $importacion->id_importacion) }}" method="POST" class="row g-2 mb-3">
                        @csrf
                        <div class="col-md-3"><input type="number" name="monto" class="form-control form-control-sm" placeholder="Monto" step="0.01" required></div>
                        <div class="col-md-3"><input type="date" name="fecha_pago" class="form-control form-control-sm" required></div>
                        <div class="col-md-3">
                            <select name="metodo_pago" class="form-select form-select-sm">
                                @foreach(['Transferencia','Cheque','Efectivo','Carta de crédito','Otro'] as $m)
                                    <option>{{ $m }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-3"><button class="btn btn-success btn-sm w-100">➕ Pago</button></div>
                    </form>
                    <table class="table table-sm mb-0">
                        <thead class="table-light"><tr><th>Fecha</th><th>Método</th><th>Monto</th><th>Moneda</th></tr></thead>
                        <tbody>
                            @forelse($importacion->pagos as $pago)
                            <tr>
                                <td>{{ $pago->fecha_pago->format('d/m/Y') }}</td>
                                <td>{{ $pago->metodo_pago }}</td>
                                <td><strong>${{ number_format($pago->monto,2) }}</strong></td>
                                <td>{{ $pago->moneda }}</td>
                            </tr>
                            @empty<tr><td colspan="4" class="text-center text-muted">Sin pagos</td></tr>@endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
 {{-- Costos --}}
<div class="card shadow-sm mt-3">
    <div class="card-header fw-bold">🧮 Costos de Importación</div>
    <div class="card-body">
        <form action="{{ route('importacion.costos.store', $importacion->id_importacion) }}" method="POST" class="row g-2 mb-3">
            @csrf
            <div class="col-md-2">
                <select name="tipo_costo" class="form-select form-select-sm" required>
                    @foreach(['flete','seguro','gastos_aduanales','honorarios','almacenaje','otro'] as $t)
                        <option>{{ $t }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-2"><input type="number" name="seguro" class="form-control form-control-sm" placeholder="Seguro" step="0.01"></div>
            <div class="col-md-2"><input type="number" name="gastos_aduanales" class="form-control form-control-sm" placeholder="Gtos. Aduanales" step="0.01"></div>
            <div class="col-md-2"><input type="number" name="otros_gastos" class="form-control form-control-sm" placeholder="Otros" step="0.01"></div>
            <div class="col-md-2"><input type="text" name="moneda" class="form-control form-control-sm" value="MXN" maxlength="10"></div>
            <div class="col-md-2"><button class="btn btn-success btn-sm w-100">➕</button></div>
        </form>
        <table class="table table-sm mb-0">
            <thead class="table-light"><tr><th>Tipo</th><th>Seguro</th><th>Aduanales</th><th>Otros</th><th>Total</th><th>Moneda</th><th></th></tr></thead>
            <tbody>
                @forelse($importacion->costos as $costo)
                <tr>
                    <td>{{ $costo->tipo_costo }}</td>
                    <td>${{ number_format($costo->seguro,2) }}</td>
                    <td>${{ number_format($costo->gastos_aduanales,2) }}</td>
                    <td>${{ number_format($costo->otros_gastos,2) }}</td>
                    <td><strong>${{ number_format($costo->total_costos,2) }}</strong></td>
                    <td>{{ $costo->moneda }}</td>
                    <td>
                        <form action="{{ route('importacion.costos.destroy', $costo->id_costo) }}" method="POST">
                            @csrf @method('DELETE')
                            <button class="btn btn-danger btn-sm">🗑</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr><td colspan="7" class="text-center text-muted">Sin costos registrados</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

    {{-- Documentos --}}
    <div class="card shadow-sm mt-3">
        <div class="card-header fw-bold">📎 Documentos</div>
        <div class="card-body">
            <form action="{{ route('importacion.documentos.store', $importacion->id_importacion) }}" method="POST" enctype="multipart/form-data" class="row g-2 mb-3">
                @csrf
                <div class="col-md-3">
                    <select name="tipo_documento" class="form-select form-select-sm" required>
                        @foreach(['factura','pedimento','BL','packing_list','certificado_origen','otro'] as $t)
                            <option>{{ $t }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-5"><input type="file" name="archivo" class="form-control form-control-sm" required></div>
                <div class="col-md-2"><button class="btn btn-success btn-sm w-100">📤 Subir</button></div>
            </form>
            <div class="row g-2">
                @forelse($importacion->documentos as $doc)
                <div class="col-md-3">
                    <div class="card border {{ $doc->validado ? 'border-success' : 'border-warning' }}">
                        <div class="card-body p-2">
                            <div class="fw-bold small">{{ strtoupper($doc->tipo_documento) }}</div>
                            <div class="text-muted small">{{ $doc->created_at->format('d/m/Y') }}</div>
                            @if($doc->validado)
                                <span class="badge bg-success">✔ Validado</span>
                            @else
                                <span class="badge bg-warning text-dark">Pendiente</span>
                            @endif
                            <div class="mt-2 d-flex gap-1">
                                <a href="{{ asset('storage/'.$doc->ruta_archivo) }}" target="_blank" class="btn btn-sm btn-outline-primary">Ver</a>
                                @if(!$doc->validado)
                                <form action="{{ route('documentos.validar', $doc->id_documento) }}" method="POST">
                                    @csrf <button class="btn btn-sm btn-success">✔</button>
                                </form>
                                @endif
                                <form action="{{ route('documentos.destroy', $doc->id_documento) }}" method="POST">
                                    @csrf @method('DELETE')
                                    <button class="btn btn-sm btn-danger" onclick="return confirm('¿Eliminar?')">🗑</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                @empty
                <div class="col-12 text-center text-muted">Sin documentos cargados</div>
                @endforelse
            </div>
        </div>
    </div>
</div>
@endsection