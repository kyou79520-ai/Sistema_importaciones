@extends('layouts.app')

@section('content')
<div class="container py-3">
    <h2>➕ Nueva Importación</h2>

    @if($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">@foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul>
        </div>
    @endif

    <div class="card shadow-sm">
        <div class="card-body">
            <form action="{{ route('importacion.store') }}" method="POST">
                @csrf
                @include('importacion.form', ['importacion' => null, 'agentesSeleccionados' => []])
                <button type="submit" class="btn btn-success">💾 Crear Importación</button>
                <a href="{{ route('importacion.index') }}" class="btn btn-outline-secondary">Cancelar</a>
            </form>
        </div>
    </div>
</div>
@endsection
