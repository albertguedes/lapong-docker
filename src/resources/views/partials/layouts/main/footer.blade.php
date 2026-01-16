<div class="container" >
    <div class="row" >
        <div class="col-12" >
            <ul class="my-auto list-inline float-start">
                <li class="align-middle list-inline-item">
                    <a class="nav-link" href="{{ config('app.url', "URL DO PROJETO") }}">{{ config('app.name', "NOME DO PROJETO") }} &copy; {{ date('Y') }}</a>
                </li>
            </ul>

            <ul class="my-auto list-inline float-end">
                <li class="align-middle list-inline-item">
                    <a class="nav-link" href="{{ route('pages.about') }}">About</a>
                </li>
                <li class="align-middle list-inline-item">
                    <a class="nav-link" href="{{ route('pages.privacy') }}">Policy & Privacy</a>
                </li>
                <li class="align-middle list-inline-item">
                    <a class="nav-link" href="{{ route('pages.terms') }}">Term & Conditions</a>
                </li>
                <li class="align-middle list-inline-item">
                    <a class="nav-link" href="{{ route('pages.help') }}">Help</a>
                </li>
                <li class="align-middle list-inline-item">
                    <a class="nav-link" href="{{ route('contact') }}">Contact</a>
                </li>
            </ul>
        </div>
    </div>
</div>
