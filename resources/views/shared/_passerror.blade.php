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
