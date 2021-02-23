@extends('layout')

@section('title', "Creacion de usuarios")

@section('content')

        <h1>{{ $title }}</h1>

        <form method="POST" action="{{ url('usuarios') }}">
                {!! csrf_field() !!}
                <label for="name">Nombre:</label>
                <input type="text" name="name" id="name" placeholder="Bertito tito">
                <br>

                <label for="email">Correo electrónico:</label>
                <input type="email" name="email" id="email" placeholder="bertito@example.com">
                <br>

                <label for="password">Contraseña:</label>
                <input type="password" name="password" id="password" placeholder="Mas de 6 caracteres">
                <br>

                <button type="submit">Crear usuario</button>
        </form>

        <p><a href="{{ route('users.index') }}">Regresar al listado de usuarios</a></p>
        
@endsection
