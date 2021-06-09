@extends('layout')

@section('title', "Creacion de usuarios")

@section('content')

    <div class="card pl-0 pr-0 col-md-4" >
        <div class="card-header"><h3>{{ $title }}</h3></div>
        <div class="card-body">
            <form method="POST" action="{{ url('usuarios') }}">

                {!! csrf_field() !!}

                <div class="form-group">
                    <div class="form-group">
                        @if ($errors->has('name'))
                            <label for="name">Nombre:</label>
                            <input type="text" name="name" class="form-control is-invalid" id="name" aria-describedby="nameHelp" placeholder="Bertito tito" value="{{ old('name') }}">
                            <div class="invalid-feedback">
                                {{ $errors->first('name') }}
                            </div>
                        @elseif ($errors->any())
                            <label for="name">Nombre:</label>
                            <input type="text" name="name" class="form-control is-valid" id="name" aria-describedby="nameHelp" placeholder="Bertito tito" value="{{ old('name') }}">
                            <div class="valid-feedback">
                                Correcto!
                            </div>
                        @else
                            <label for="name">Nombre:</label>
                            <input type="text" name="name" class="form-control" id="name" aria-describedby="nameHelp" placeholder="Bertito tito" value="{{ old('name') }}">
                            <small id="nameHelp" class="form-text text-muted">Escribe tu nombre.</small>
                        @endif
                    </div>

                    <div class="form-group">
                        @if ($errors->has('email'))
                            <label for="email">Correo electronico:</label>
                            <input type="email" name="email" class="form-control is-invalid" id="email" aria-describedby="emailHelp" placeholder="bertito@example.es" value="{{ old('email') }}">
                            <div class="invalid-feedback">
                                {{ $errors->first('email') }}
                            </div>
                        @elseif ($errors->any())
                            <label for="email">Correo electronico:</label>
                            <input type="email" name="email" class="form-control is-valid" id="email" aria-describedby="emailHelp" placeholder="bertito@example.es" value="{{ old('email') }}">
                            <div class="valid-feedback">
                                Correcto!
                            </div>
                        @else
                            <label for="email">Correo electronico:</label>
                            <input type="email" name="email" class="form-control" id="email" aria-describedby="emailHelp" placeholder="bertito@example.es" value="{{ old('email') }}">
                            <small id="emailHelp" class="form-text text-muted">Escribe un email que puedas verificar.</small>
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="bio">Bio:</label>
                        <textarea name="bio" class="form-control" id="bio">{{ old('bio') }}</textarea>
                    </div>

                    <div class="form-group">
                        <label for="profession_id">Profesión</label>
                        <select name="profession_id" id="profession_id" class="form-control">
                            <option value="">Selecciona una professión</option>
                            @foreach($professions as $profession)
                                <option value="{{ $profession->id }}"{{ old('profession_id') == $profession->id ? ' selected' : ''}}>
                                    {{ $profession->title }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="twitter">Twitter:</label>
                        <input name="twitter" class="form-control" id="twitter" placeholder="https://twitter.com/example" value="{{ old('twitter') }}">
                    </div>
{{--                    <div class="col-md-4 mb-3">--}}
{{--                        <select class="custom-select" required>--}}
{{--                            <option value="">Selecciona tu profession</option>--}}
{{--                            @foreach ($professions as $profession)--}}
{{--                                <option value="{{ $profession->id }}">{{ $profession->title }}</option>--}}
{{--                            @endforeach--}}
{{--                        </select>--}}
{{--                        <div class="invalid-feedback">Example invalid custom select feedback</div>--}}
{{--                    </div> VOLIA FER UNA SELECCIO DE LA PROFESSIO AL CREAR O EDITAR USUARIS--}}
                    <div class="form-group">
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
        </div>
    </div>


@endsection
