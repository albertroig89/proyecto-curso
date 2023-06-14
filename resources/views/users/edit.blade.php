@extends('layout')

@section('title', "Edicion de usuarios")

@section('content')

    @card
        @slot('header', 'Edición de usuarios')

        <form method="POST" action="{{ url("usuarios/{$user->id}") }}">
            {{ method_field('PUT') }}

            @render('UserFields', compact('user'))

            <div class="form-group">
                <button type="submit" class="btn btn-primary">Editar usuario</button>
                <a class="float-right btn btn-primary" href="{{ route('users.index') }}">Regresar al listado de usuarios</a>
            </div>
        </form>

        @include('shared._errors')

    @endcard

@endsection