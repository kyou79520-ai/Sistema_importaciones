@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-md-6 col-lg-5">
            <div class="card shadow-sm">
                <div class="card-header text-center fw-bold bg-primary text-white">
                    🔐 Iniciar Sesión
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

                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="mb-3">
                            <label for="login" class="form-label fw-bold">Usuario o Email</label>
                            <input id="login" type="text" name="login"
                                   class="form-control @error('login') is-invalid @enderror"
                                   value="{{ old('login') }}" required autofocus>
                        </div>

                        <div class="mb-3">
                            <label for="password" class="form-label fw-bold">Contraseña</label>
                            <input id="password" type="password" name="password"
                                   class="form-control @error('password') is-invalid @enderror"
                                   required>
                        </div>

                        <div class="form-check mb-3">
                            <input type="checkbox" name="remember" id="remember" class="form-check-input"
                                   {{ old('remember') ? 'checked' : '' }}>
                            <label for="remember" class="form-check-label">Recordarme</label>
                        </div>

                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary">Entrar</button>
                        </div>

                        <hr>
                        <div class="text-center">
                            @if(Route::has('register'))
                                <a href="{{ route('register') }}">¿No tienes cuenta? Regístrate</a>
                            @endif
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
