{{-- Parcial compartido por usuario.create y usuario.edit --}}
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
    <div class="col-md-6">
        <label class="form-label fw-bold">RFC</label>
        <input type="text" name="RFC" class="form-control" maxlength="13"
               value="{{ old('RFC', $usuario->RFC ?? '') }}">
    </div>
    <div class="col-md-6 d-flex align-items-end">
        <div class="form-check">
            <input type="hidden" name="activo" value="0">
            <input type="checkbox" name="activo" value="1" id="activo" class="form-check-input"
                   {{ old('activo', $usuario->activo ?? true) ? 'checked' : '' }}>
            <label class="form-check-label" for="activo">Usuario activo</label>
        </div>
    </div>

    @isset($roles)
    <div class="col-12">
        <label class="form-label fw-bold">Roles</label>
        <div class="border rounded p-2">
            @foreach($roles as $rol)
                @php
                    $sel = isset($rolesSeleccionados) && in_array($rol->id_rol, $rolesSeleccionados);
                @endphp
                <div class="form-check form-check-inline">
                    <input type="checkbox" name="roles[]" value="{{ $rol->id_rol }}"
                           id="rol-{{ $rol->id_rol }}" class="form-check-input"
                           {{ $sel ? 'checked' : '' }}>
                    <label class="form-check-label" for="rol-{{ $rol->id_rol }}">
                        {{ $rol->nombre }}
                    </label>
                </div>
            @endforeach
        </div>
    </div>
    @endisset
</div>
