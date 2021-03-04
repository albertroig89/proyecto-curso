@extends('layout')

@section('title', "Edicion de usuarios")

@section('content')

        <h1>{{ $title }}</h1>

        <form method="POST" action="{{ url("usuarios/{$user->id}") }}">
                {{ method_field('PUT') }}
                {!! csrf_field() !!}

                <div class="form-row">
                        <div class="col-md-4 mb-3">
                                @if ($errors->has('name'))
                                        <label for="name">Nombre:</label>
                                        <input type="text" name="name" class="form-control is-invalid" id="name" aria-describedby="nameHelp" placeholder="Bertito tito" value="{{ old('name', $user->name) }}">
                                        <div class="invalid-feedback">
                                                {{ $errors->first('name') }}
                                        </div>
                                @elseif ($errors->any())
                                        <label for="name">Nombre:</label>
                                        <input type="text" name="name" class="form-control is-valid" id="name" aria-describedby="nameHelp" placeholder="Bertito tito" value="{{ old('name', $user->name) }}">
                                        <div class="valid-feedback">
                                                Correcto!
                                        </div>
                                @else
                                        <label for="name">Nombre:</label>
                                        <input type="text" name="name" class="form-control" id="name" aria-describedby="nameHelp" placeholder="Bertito tito" value="{{ old('name', $user->name) }}">
                                        <small id="nameHelp" class="form-text text-muted">Escribe tu nombre.</small>
                                @endif
                        </div>

                        <div class="col-md-4 mb-3">
                                @if ($errors->has('email'))
                                        <label for="email">Correo electronico:</label>
                                        <input type="email" name="email" class="form-control is-invalid" id="email" aria-describedby="emailHelp" placeholder="bertito@example.es" value="{{ old('email', $user->email) }}">
                                        <div class="invalid-feedback">
                                                {{ $errors->first('email') }}
                                        </div>
                                @elseif ($errors->any())
                                        <label for="email">Correo electronico:</label>
                                        <input type="email" name="email" class="form-control is-valid" id="email" aria-describedby="emailHelp" placeholder="bertito@example.es" value="{{ old('email', $user->email) }}">
                                        <div class="valid-feedback">
                                                Correcto!
                                        </div>
                                @else
                                        <label for="email">Correo electronico:</label>
                                        <input type="email" name="email" class="form-control" id="email" aria-describedby="emailHelp" placeholder="bertito@example.es" value="{{ old('email', $user->email) }}">
                                        <small id="emailHelp" class="form-text text-muted">Escribe un email que puedas verificar.</small>
                                @endif
                        </div>
                        <div class="col-md-4 mb-3">
                                @if ($errors->has('password'))
                                        <label for="password">Password</label>
                                        <input type="password" name="password" class="form-control is-invalid" id="password" placeholder="Introduce tu contraseña">
                                        <div class="invalid-feedback">
                                                {{ $errors->first('password') }}
                                        </div>
                                @else
                                        <label for="password">Password</label>
                                        <input type="password" name="password" class="form-control" id="password" placeholder="Introduce tu contraseña">
                                        <small id="emailHelp" class="form-text text-muted">Minimo 6 caracteres.</small>
                                @endif
                        </div>
                </div>

                <button type="submit" class="btn btn-primary">Editar usuario</button>
        </form>
        <br>
        <p><a href="{{ route('users.index') }}">Regresar al listado de usuarios</a></p>

        @if ($errors->any())
                <br>
                <div class="col-md-4 mb-3">
                        <div class="alert alert-danger">
                                <h5>Por favor corrige los errores mencionados arriba</h5>
                                {{--                    <ul>--}}
                                {{--                        @foreach ($errors->all() as $error)--}}
                                {{--                            <li>{{ $error }}</li>--}}
                                {{--                        @endforeach--}}
                                {{--                    </ul>--}}
                        </div>
                </div>
        @endif

@endsection