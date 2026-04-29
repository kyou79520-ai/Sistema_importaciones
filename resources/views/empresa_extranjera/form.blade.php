<div class="row g-3 mb-3">
    <div class="col-md-12">
        <label class="form-label fw-bold">Nombre de la Empresa *</label>
        <input type="text" name="nombre_empresa" class="form-control"
               value="{{ old('nombre_empresa', $empresa->nombre_empresa ?? '') }}" required>
    </div>
    <div class="col-md-6">
        <label class="form-label fw-bold">País de Origen *</label>
        <input type="text" name="pais_origen" class="form-control"
               value="{{ old('pais_origen', $empresa->pais_origen ?? '') }}" required>
    </div>
    <div class="col-md-3">
        <label class="form-label fw-bold">Moneda Default</label>
        <input type="text" name="moneda_default" class="form-control" maxlength="10"
               value="{{ old('moneda_default', $empresa->moneda_default ?? 'USD') }}">
    </div>
    <div class="col-md-3">
        <label class="form-label fw-bold">Tax ID</label>
        <input type="text" name="num_tax_id" class="form-control"
               value="{{ old('num_tax_id', $empresa->num_tax_id ?? '') }}">
    </div>
</div>
