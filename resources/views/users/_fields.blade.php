{!! csrf_field() !!}

<div class="form-group">
    <div class="form-group">
        @include('shared._nameerror')
    </div>

    <div class="form-group">
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
    <div class="form-group">
        <label for="bio">Bio:</label>
        <textarea name="bio" class="form-control" id="bio">{{ old('bio', $user->profile->bio) }}</textarea>
    </div>

    <div class="form-group">
        <label for="profession_id">Profesión</label>
        @if ($errors->has('profession_id'))
            <select name="profession_id" id="profession_id" class="form-control is-invalid">
                <option value="">Selecciona una professión</option>
                @foreach($professions as $profession)
                    <option value="{{ $profession->id }}"{{ old('profession_id', $user->profile->profession_id) == $profession->id ? ' selected' : ''}}>
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
                    <option value="{{ $profession->id }}"{{ old('profession_id', $user->profile->profession_id) == $profession->id ? ' selected' : ''}}>
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
                    <option value="{{ $profession->id }}"{{ old('profession_id', $user->profile->profession_id) == $profession->id ? ' selected' : ''}}>
                        {{ $profession->title }}
                    </option>
                @endforeach
            </select>
        @endif
    </div>

    <div class="form-group">
        <label for="other_profession">Otra profesión: </label>
        @if ($errors->has('other_profession'))
            <input type="text" class="form-control is-invalid" name="other_profession" id="other_profession" placeholder="Rellena esto sino esta tu profesión" value="{{old('other_profession', $user->profile->other_profession)}}">
            <div class="invalid-feedback">
                {{ $errors->first('other_profession') }}
            </div>
        @elseif ($errors->any())
            <input type="text" class="form-control is-valid" name="other_profession" id="other_profession" placeholder="Rellena esto sino esta tu profesión" value="{{old('other_profession', $user->profile->other_profession)}}">
            <div class="valid-feedback">
                Correcto!
            </div>
        @else
            <input type="text" class="form-control" name="other_profession" id="other_profession" placeholder="Rellena esto sino esta tu profesión" value="{{old('other_profession', $user->profile->other_profession)}}">
        @endif
    </div>

    <div class="form-group">
        <label for="twitter">Twitter:</label>
        <input name="twitter" class="form-control" id="twitter" placeholder="https://twitter.com/example" value="{{ old('twitter', $user->profile->twitter) }}">
    </div>
    <div class="form-group">
        @include('shared._passerror')
    </div>

    <h5>Habilidades</h5>

    @foreach($skills as $skill)
        <div class="form-check form-check-inline">
            <input name="skills[{{ $skill->id }}]"
                   class="form-check-input"
                   type="checkbox"
                   id="skill_{{ $skill->id }}"
                   value="{{ $skill->id }}"
                    {{ $errors->any() ? old("skills.{$skill->id}") : $user->skills->contains($skill) ? 'checked' : '' }}>
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
                    {{ old('role', $user->role) == $role ? 'checked' : '' }}>
            <label class="form-check-label" for="role_{{ $role }}">{{ $name }}</label>
        </div>
    @endforeach

</div>