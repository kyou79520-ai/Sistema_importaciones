<div class="row g-3">
    <div class="col-md-6">
        <label class="form-label fw-bold">Nombre de Usuario *</label>
        <input type="text" name="nombre_usuario" class="form-control"
               value="{{ old('nombre_usuario', $usuario->nombre_usuario ?? '') }}" required>
    </div>
    <div class="col-md-6">
        <label class="form-label fw-bold">Nombre Completo *</label>
        <input type="text" name="nombre_completo" class="form-control"
               value="{{ old('nombre_completo', $usuario->nombre_completo ?? '') }}" required>
    </div>
    <div class="col-md-6">
        <label class="form-label fw-bold">Email *</label>
        <input type="email" name="email" class="form-control"
               value="{{ old('email', $usuario->email ?? '') }}" required>
    </div>
    <div class="col-md-6">
        <label class="form-label fw-bold">Teléfono</label>
        <input type="text" name="telefono" class="form-control"
               value="{{ old('telefono', $usuario->telefono ?? '') }}">
    </div>
    <div class="col-md-4">
        <label class="form-label fw-bold">RFC</label>
        <input type="text" name="RFC" class="form-control" maxlength="13"
               value="{{ old('RFC', $usuario->RFC ?? '') }}">
    </div>
    <div class="col-md-4">
        <label class="form-label fw-bold">Roles</label>
        <select name="roles[]" class="form-select" multiple>
            @foreach($roles as $rol)
                <option value="{{ $rol->id_rol }}"
                    @if(in_array($rol->id_rol, old('roles', $rolesSeleccionados ?? []))) selected @endif>
                    {{ $rol->nombre }}
                </option>
            @endforeach
        </select>
        <small class="text-muted">Ctrl+Click para varios</small>
    </div>
    <div class="col-md-4 d-flex align-items-end">
        <div class="form-check mb-2">
            <input class="form-check-input" type="checkbox" name="activo" value="1"
                   @checked(old('activo', $usuario->activo ?? true))>
            <label class="form-check-label fw-bold">Usuario activo</label>
        </div>
    </div>
</div>