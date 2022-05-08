@extends('layout')

@section('title', "Creacion de usuarios")

@section('content')

    <div class="card pl-0 pr-0 col-md-8" >
        <div class="card-header"><h3>{{ $title }}</h3></div>
        <div class="card-body">
            <form method="POST" action="{{ url('usuarios') }}">

            @include('users._fields')
                <div class="form-group">
                    <button type="submit" class="btn btn-primary">Crear usuario</button>
                    <a class="float-right btn btn-primary" href="{{ route('users.index') }}">Regresar al listado de usuarios</a>
                </div>
            </form>

            @if ($errors->any())
                <br>
                <div>
                    <div class="alert alert-danger">
                        <h5>Por favor corrige los errores mencionados arriba</h5>
{{--                            <ul>--}}
{{--                                @foreach ($errors->all() as $error)--}}
{{--                                    <li>{{ $error }}</li>--}}
{{--                                @endforeach--}}
{{--                            </ul>--}}
                    </div>
                </div>
            @endif
        </div>
    </div>


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