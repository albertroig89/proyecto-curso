
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