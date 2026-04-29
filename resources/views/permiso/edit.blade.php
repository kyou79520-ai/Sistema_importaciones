@extends('layouts.app')
@section('content')
<div class="container py-3" style="max-width:600px">
    <h2>✏️ Editar Permiso</h2>
    @if($errors->any())<div class="alert alert-danger"><ul class="mb-0">@foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul></div>@endif
    <div class="card shadow-sm"><div class="card-body">
        <form action="{{ route('permiso.update', $permiso->id_permiso) }}" method="POST">
            @csrf @method('PUT')
            <div class="mb-3">
                <label class="form-label fw-bold">Nombre *</label>
                <input type="text" name="nombre" class="form-control"
                       value="{{ old('nombre', $permiso->nombre) }}" required>
            </div>
            <div class="mb-3">
                <label class="form-label fw-bold">Módulo *</label>
                <input type="text" name="modulo" class="form-control"
                       value="{{ old('modulo', $permiso->modulo) }}" required>
            </div>
            <div class="mb-3">
                <label class="form-label fw-bold">Descripción</label>
                <input type="text" name="descripcion" class="form-control"
                       value="{{ old('descripcion', $permiso->descripcion) }}">
            </div>
            <button type="submit" class="btn btn-warning">💾 Actualizar</button>
            <a href="{{ route('permiso.index') }}" class="btn btn-outline-secondary">Cancelar</a>
        </form>
    </div></div>
</div>
@endsection
