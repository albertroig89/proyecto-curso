@extends('layout')

@section('title', "Creacion de usuarios")

@section('content')

    @card
        @slot('header', 'Creación de usuarios')

        <form method="POST" action="{{ url('usuarios') }}">
{{--            @render('UserFields', ['user' => $user])--}}

            {{ new \App\Http\ViewComponents\UserFields($user) }}

            <div class="form-group">
                <button type="submit" class="btn btn-primary">Crear usuario</button>
                <a class="float-right btn btn-primary" href="{{ route('users.index') }}">Regresar al listado de usuarios</a>
            </div>
        </form>
    @endcard

    @include('shared._errors')

@endsection