<div class="row g-3 mb-3">
    <div class="col-md-12">
        <label class="form-label fw-bold">Nombre del Agente *</label>
        <input type="text" name="nombre_agente" class="form-control"
               value="{{ old('nombre_agente', $agente->nombre_agente ?? '') }}" required>
    </div>
    <div class="col-md-4">
        <label class="form-label fw-bold">Número de Patente *</label>
        <input type="text" name="num_patente" class="form-control"
               value="{{ old('num_patente', $agente->num_patente ?? '') }}" required>
    </div>
    <div class="col-md-8">
        <label class="form-label fw-bold">Aduana Adscrita *</label>
        <input type="text" name="aduana_adscrita" class="form-control"
               value="{{ old('aduana_adscrita', $agente->aduana_adscrita ?? '') }}" required>
    </div>
    <div class="col-md-6">
        <label class="form-label fw-bold">Teléfono</label>
        <input type="text" name="telefono" class="form-control"
               value="{{ old('telefono', $agente->telefono ?? '') }}">
    </div>
    <div class="col-md-6">
        <label class="form-label fw-bold">RFC</label>
        <input type="text" name="RFC_agente" class="form-control" maxlength="13"
               value="{{ old('RFC_agente', $agente->RFC_agente ?? '') }}">
    </div>
</div>
