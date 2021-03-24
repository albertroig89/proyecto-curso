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
        @empty($user->user_profile->twitter)
            <p>No tiene twitter</p>
        @else
            <p>Twitter: {{ $user->user_profile->twitter }}</p>
        @endempty
        @empty($user->user_profile->bio)
            <p>No tiene biografia</p>
        @else
            <p>Biografia: {{ $user->user_profile->bio }}</p>
        @endempty
        <p><a href="{{ route('users.index') }}">Regresar al listado de usuarios</a></p>
        </div>
    </div>
              
@endsection