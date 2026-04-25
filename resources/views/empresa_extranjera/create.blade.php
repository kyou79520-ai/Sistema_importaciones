@extends('layouts.app')
@section('content')
<div class="container py-3" style="max-width:600px">
    <h2>➕ Nueva Empresa Extranjera</h2>
    <div class="card shadow-sm">
        <div class="card-body">
            <form action="{{ route('empresa-extranjera.store') }}" method="POST">
                @csrf
                @include('empresa_extranjera.form', ['empresa' => null])
                <button type="submit" class="btn btn-success mt-3">💾 Guardar</button>
                <a href="{{ route('empresa-extranjera.index') }}" class="btn btn-outline-secondary mt-3">Cancelar</a>
            </form>
        </div>
    </div>
</div>
@endsection
 
{{-- resources/views/empresa_extranjera/edit.blade.php --}}
@extends('layouts.app')
@section('content')
<div class="container py-3" style="max-width:600px">
    <h2>✏️ Editar Empresa Extranjera</h2>
    <div class="card shadow-sm">
        <div class="card-body">
            <form action="{{ route('empresa-extranjera.update', $empresa->id_empresa) }}" method="POST">
                @csrf @method('PUT')
                @include('empresa_extranjera.form', ['empresa' => $empresa])
                <button type="submit" class="btn btn-warning mt-3">💾 Actualizar</button>
            </form>
        </div>
    </div>
</div>
@endsection
 
{{-- resources/views/empresa_extranjera/form.blade.php --}}
<div class="mb-3"><label class="form-label fw-bold">Nombre *</label><input type="text" name="nombre_empresa" class="form-control" value="{{ old('nombre_empresa', $empresa->nombre_empresa ?? '') }}" required></div>
<div class="mb-3"><label class="form-label fw-bold">País de Origen *</label><input type="text" name="pais_origen" class="form-control" value="{{ old('pais_origen', $empresa->pais_origen ?? '') }}" required></div>
<div class="mb-3"><label class="form-label fw-bold">Contacto</label><input type="text" name="contacto" class="form-control" value="{{ old('contacto', $empresa->contacto ?? '') }}"></div>
<div class="mb-3"><label class="form-label fw-bold">Moneda Default</label><input type="text" name="moneda_default" class="form-control" maxlength="10" value="{{ old('moneda_default', $empresa->moneda_default ?? 'USD') }}"></div>
<div class="mb-3"><label class="form-label fw-bold">Tax ID / EIN</label><input type="text" name="num_tax_id" class="form-control" value="{{ old('num_tax_id', $empresa->num_tax_id ?? '') }}"></div>