@extends('layout')

@section('title', "Creacion de usuarios")

@section('content')

        <h1>{{ $title }}</h1>

        <form method="POST" action="{{ url('usuarios') }}">
                {!! csrf_field() !!}
{{--                <label for="name">Nombre:</label>--}}
{{--                <input type="text" name="name" id="name" placeholder="Bertito tito">--}}
{{--                <br>--}}

{{--                <label for="email">Correo electrónico:</label>--}}
{{--                <input type="email" name="email" id="email" placeholder="bertito@example.com">--}}
{{--                <br>--}}

{{--                <label for="password">Contraseña:</label>--}}
{{--                <input type="password" name="password" id="password" placeholder="Mas de 6 caracteres">--}}
{{--                <br>--}}

{{--                <button type="submit">Crear usuario</button>--}}

                <div class="form-group">
                        <label for="name">Nombre:</label>
                        <input type="text" name="name" class="form-control" id="name" aria-describedby="emailHelp" placeholder="Bertito tito">
                        <small id="emailHelp" class="form-text text-muted">Tu nombre.</small>
                </div>
                <br>
                <div class="form-group">
                        <label for="exampleInputEmail1">Email address</label>
                        <input type="email" name="email" class="form-control" id="email" aria-describedby="emailHelp" placeholder="bertito@example.es">
                        <small id="emailHelp" class="form-text text-muted">Nunca compartas tu email con nadie.</small>
                </div>
                <br>
                <div class="form-group">
                        <label for="exampleInputPassword1">Password</label>
                        <input type="password" name="password" class="form-control" id="password" placeholder="Introduce tu contraseña">
                        <small id="emailHelp" class="form-text text-muted">Minimo 6 caracteres.</small>
                </div>
                <br>
                <button type="submit" class="btn btn-primary">Crear usuario</button>


        </form>
        <br>
        <p><a href="{{ route('users.index') }}">Regresar al listado de usuarios</a></p>
        
@endsection
