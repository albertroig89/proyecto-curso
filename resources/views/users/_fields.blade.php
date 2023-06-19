{!! csrf_field() !!}

<div class="form-group">
    <div class="form-group">
        @include('shared._nameerror')
    </div>

    <div class="form-group">
        @include('shared._emailerror')
    </div>

    <div class="form-group">
        <label for="bio">Bio:</label>
        <textarea name="bio" class="form-control" id="bio">{{ old('bio', $user->profile->bio) }}</textarea>
    </div>

    <div class="form-group">
        <label for="profession_id">Profesión</label>
        @include('shared._professionerror')
    </div>

{{--    <div class="form-group">--}}
{{--        <label for="other_profession">Otra profesión: </label>--}}
{{--        @include('shared._otherprofessionerror')--}}
{{--    </div>--}}

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