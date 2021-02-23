@extends('layout')

@section('title', "Creacion de usuarios")

@section('content')

        <h1>{{ $title }}</h1>

        <form method="POST" action="{{ url('usuarios/crear') }}">
                {!! csrf_field() !!}
                <button type="submit">Crear usuario</button>
        </form>

        <p><a href="{{ route('users.index') }}">Regresar al listado de usuarios</a></p>
        
@endsection
