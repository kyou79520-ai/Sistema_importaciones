@extends('layouts.app')
@section('content')
<div class="container py-3">
    <h2>✏️ Editar Importación #{{ $importacion->numero_importacion }}</h2>
    <div class="card shadow-sm">
        <div class="card-body">
            <form action="{{ route('importacion.update', $importacion->id_importacion) }}" method="POST">
                @csrf @method('PUT')
                @include('importacion.form')
                <div class="mt-3">
                    <button type="submit" class="btn btn-warning">💾 Actualizar</button>
                    <a href="{{ route('importacion.show', $importacion->id_importacion) }}" class="btn btn-outline-secondary">Cancelar</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection