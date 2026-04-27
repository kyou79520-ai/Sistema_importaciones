{{-- ARCHIVO: resources/views/usuario/create.blade.php --}}
@extends('layouts.app')
@section('content')
<div class="container py-3" style="max-width:700px">
    <h2>➕ Nuevo Usuario</h2>
    @if($errors->any())<div class="alert alert-danger"><ul>@foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul></div>@endif
    <div class="card shadow-sm"><div class="card-body">
        <form action="{{ route('usuario.store') }}" method="POST">
            @csrf
            @include('usuario.form', ['usuario' => null])
            <div class="mb-3">
                <label class="form-label fw-bold">Contraseña *</label>
                <input type="password" name="password" class="form-control" required>
            </div>
            <div class="mb-3">
                <label class="form-label fw-bold">Confirmar Contraseña *</label>
                <input type="password" name="password_confirmation" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-success">💾 Crear Usuario</button>
            <a href="{{ route('usuario.index') }}" class="btn btn-outline-secondary">Cancelar</a>
        </form>
    </div></div>
</div>
@endsection