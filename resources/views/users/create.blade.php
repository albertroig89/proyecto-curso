@extends('layout')

@section('title', "Creacion de usuarios")

@section('content')

    <div class="card pl-0 pr-0 col-md-8" >
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
                        @if ($errors->has('profession_id'))
                            <select name="profession_id" id="profession_id" class="form-control is-invalid">
                                <option value="">Selecciona una professión</option>
                                @foreach($professions as $profession)
                                    <option value="{{ $profession->id }}"{{ old('profession_id') == $profession->id ? ' selected' : ''}}>
                                        {{ $profession->title }}
                                    </option>
                                @endforeach
                            </select>
                            <div class="invalid-feedback">
                                {{ $errors->first('profession_id') }}
                            </div>
                        @elseif ($errors->any())
                            <select name="profession_id" id="profession_id" class="form-control is-valid">
                                <option value="">Selecciona una professión</option>
                                @foreach($professions as $profession)
                                    <option value="{{ $profession->id }}"{{ old('profession_id') == $profession->id ? ' selected' : ''}}>
                                        {{ $profession->title }}
                                    </option>
                                @endforeach
                            </select>
                            <div class="valid-feedback">
                                Correcto!
                            </div>
                        @else
                            <select name="profession_id" id="profession_id" class="form-control">
                                <option value="">Selecciona una professión</option>
                                @foreach($professions as $profession)
                                    <option value="{{ $profession->id }}"{{ old('profession_id') == $profession->id ? ' selected' : ''}}>
                                        {{ $profession->title }}
                                    </option>
                                @endforeach
                            </select>
                        @endif
                    </div>

                    <div class="form-group">
                        <label for="other_profession">Otra profesión: </label>
                        @if ($errors->has('other_profession'))
                            <input type="text" class="form-control is-invalid" name="other_profession" id="other_profession" placeholder="Rellena esto sino esta tu profesión" value="{{old('other_profession')}}">
                            <div class="invalid-feedback">
                                {{ $errors->first('other_profession') }}
                            </div>
                        @elseif ($errors->any())
                            <input type="text" class="form-control is-valid" name="other_profession" id="other_profession" placeholder="Rellena esto sino esta tu profesión" value="{{old('other_profession')}}">
                            <div class="valid-feedback">
                                Correcto!
                            </div>
                        @else
                            <input type="text" class="form-control" name="other_profession" id="other_profession" placeholder="Rellena esto sino esta tu profesión" value="{{old('other_profession')}}">
                        @endif
                    </div>

                    <div class="form-group">
                        <label for="twitter">Twitter:</label>
                        <input name="twitter" class="form-control" id="twitter" placeholder="https://twitter.com/example" value="{{ old('twitter') }}">
                    </div>
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

                    <h5>Habilidades</h5>

                    @foreach($skills as $skill)
                        <div class="form-check form-check-inline">
                            <input name="skills[{{ $skill->id }}]"
                                   class="form-check-input"
                                   type="checkbox"
                                   id="skill_{{ $skill->id }}"
                                   value="{{ $skill->id }}"
                                    {{ old("skills.{$skill->id}") ? 'checked' : '' }}>
                            <label class="form-check-label" for="skill_{{ $skill->id }}">{{ $skill->name }}</label>
                        </div>
                    @endforeach
                    <h5 class="mt-3">Rol</h5>
                    @foreach($roles as $role => $name)
                        <div class="form-check form-check-inline">
                            <input class="form-check-input"
                                   type="radio"
                                   name="role"
                                   id="role_{{ $role }}" value="{{ $role }}"
                                    {{ old('role') == $role ? 'checked' : '' }}>
                            <label class="form-check-label" for="role_{{ $role }}">{{ $name }}</label>
                        </div>
                    @endforeach

                </div>
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