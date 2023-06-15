@extends('layout')

@section('title', "Usuario {$user->id}")

@section('content')

        <h1>Usuario #{{ $user->id }}</h1>

        <p>Nombre del usuario: {{ $user->name }}</p>
        <p>Correo electronico: {{ $user->email }}</p>
        @empty($user->profile->profession_id)
            <p>No tiene profession</p>
        @else
            @foreach($professions as $profession)
                @if($profession->id == $user->profile->profession_id)
                    <p>Profession: {{ $profession->title }}</p>
                @endif
            @endforeach
        @endempty
        <p><a href="{{ route('users.index') }}">Regresar al listado de usuarios</a></p>
              
@endsection