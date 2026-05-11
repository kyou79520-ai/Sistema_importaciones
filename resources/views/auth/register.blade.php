@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-6">
            <div class="card shadow-sm">
                <div class="card-header text-center fw-bold bg-success text-white">
                    📝 Crear Cuenta
                </div>
                <div class="card-body">
                    @if($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach($errors->all() as $e)
                                    <li>{{ $e }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="mb-3">
                            <label class="form-label fw-bold">Nombre de Usuario *</label>
                            <input type="text" name="nombre_usuario" class="form-control"
                                   value="{{ old('nombre_usuario') }}" required>
                            <small class="text-muted">Sin espacios. Lo usarás para iniciar sesión.</small>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold">Nombre Completo *</label>
                            <input type="text" name="nombre_completo" class="form-control"
                                   value="{{ old('nombre_completo') }}" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold">Email *</label>
                            <input type="email" name="email" class="form-control"
                                   value="{{ old('email') }}" required>
                        </div>

                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label fw-bold">Contraseña *</label>
                                <input type="password" name="password" class="form-control" required>
                                <small class="text-muted">Mínimo 8 caracteres.</small>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-bold">Confirmar Contraseña *</label>
                                <input type="password" name="password_confirmation" class="form-control" required>
                            </div>
                        </div>

                        <div class="d-grid mt-4">
                            <button type="submit" class="btn btn-success">Registrarme</button>
                        </div>

                        <hr>
                        <div class="text-center">
                            <a href="{{ route('login') }}">¿Ya tienes cuenta? Inicia sesión</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
