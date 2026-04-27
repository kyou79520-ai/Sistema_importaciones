@extends('layouts.app')
@section('content')
<div class="container py-3" style="max-width:600px">
    <h2>➕ Nueva Empresa Importadora</h2>
    @if($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">@foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul>
        </div>
    @endif
    <div class="card shadow-sm">
        <div class="card-body">
            <form action="{{ route('empresa-importadora.store') }}" method="POST">
                @csrf
                @include('empresa_importadora.form', ['empresa' => null])
                <button type="submit" class="btn btn-success mt-3">💾 Guardar</button>
                <a href="{{ route('empresa-importadora.index') }}" class="btn btn-outline-secondary mt-3">Cancelar</a>
            </form>
        </div>
    </div>
</div>
@endsection