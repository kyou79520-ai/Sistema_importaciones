<div class="mb-3">
    <label class="form-label fw-bold">Nombre del Rol *</label>
    <input type="text" name="nombre" class="form-control"
           value="{{ old('nombre', $rol->nombre ?? '') }}" required>
</div>
<div class="mb-3">
    <label class="form-label fw-bold">Descripción</label>
    <textarea name="descripcion" class="form-control" rows="2">{{ old('descripcion', $rol->descripcion ?? '') }}</textarea>
</div>
<div class="mb-3">
    <label class="form-label fw-bold">Permisos</label>
    @foreach($permisos as $modulo => $listaPermisos)
        <div class="mb-2">
            <div class="text-muted fw-bold small text-uppercase">{{ $modulo }}</div>
            <div class="row">
                @foreach($listaPermisos as $permiso)
                <div class="col-md-4">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox"
                               name="permisos[]" value="{{ $permiso->id_permiso }}"
                               @if(in_array($permiso->id_permiso, old('permisos', $permisosSeleccionados ?? []))) checked @endif>
                        <label class="form-check-label small">{{ $permiso->nombre }}</label>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    @endforeach
</div>