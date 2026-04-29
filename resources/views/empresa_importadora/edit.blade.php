@extends('layouts.app')
@section('content')
<div class="container py-3" style="max-width:700px">
    <h2>✏️ Editar Empresa Importadora</h2>
    @if($errors->any())<div class="alert alert-danger"><ul class="mb-0">@foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul></div>@endif
    <div class="card shadow-sm"><div class="card-body">
        <form action="{{ route('empresa-importadora.update', $empresa->id_empresa_mx) }}" method="POST">
            @csrf @method('PUT')
            @include('empresa_importadora.form')
            <button type="submit" class="btn btn-warning">💾 Actualizar</button>
            <a href="{{ route('empresa-importadora.index') }}" class="btn btn-outline-secondary">Cancelar</a>
        </form>
    </div></div>
</div>
@endsection
