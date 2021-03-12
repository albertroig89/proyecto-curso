@extends('layout')

@section('title', "Usuario {$user->id}")

@section('content')

    <div class="card pl-0 pr-0 col-md-3" >
        <div class="card-header"><h3>Usuario #{{ $user->id }}</h3></div>
        <div class="card-body">


        <p>Nombre del usuario: {{ $user->name }}</p>
        <p>Correo electronico: {{ $user->email }}</p>
        @empty($user->profession_id)
            <p>No tiene profession</p>
        @else
            <p>Profession: {{ $user->profession->title }}</p>
        @endempty
        <p><a href="{{ route('users.index') }}">Regresar al listado de usuarios</a></p>
        </div>
    </div>
              
@endsection