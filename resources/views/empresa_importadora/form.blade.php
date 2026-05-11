<div class="row g-3 mb-3">
    <div class="col-md-4">
        <label class="form-label fw-bold">RFC *</label>
        <input type="text" name="RFC_empresa" class="form-control" maxlength="13"
               value="{{ old('RFC_empresa', $empresa->RFC_empresa ?? '') }}" required>
    </div>
    <div class="col-md-8">
        <label class="form-label fw-bold">Razón Social *</label>
        <input type="text" name="razon_social" class="form-control"
               value="{{ old('razon_social', $empresa->razon_social ?? '') }}" required>
    </div>
    <div class="col-md-8">
        <label class="form-label fw-bold">Giro Comercial</label>
        <input type="text" name="giro_comercial" class="form-control"
               value="{{ old('giro_comercial', $empresa->giro_comercial ?? '') }}">
    </div>
    <div class="col-md-4 d-flex align-items-end">
        <div class="form-check">
            <input type="hidden" name="padron_importadores" value="0">
            <input type="checkbox" name="padron_importadores" value="1"
                   id="padron" class="form-check-input"
                   {{ old('padron_importadores', $empresa->padron_importadores ?? false) ? 'checked' : '' }}>
            <label class="form-check-label" for="padron">En padrón de importadores</label>
        </div>
    </div>
</div>
