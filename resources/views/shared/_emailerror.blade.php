
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
