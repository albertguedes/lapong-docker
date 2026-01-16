<form method="POST" action="{{ route('auth.reset_request') }}">
    @csrf
    <div class="form-group mb-3">
        <div class="input-group">
            <span class="input-group-text"><i class="fa-solid fa-key"></i></span>
            <input type="password" class="form-control rounded-end-2 {{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" value="{{ old('password') }}" placeholder="Digite nova senha" required autofocus>
        </div>
        @if ($errors->has('password'))
            <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('password') }}</strong>
            </span>
        @endif
    </div>
    <div class="form-group mb-3">
        <div class="input-group">
            <span class="input-group-text"><i class="fa-solid fa-key"></i></span>
            <input type="password" class="form-control rounded-end-2 {{ $errors->has('password_confirmation') ? ' is-invalid' : '' }}" name="password_confirmation" value="{{ old('password_confirmation') }}" placeholder="Digite nova senha novamente" required autofocus>
        </div>
        @if ($errors->has('password_confirmation'))
            <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('password_confirmation') }}</strong>
            </span>
        @endif
    </div>
    <div class="mb-0 form-group text-center">
        <button type="submit" class="btn btn-primary btn-lg">
            <i class="fa-solid fa-rotate-left"></i> Enviar
        </button>
    </div>
</form>