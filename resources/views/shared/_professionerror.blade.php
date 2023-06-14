
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
