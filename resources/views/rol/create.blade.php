@extends('layouts.app')
@section('content')
<div class="container py-3" style="max-width:700px">
    <h2>➕ Nuevo Rol</h2>
    @if($errors->any())<div class="alert alert-danger"><ul>@foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul></div>@endif
    <div class="card shadow-sm"><div class="card-body">
        <form action="{{ route('rol.store') }}" method="POST">
            @csrf
            @include('rol.form', ['rol' => null])
            <button type="submit" class="btn btn-success mt-3">💾 Crear Rol</button>
            <a href="{{ route('rol.index') }}" class="btn btn-outline-secondary mt-3">Cancelar</a>
        </form>
    </div></div>
</div>
@endsection