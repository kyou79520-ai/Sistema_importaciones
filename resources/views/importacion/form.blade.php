<div class="row g-3">
    <div class="col-md-4">
        <label class="form-label fw-bold">Número de Importación *</label>
        <input type="text" name="numero_importacion" class="form-control @error('numero_importacion') is-invalid @enderror"
               value="{{ old('numero_importacion', $importacion->numero_importacion ?? '') }}" required>
        @error('numero_importacion')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>
    <div class="col-md-4">
        <label class="form-label fw-bold">País de Origen *</label>
        <input type="text" name="pais_origen" class="form-control"
               value="{{ old('pais_origen', $importacion->pais_origen ?? '') }}" required>
    </div>
    <div class="col-md-4">
        <label class="form-label fw-bold">Proveedor</label>
        <input type="text" name="proveedor" class="form-control"
               value="{{ old('proveedor', $importacion->proveedor ?? '') }}">
    </div>
    <div class="col-md-6">
        <label class="form-label fw-bold">Empresa Extranjera</label>
        <select name="id_empresa_extranjera" class="form-select">
            <option value="">-- Seleccionar --</option>
            @foreach($empresasExtranjeras as $ee)
                <option value="{{ $ee->id_empresa }}" @selected(old('id_empresa_extranjera', $importacion->id_empresa_extranjera ?? '') == $ee->id_empresa)>
                    {{ $ee->nombre_empresa }} ({{ $ee->pais_origen }})
                </option>
            @endforeach
        </select>
    </div>
    <div class="col-md-6">
        <label class="form-label fw-bold">Empresa Importadora (México)</label>
        <select name="id_empresa_mx" class="form-select">
            <option value="">-- Seleccionar --</option>
            @foreach($empresasImportadoras as $ei)
                <option value="{{ $ei->id_empresa_mx }}" @selected(old('id_empresa_mx', $importacion->id_empresa_mx ?? '') == $ei->id_empresa_mx)>
                    {{ $ei->razon_social }}
                </option>
            @endforeach
        </select>
    </div>
    <div class="col-md-4">
        <label class="form-label fw-bold">Fecha de Arribo</label>
        <input type="date" name="fecha_arribo" class="form-control"
               value="{{ old('fecha_arribo', isset($importacion->fecha_arribo) ? $importacion->fecha_arribo->format('Y-m-d') : '') }}">
    </div>
    <div class="col-md-8">
        <label class="form-label fw-bold">Agentes Aduanales</label>
        <select name="agentes[]" class="form-select" multiple>
            @foreach($agentes as $agente)
                <option value="{{ $agente->id_agente }}"
                    @if(in_array($agente->id_agente, old('agentes', $agentesSeleccionados ?? []))) selected @endif>
                    {{ $agente->nombre_agente }} - Patente: {{ $agente->num_patente }}
                </option>
            @endforeach
        </select>
        <small class="text-muted">Ctrl+Click para seleccionar varios</small>
    </div>
    <div class="col-md-12">
        <label class="form-label fw-bold">Notas</label>
        <textarea name="notas" class="form-control" rows="3">{{ old('notas', $importacion->notas ?? '') }}</textarea>
    </div>
</div>