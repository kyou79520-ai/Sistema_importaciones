@extends('layouts.app')
@section('content')
<div class="container py-3" style="max-width:700px">
    <h2>✏️ Editar Usuario: {{ $usuario->nombre_usuario }}</h2>
    @if($errors->any())<div class="alert alert-danger"><ul>@foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul></div>@endif
    <div class="card shadow-sm"><div class="card-body">
        <form action="{{ route('usuario.update', $usuario->id_usuario) }}" method="POST">
            @csrf @method('PUT')
            @include('usuario.form')
            <hr>
            <p class="text-muted small">Deja en blanco para no cambiar la contraseña</p>
            <div class="row g-3">
                <div class="col-md-6">
                    <label class="form-label fw-bold">Nueva Contraseña</label>
                    <input type="password" name="password" class="form-control">
                </div>
                <div class="col-md-6">
                    <label class="form-label fw-bold">Confirmar Contraseña</label>
                    <input type="password" name="password_confirmation" class="form-control">
                </div>
            </div>
            <div class="mt-3">
                <button type="submit" class="btn btn-warning">💾 Actualizar</button>
                <a href="{{ route('usuario.index') }}" class="btn btn-outline-secondary">Cancelar</a>
            </div>
        </form>
    </div></div>
</div>
@endsection