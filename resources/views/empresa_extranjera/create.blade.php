@extends('layouts.app')

@section('content')
<div class="container py-3" style="max-width:700px">
    <h2>➕ Nueva Empresa Extranjera</h2>

    @if($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">@foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul>
        </div>
    @endif

    <div class="card shadow-sm">
        <div class="card-body">
            <form action="{{ route('empresa-extranjera.store') }}" method="POST">
                @csrf
                @include('empresa_extranjera.form', ['empresa' => null])
                <button type="submit" class="btn btn-success">💾 Guardar</button>
                <a href="{{ route('empresa-extranjera.index') }}" class="btn btn-outline-secondary">Cancelar</a>
            </form>
        </div>
    </div>
</div>
@endsection
