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
                <a href="{{ route('empresa-extranjera.index') }}" class="btn btn-outline-secondary mt-3">Cancelar</a>
            </form>
        </div>
    </div>
</div>
@endsection