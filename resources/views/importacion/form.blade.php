<div class="row g-3 mb-3">
    <div class="col-md-4">
        <label class="form-label fw-bold">Número de Importación *</label>
        <input type="text" name="numero_importacion" class="form-control"
               value="{{ old('numero_importacion', $importacion->numero_importacion ?? '') }}" required>
    </div>
    <div class="col-md-4">
        <label class="form-label fw-bold">País de Origen *</label>
        <input type="text" name="pais_origen" class="form-control"
               value="{{ old('pais_origen', $importacion->pais_origen ?? '') }}" required>
    </div>
    <div class="col-md-4">
        <label class="form-label fw-bold">Fecha de Arribo</label>
        <input type="date" name="fecha_arribo" class="form-control"
               value="{{ old('fecha_arribo', isset($importacion) && $importacion->fecha_arribo ? $importacion->fecha_arribo->format('Y-m-d') : '') }}">
    </div>

    <div class="col-md-6">
        <label class="form-label fw-bold">Empresa Importadora (MX)</label>
        <select name="id_empresa_mx" class="form-select">
            <option value="">— Seleccionar —</option>
            @foreach($empresasImportadoras as $emp)
                <option value="{{ $emp->id_empresa_mx }}"
                    {{ old('id_empresa_mx', $importacion->id_empresa_mx ?? '') == $emp->id_empresa_mx ? 'selected' : '' }}>
                    {{ $emp->razon_social }} ({{ $emp->RFC_empresa }})
                </option>
            @endforeach
        </select>
    </div>

    <div class="col-md-6">
        <label class="form-label fw-bold">Empresa Extranjera</label>
        <select name="id_empresa_extranjera" class="form-select">
            <option value="">— Seleccionar —</option>
            @foreach($empresasExtranjeras as $emp)
                <option value="{{ $emp->id_empresa }}"
                    {{ old('id_empresa_extranjera', $importacion->id_empresa_extranjera ?? '') == $emp->id_empresa ? 'selected' : '' }}>
                    {{ $emp->nombre_empresa }} ({{ $emp->pais_origen }})
                </option>
            @endforeach
        </select>
    </div>

    <div class="col-md-12">
        <label class="form-label fw-bold">Proveedor (opcional, si no está en catálogo)</label>
        <input type="text" name="proveedor" class="form-control"
               value="{{ old('proveedor', $importacion->proveedor ?? '') }}">
    </div>

    <div class="col-md-12">
        <label class="form-label fw-bold">Agentes Aduanales</label>
        <div class="border rounded p-2">
            @forelse($agentes as $ag)
                @php
                    $sel = isset($agentesSeleccionados) && in_array($ag->id_agente, $agentesSeleccionados);
                @endphp
                <div class="form-check">
                    <input type="checkbox" name="agentes[]" value="{{ $ag->id_agente }}"
                           id="ag-{{ $ag->id_agente }}" class="form-check-input"
                           {{ $sel ? 'checked' : '' }}>
                    <label class="form-check-label" for="ag-{{ $ag->id_agente }}">
                        <strong>{{ $ag->nombre_agente }}</strong>
                        <small class="text-muted">— Patente {{ $ag->num_patente }}, Aduana {{ $ag->aduana_adscrita }}</small>
                    </label>
                </div>
            @empty
                <p class="text-muted small mb-0">No hay agentes registrados.
                    <a href="{{ route('agente-aduanal.create') }}">Registrar uno</a>.
                </p>
            @endforelse
        </div>
    </div>

    <div class="col-md-12">
        <label class="form-label fw-bold">Notas</label>
        <textarea name="notas" class="form-control" rows="3">{{ old('notas', $importacion->notas ?? '') }}</textarea>
    </div>
</div>
