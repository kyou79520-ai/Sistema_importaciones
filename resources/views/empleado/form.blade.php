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
    <input type="text" name="Nombre" value="{{ $empleado->Nombre ?? '' }}">
<br>
</div>

<div class="mb-3">
    <label for="ApellidoPaterno">Apellido Paterno</label>
   <input type="text" name="ApellidoPaterno" value="{{ $empleado->ApellidoPaterno ?? '' }}">
<br>
</div>

<div class="mb-3">
    <label for="ApellidoMaterno">Apellido Materno</label>
   <input type="text" name="ApellidoMaterno" value="{{ $empleado->ApellidoMaterno ?? '' }}">
<br>
</div>

<div class="mb-3">
    <label for="correo">Correo</label>
<input type="email" name="correo" value="{{ $empleado->correo ?? '' }}">
<br>
</div>

<div class="mb-3">
    <label for="Foto">Foto</label><br>
   @if(!empty($empleado->Foto))
    <img src="{{ asset('storage/' . $empleado->Foto) }}" width="100">
    <br>
@endif
    <input type="file" name="Foto" id="Foto" class="form-control">
    <br>
</div>

<button type="submit" class="btn btn-primary">Guardar datos</button>