<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>{{ config('app.name', 'Laravel') }}</title>
        <link rel="stylesheet" href="{{ asset('assets/vendor/fontawesome-free-6.7.2-web/css/all.min.css') }}" type="text/css" />
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;700&display=swap" rel="stylesheet">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">
        <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}" type="text/css" />
        @stack('styles')
        @stack('header_scripts')
    </head>
    <body>
        <main class="container-fluid">
            <div class="row justify-content-center" >
                <div class="col-9" >
                    {{ $slot }}
                </div>
            </div>
        </main>
        <script type="text/javascript" src="{{ asset('assets/vendor/fontawesome-free-6.7.2-web/js/all.min.js') }}" ></script>
        <script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
        <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js" integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO" crossorigin="anonymous"></script>
        <script type="text/javascript" src="{{ asset('assets/js/layouts/main.js') }}" ></script>
        @stack('footer_scripts')
    </body>
</html>
