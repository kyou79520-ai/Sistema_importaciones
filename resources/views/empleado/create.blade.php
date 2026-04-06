@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Crear empleado</h2>

    @if (session('mensaje'))
        <div class="alert alert-success">{{ session('mensaje') }}</div>
    @endif

    <form action="{{ url('/empleado') }}" method="post" enctype="multipart/form-data">
        @csrf
        @include('empleado.form')
    </form>
</div>
@endsection