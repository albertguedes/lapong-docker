<ul class="nav border-top pt-3 justify-content-center" >

    @if( route('login') != url()->current() )
    <li class="nav-item">
        <a class="nav-link" href="{{ route('login') }}">
            <i class="fa-solid fa-right-to-bracket"></i> Login
        </a>
    </li>
    @endif

    @if( route('register') != url()->current() )
    <li class="nav-item">
        <a class="nav-link" href="{{ route('register') }}">
            <i class="fa-solid fa-user-plus"></i> Cadastro
        </a>
    </li>
    @endif

    @if ( route('password.request') != url()->current() )
    <li class="nav-item">
        <a class="nav-link" href="{{ route('password.request') }}">
            <i class="fa-solid fa-key"></i> Recuperar Senha
        </a>
    </li>
    @endif

</ul>