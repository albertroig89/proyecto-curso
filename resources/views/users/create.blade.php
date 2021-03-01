@extends('layout')

@section('title', "Creacion de usuarios")

@section('content')

        <h1>{{ $title }}</h1>
        @if ($errors->any())
                <div class="col-md-4 mb-3">
                        <div class="alert alert-danger">
                                <p>Por favor corrige los siguientes errores:</p>
{{--                                <ul>--}}
{{--                                        @foreach ($errors->all() as $error)--}}
{{--                                                <li>{{ $error }}</li>--}}
{{--                                        @endforeach--}}
{{--                                </ul>--}}
                        </div>
                </div>
        @endif

        <form method="POST" action="{{ url('usuarios') }}">

                {!! csrf_field() !!}

                <div class="form-row">
                        <div class="col-md-4 mb-3">

                                @if ($errors->has('name'))
                                        <label for="name">Nombre:</label>
                                        <input type="text" name="name" class="form-control is-invalid" id="name" aria-describedby="nameHelp" placeholder="Bertito tito" value="{{ old('name') }}">
                                        <small id="nameHelp" class="form-text text-muted">Tu nombre.</small>
                                        <div class="invalid-feedback">
                                                {{ $errors->first('name') }}
                                        </div>
                                @else
                                        <label for="name">Nombre:</label>
                                        <input type="text" name="name" class="form-control" id="name" aria-describedby="nameHelp" placeholder="Bertito tito" value="{{ old('name') }}">
                                        <small id="nameHelp" class="form-text text-muted">Tu nombre.</small>
                               @endif
                        </div>

                        <div class="col-md-4 mb-3">
                            @if ($errors->has('email'))
                                <label for="email">Correo electronico:</label>
                                <input type="email" name="email" class="form-control" id="email" aria-describedby="emailHelp" placeholder="bertito@example.es" value="{{ old('email') }}">
                                <small id="emailHelp" class="form-text text-muted">Nunca compartas tu email con nadie.</small>
                                <div class="invalid-feedback">
                                    {{ $errors->first('email') }}
                                </div>
                            @else
                                <label for="email">Correo electronico:</label>
                                <input type="email" name="email" class="form-control" id="email" aria-describedby="emailHelp" placeholder="bertito@example.es" value="{{ old('email') }}">
                                <small id="emailHelp" class="form-text text-muted">Nunca compartas tu email con nadie.</small>
                            @endif
                        </div>


                        <div class="col-md-4 mb-3">
                                <label for="password">Password</label>
                                <input type="password" name="password" class="form-control" id="password" placeholder="Introduce tu contraseña">
                                <small id="emailHelp" class="form-text text-muted">Minimo 6 caracteres.</small>
                                <div class="invalid-feedback">
                                        @if ($errors->has('password'))
                                                <div class="invalid-feedback">
                                                        {{ $errors->first('password') }}
                                                </div>
                                        @endif
                                </div>
                        </div>
                </div>
{{--                <div class="form-group">--}}
{{--                        <div class="form-check">--}}
{{--                                <input class="form-check-input is-invalid" type="checkbox" value="" id="invalidCheck3" required>--}}
{{--                                <label class="form-check-label" for="invalidCheck3">--}}
{{--                                        Agree to terms and conditions--}}
{{--                                </label>--}}
{{--                                --}}
{{--                                <div class="invalid-feedback">--}}
{{--                                        @if ($errors->has('checkbox'))--}}
{{--                                                <div class="invalid-feedback">--}}
{{--                                                        <p>{{ $errors->first('password') }}</p>--}}
{{--                                                </div>--}}
{{--                                        @endif--}}
{{--                                </div>--}}
{{--                        </div>--}}
{{--                </div>--}}
                <button type="submit" class="btn btn-primary">Crear usuario</button>
        </form>





                <br>
                <p><a href="{{ route('users.index') }}">Regresar al listado de usuarios</a></p>

        @endsection
