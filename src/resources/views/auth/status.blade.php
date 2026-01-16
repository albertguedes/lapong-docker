<x-layouts.auth>
    <div class="container py-0 my-0">
        <div class="p-0 m-0 row vh-100 justify-content-center">
            <div class="col-6 align-self-center">
                <div class="align-middle border-0 card">
                    <div class="card-body">

                        <div class="mb-5 text-center">
                            <figure class="text-center mb-3">
                                <img class="img-fluid" src="{{ asset('assets/images/bitmap.svg') }}" alt="Logo | Torna Fácil">
                            </figure>
                            <h1 class="pt-2 text-{{ $status['type'] }}" >{{ $status['title'] }}</h1>
                        </div>

                        <p class="text-center" >{{ $status['message'] }}</p>

                        <div class="row justify-content-center">
                            <div class="pt-3 mt-4 text-center col-12 border-top">
                                <a class="btn btn-link" href="{{ route('auth.login') }}">
                                    <i class="fa-solid fa-arrow-left"></i> Voltar
                                </a>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layouts.auth>