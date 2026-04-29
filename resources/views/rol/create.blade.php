@extends('layouts.app')

@section('content')
<div class="container py-3" style="max-width:800px">
    <h2>➕ Nuevo Rol</h2>

    @if($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach
            </ul>
        </div>
    @endif

    <div class="card shadow-sm">
        <div class="card-body">
            <form action="{{ route('rol.store') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label class="form-label fw-bold">Nombre *</label>
                    <input type="text" name="nombre" class="form-control" value="{{ old('nombre') }}" required>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-bold">Descripción</label>
                    <textarea name="descripcion" class="form-control" rows="2">{{ old('descripcion') }}</textarea>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-bold">Permisos</label>
                    @forelse($permisos as $modulo => $listaPermisos)
                        <div class="card mb-2">
                            <div class="card-header bg-light fw-bold">{{ ucfirst($modulo) }}</div>
                            <div class="card-body py-2">
                                @foreach($listaPermisos as $permiso)
                                    <div class="form-check">
                                        <input type="checkbox" name="permisos[]" value="{{ $permiso->id_permiso }}"
                                               id="perm-{{ $permiso->id_permiso }}" class="form-check-input">
                                        <label class="form-check-label" for="perm-{{ $permiso->id_permiso }}">
                                            <strong>{{ $permiso->nombre }}</strong>
                                            @if($permiso->descripcion)
                                                — <small class="text-muted">{{ $permiso->descripcion }}</small>
                                            @endif
                                        </label>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @empty
                        <p class="text-muted">No hay permisos registrados.</p>
                    @endforelse
                </div>

                <button type="submit" class="btn btn-success">💾 Crear Rol</button>
                <a href="{{ route('rol.index') }}" class="btn btn-outline-secondary">Cancelar</a>
            </form>
        </div>
    </div>
</div>
@endsection
