@extends('layouts.app')
@section('content')
<div class="container py-3" style="max-width:700px">
    <h2>✏️ Editar Agente Aduanal</h2>
    @if($errors->any())<div class="alert alert-danger"><ul class="mb-0">@foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul></div>@endif
    <div class="card shadow-sm"><div class="card-body">
        <form action="{{ route('agente-aduanal.update', $agente->id_agente) }}" method="POST">
            @csrf @method('PUT')
            @include('agente_aduanal.form')
            <button type="submit" class="btn btn-warning">💾 Actualizar</button>
            <a href="{{ route('agente-aduanal.index') }}" class="btn btn-outline-secondary">Cancelar</a>
        </form>
    </div></div>
</div>
@endsection
