@extends('layouts.app')
@section('content')
<div class="container py-3" style="max-width:600px">
    <h2>✏️ Editar Agente Aduanal</h2>
    <div class="card shadow-sm">
        <div class="card-body">
            <form action="{{ route('agente-aduanal.update', $agente->id_agente) }}" method="POST">
                @csrf @method('PUT')
                @include('agente_aduanal.form', ['agente' => $agente])
                <button type="submit" class="btn btn-warning mt-3">💾 Actualizar</button>
                <a href="{{ route('agente-aduanal.index') }}" class="btn btn-outline-secondary mt-3">Cancelar</a>
            </form>
        </div>
    </div>
</div>
@endsection