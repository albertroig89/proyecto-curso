@extends('layout')

@section('title', "Creacion de usuarios")

@section('content')

    @card
        @slot('header', 'Creación de usuarios')

        <form method="POST" action="{{ url('usuarios') }}">
            @include('users._fields')
            <div class="form-group">
                <button type="submit" class="btn btn-primary">Crear usuario</button>
                <a class="float-right btn btn-primary" href="{{ route('users.index') }}">Regresar al listado de usuarios</a>
            </div>
        </form>
    @endcard

    @include('shared._errors')

@endsection

@section('jquery')
    @parent
    console.log('Template: create.blade.php');
    $('#profession_id').on('change', function() {
        if( this.value != "" ){
            $('#other_profession').parent().hide();
        }else{
            $('#other_profession').parent().show();
        }
    });
@endsection