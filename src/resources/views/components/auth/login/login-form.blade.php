<form method="POST" action="{{ route('login.store') }}">

    @csrf

    <div class="form-group mb-3">
        <div class="input-group">
            <span class="input-group-text"><i class="fa-solid fa-at"></i></span>
            <input type="email"
                    class="form-control {{ $errors->has('email') ? ' is-invalid' : '' }} rounded-end-2"
                    name="email"
                    value="{{ old('email') }}"
                    placeholder="Digite seu E-mail"
                    required
                    autofocus
            >
        </div>
        @if ($errors->has('email'))
            <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('email') }}</strong>
            </span>
        @endif
    </div>

    <div class="form-group mb-3">
        <div class="input-group">
            <span class="input-group-text"><i class="fa-solid fa-lock"></i></span>
            <input type="password"
                    class="form-control {{ $errors->has('password') ? ' is-invalid' : '' }}"
                    name="password"
                    value="{{ old('password') }}"
                    placeholder="Digite sua Senha"
                    required
            >
        </div>
        @if ($errors->has('password'))
            <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('password') }}</strong>
            </span>
        @endif
    </div>

    <div class="form-check d-flex justify-content-center mb-3">
        <input class="form-check-input me-2" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
        <label class="form-check-label" for="remember">
            Lembrar
        </label>
    </div>

    <div class="form-group text-center mb-3">
        <button type="submit" class="btn btn-primary btn-lg">
            <i class="fa-solid fa-arrow-right-to-bracket me-2"></i> Entrar
        </button>
    </div>

</form>