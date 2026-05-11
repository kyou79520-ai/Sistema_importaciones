@extends('layouts.app')

@section('content')
<div class="container py-3">
    <h2>✏️ Editar Importación: {{ $importacion->numero_importacion }}</h2>

    @if($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">@foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul>
        </div>
    @endif

    <div class="card shadow-sm">
        <div class="card-body">
            <form action="{{ route('importacion.update', $importacion->id_importacion) }}" method="POST">
                @csrf @method('PUT')
                @include('importacion.form')
                <button type="submit" class="btn btn-warning">💾 Actualizar</button>
                <a href="{{ route('importacion.show', $importacion->id_importacion) }}"
                   class="btn btn-outline-secondary">Cancelar</a>
            </form>
        </div>
    </div>
</div>
@endsection
