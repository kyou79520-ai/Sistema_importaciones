@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Editar empleado</h2>

    @if (session('mensaje'))
        <div class="alert alert-success">{{ session('mensaje') }}</div>
    @endif

    <form action="{{ url('/empleado/' . $empleado->id) }}" method="post" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        @include('empleado.form')
    </form>
</div>
@endsection