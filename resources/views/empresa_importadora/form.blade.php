@if($errors->any())
    <div class="alert alert-danger">
        <ul class="mb-0">@foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul>
    </div>
@endif

<div class="mb-3">
    <label class="form-label fw-bold">Razón Social *</label>
    <input type="text" name="razon_social" class="form-control"
           value="{{ old('razon_social', $empresa->razon_social ?? '') }}" required>
</div>
<div class="mb-3">
    <label class="form-label fw-bold">RFC *</label>
    <input type="text" name="RFC_empresa" class="form-control" maxlength="13"
           value="{{ old('RFC_empresa', $empresa->RFC_empresa ?? '') }}" required>
</div>
<div class="mb-3">
    <label class="form-label fw-bold">Padrón de Importadores</label>
    <div class="form-check">
        <input class="form-check-input" type="checkbox" name="padron_importadores" value="1"
               @checked(old('padron_importadores', $empresa->padron_importadores ?? false))>
        <label class="form-check-label">Sí, está en el padrón</label>
    </div>
</div>
<div class="mb-3">
    <label class="form-label fw-bold">Giro Comercial</label>
    <input type="text" name="giro_comercial" class="form-control"
           value="{{ old('giro_comercial', $empresa->giro_comercial ?? '') }}">
</div>