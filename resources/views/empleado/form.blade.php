@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="mb-3">
    <label for="Nombre">Nombre</label>
    <input type="text" name="Nombre" value="{{ old('Nombre', $empleado->Nombre ?? '') }}"
        id="Nombre" class="form-control">
</div>

<div class="mb-3">
    <label for="ApellidoPaterno">Apellido Paterno</label>
    <input type="text" name="ApellidoPaterno" value="{{ old('ApellidoPaterno', $empleado->ApellidoPaterno ?? '') }}"
        id="ApellidoPaterno" class="form-control">
</div>

<div class="mb-3">
    <label for="ApellidoMaterno">Apellido Materno</label>
    <input type="text" name="ApellidoMaterno" value="{{ old('ApellidoMaterno', $empleado->ApellidoMaterno ?? '') }}"
        id="ApellidoMaterno" class="form-control">
</div>

<div class="mb-3">
    <label for="correo">Correo</label>
    <input type="text" name="correo" value="{{ old('correo', $empleado->correo ?? '') }}"
        id="correo" class="form-control">
</div>

<div class="mb-3">
    <label for="Foto">Foto</label><br>
    @if (!empty($empleado->Foto))
        <img src="{{ asset('storage/' . $empleado->Foto) }}" width="100" class="mb-2 d-block">
    @endif
    <input type="file" name="Foto" id="Foto" class="form-control">
</div>

<button type="submit" class="btn btn-primary">Guardar datos</button>