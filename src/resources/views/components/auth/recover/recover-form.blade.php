<form method="POST" action="{{ route('password.email') }}">
    @csrf
    <div class="form-group mb-3">
        <div class="input-group">
            <span class="input-group-text"><i class="fa-solid fa-envelope"></i></span>
            <input type="email" class="form-control rounded-end-2 {{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" placeholder="Digite seu E-mail cadastrado" required autofocus>
        </div>
        @if ($errors->has('email'))
            <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('email') }}</strong>
            </span>
        @endif
    </div>
    <div class="mb-0 form-group text-center">
        <button type="submit" class="btn btn-primary btn-lg">
            <i class="fa-solid fa-rotate-left"></i> Recuperar
        </button>
    </div>
</form>