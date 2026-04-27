@if($errors->any())
    <div class="alert alert-danger">
        <ul class="mb-0">@foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul>
    </div>
@endif

<div class="mb-3">
    <label class="form-label fw-bold">Nombre *</label>
    <input type="text" name="nombre_empresa" class="form-control"
           value="{{ old('nombre_empresa', $empresa->nombre_empresa ?? '') }}" required>
</div>
<div class="mb-3">
    <label class="form-label fw-bold">País de Origen *</label>
    <input type="text" name="pais_origen" class="form-control"
           value="{{ old('pais_origen', $empresa->pais_origen ?? '') }}" required>
</div>
<div class="mb-3">
    <label class="form-label fw-bold">Contacto</label>
    <input type="text" name="contacto" class="form-control"
           value="{{ old('contacto', $empresa->contacto ?? '') }}">
</div>
<div class="mb-3">
    <label class="form-label fw-bold">Moneda Default</label>
    <input type="text" name="moneda_default" class="form-control" maxlength="10"
           value="{{ old('moneda_default', $empresa->moneda_default ?? 'USD') }}">
</div>
<div class="mb-3">
    <label class="form-label fw-bold">Tax ID / EIN</label>
    <input type="text" name="num_tax_id" class="form-control"
           value="{{ old('num_tax_id', $empresa->num_tax_id ?? '') }}">
</div>