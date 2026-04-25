@extends('layouts.app')
@section('content')
<div class="container py-3">
    <div class="d-flex justify-content-between mb-3">
        <h2>🏢 Empresas Importadoras (México)</h2>
        <a href="{{ route('empresa-importadora.create') }}" class="btn btn-success">➕ Nueva</a>
    </div>
    @if(session('mensaje'))<div class="alert alert-success">{{ session('mensaje') }}</div>@endif
    <table class="table table-bordered table-hover">
        <thead class="table-dark"><tr><th>Razón Social</th><th>RFC</th><th>Padrón Importadores</th><th>Giro</th><th>Acciones</th></tr></thead>
        <tbody>
            @forelse($empresas as $e)
            <tr>
                <td>{{ $e->razon_social }}</td>
                <td>{{ $e->RFC_empresa }}</td>
                <td>@if($e->padron_importadores)<span class="badge bg-success">Sí</span>@else<span class="badge bg-secondary">No</span>@endif</td>
                <td>{{ $e->giro_comercial ?? '—' }}</td>
                <td>
                    <a href="{{ route('empresa-importadora.edit', $e->id_empresa_mx) }}" class="btn btn-sm btn-warning">Editar</a>
                    <form action="{{ route('empresa-importadora.destroy', $e->id_empresa_mx) }}" method="POST" class="d-inline">
                        @csrf @method('DELETE')
                        <button class="btn btn-sm btn-danger" onclick="return confirm('¿Eliminar?')">Borrar</button>
                    </form>
                </td>
            </tr>
            @empty<tr><td colspan="5" class="text-center text-muted">Sin empresas</td></tr>@endforelse
        </tbody>
    </table>
    {{ $empresas->links() }}
</div>
@endsection
 
{{-- resources/views/empresa_importadora/create.blade.php --}}
@extends('layouts.app')
@section('content')
<div class="container py-3" style="max-width:600px">
    <h2>➕ Nueva Empresa Importadora</h2>
    <div class="card shadow-sm"><div class="card-body">
        <form action="{{ route('empresa-importadora.store') }}" method="POST">
            @csrf
            @include('empresa_importadora.form', ['empresa' => null])
            <button type="submit" class="btn btn-success mt-3">💾 Guardar</button>
            <a href="{{ route('empresa-importadora.index') }}" class="btn btn-outline-secondary mt-3">Cancelar</a>
        </form>
    </div></div>
</div>
@endsection
 
{{-- resources/views/empresa_importadora/edit.blade.php --}}
@extends('layouts.app')
@section('content')
<div class="container py-3" style="max-width:600px">
    <h2>✏️ Editar Empresa Importadora</h2>
    <div class="card shadow-sm"><div class="card-body">
        <form action="{{ route('empresa-importadora.update', $empresa->id_empresa_mx) }}" method="POST">
            @csrf @method('PUT')
            @include('empresa_importadora.form', ['empresa' => $empresa])
            <button type="submit" class="btn btn-warning mt-3">💾 Actualizar</button>
        </form>
    </div></div>
</div>
@endsection
 
{{-- resources/views/empresa_importadora/form.blade.php --}}
<div class="mb-3"><label class="form-label fw-bold">Razón Social *</label><input type="text" name="razon_social" class="form-control" value="{{ old('razon_social', $empresa->razon_social ?? '') }}" required></div>
<div class="mb-3"><label class="form-label fw-bold">RFC *</label><input type="text" name="RFC_empresa" class="form-control" maxlength="13" value="{{ old('RFC_empresa', $empresa->RFC_empresa ?? '') }}" required></div>
<div class="mb-3"><label class="form-label fw-bold">Padrón de Importadores</label><div class="form-check"><input class="form-check-input" type="checkbox" name="padron_importadores" value="1" @checked(old('padron_importadores', $empresa->padron_importadores ?? false))><label class="form-check-label">Sí, está en el padrón</label></div></div>
<div class="mb-3"><label class="form-label fw-bold">Giro Comercial</label><input type="text" name="giro_comercial" class="form-control" value="{{ old('giro_comercial', $empresa->giro_comercial ?? '') }}"></div>