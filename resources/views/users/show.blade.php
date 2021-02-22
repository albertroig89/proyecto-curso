@extends('layout')

@section('title', "Usuario {$user->id}")

@section('content')

        <h1>Usuario #{{ $user->id }}</h1>

        <p>Nombre del usuario: {{ $user->name }}</p>
        <p>Correo electronico: {{ $user->email }}</p>
        @empty($user->profession_id)
            <p>No tiene profession</p>
        @else
            <p>Profession: {{ $user->profession->title }}</p>
        @endempty
        <p><a href="{{ url('/usuarios') }}">Regresar al listado de usuarios</a></p>
              
@endsection