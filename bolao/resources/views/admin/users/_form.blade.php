<div class="row">
    <div class="form-group col-6">
        <label for="name">Nome</label>
        <input type="text" name="name" value="{{ old('name') }}" class="form-control {{ $errors->has('name') ? ' is-invalid' : '' }}">
        @if ($errors->has('name'))
            <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('name') }}</strong>
            </span>
        @endif
    </div>

    <div class="form-group col-6">
        <label for="email">E-Mail</label>
        <input type="email" name="email" value="{{ old('email') }}" class="form-control {{ $errors->has('email') ? ' is-invalid' : '' }}">
        @if ($errors->has('email'))
            <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('email') }}</strong>
            </span>
        @endif
    </div>

    <div class="form-group col-6">
        <label for="password">Senha</label>
        <input type="password" name="password" value="" class="form-control {{ $errors->has('password') ? ' is-invalid' : '' }}">
        @if ($errors->has('password'))
            <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('password') }}</strong>
            </span>
        @endif
    </div>

    <div class="form-group col-6">
        <label for="password">Confirmar Senha</label>
        <input type="password" name="password_confirmation" value="" class="form-control">
    </div>
</div>
