@extends('layout')

@section('title', "Creacion de usuarios")

@section('content')

        <h1>{{ $title }}</h1>



        @if ($errors->any())

                <div class="alert alert-danger">
                        <p>Por favor corrige los siguientes errores:</p>
{{--                        <ul>--}}
{{--                                @foreach ($errors->all() as $error)--}}
{{--                                        <li>{{ $error }}</li>--}}
{{--                                @endforeach--}}
{{--                        </ul>--}}
                </div>
        @endif

{{--        <form method="POST" action="{{ url('usuarios') }}">--}}
{{--                {!! csrf_field() !!}--}}

{{--                <div class="form-group">--}}
{{--                        <label for="name">Nombre:</label>--}}
{{--                        <input type="text" name="name" class="form-control" id="name" aria-describedby="nameHelp" placeholder="Bertito tito" value="{{ old('name') }}">--}}
{{--                        <small id="nameHelp" class="form-text text-muted">Tu nombre.</small>--}}
{{--                        @if ($errors->has('name'))--}}
{{--                                <p>{{ $errors->first('name') }}</p>--}}
{{--                        @endif--}}
{{--                </div>--}}
{{--                <br>--}}
{{--                <div class="form-group">--}}
{{--                        <label for="exampleInputEmail1">Email address</label>--}}
{{--                        <input type="email" name="email" class="form-control" id="email" aria-describedby="emailHelp" placeholder="bertito@example.es" value="{{ old('email') }}">--}}
{{--                        <small id="emailHelp" class="form-text text-muted">Nunca compartas tu email con nadie.</small>--}}
{{--                        @if ($errors->has('email'))--}}
{{--                                <p>{{ $errors->first('email') }}</p>--}}
{{--                        @endif--}}
{{--                </div>--}}
{{--                <br>--}}
{{--                <div class="form-group">--}}
{{--                        <label for="exampleInputPassword1">Password</label>--}}
{{--                        <input type="password" name="password" class="form-control" id="password" placeholder="Introduce tu contraseña">--}}
{{--                        <small id="emailHelp" class="form-text text-muted">Minimo 6 caracteres.</small>--}}
{{--                </div>--}}
{{--                <br>--}}
{{--                <button type="submit" class="btn btn-primary">Crear usuario</button>--}}


{{--        </form>--}}










        <form method="POST" action="{{ url('usuarios') }}">
                {!! csrf_field() !!}
                <div class="form-row">
                        <div class="col-md-4 mb-3">
                                <label for="name">Nombre:</label>
                                <input type="name" class="form-control" id="name" placeholder="Bertito tito" value="{{ old('name') }}" required>
                                <small id="nameHelp" class="form-text text-muted">Tu nombre completo.</small>
                        </div>

                        <div class="col-md-4 mb-3">
                                <label for="email">Correo electronico:</label>
                                <div class="input-group">
                                        <div class="input-group-prepend">
                                                <span class="input-group-text" id="inputGroupPrepend2">@</span>
                                        </div>
                                        <input type="email" class="form-control" id="email" name="email" placeholder="bertito@example.es" aria-describedby="inputGroupPrepend2" value="{{ old('email') }}" required>
                                </div>
                                <small id="emailHelp" class="form-text text-muted">Nunca compartas tu email con nadie.</small>
                        </div>

                        <div class="col-md-4 mb-3">
                                <label for="password">Contraseña:</label>
                                <input type="password" name="password" class="form-control" id="password" placeholder="Introduce tu contraseña">
                                <small id="passwordHelp" class="form-text text-muted">Minimo 6 caracteres.</small>
                        </div>

                </div>

                <div class="form-group">
                        <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="invalidCheck2" required>
                                <label class="form-check-label" for="invalidCheck2">
                                        Acepta los terminos y condiciones
                                </label>
                        </div>
                </div>
                <br>
                <button class="btn btn-primary" type="submit">Crear usuario</button>
        </form>

        <br>
        <p><a href="{{ route('users.index') }}">Regresar al listado de usuarios</a></p>
        
@endsection
