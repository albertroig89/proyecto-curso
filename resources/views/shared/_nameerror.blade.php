
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