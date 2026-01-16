<x-layouts.auth>
    <div class="container py-0 my-0">
        <div class="p-0 m-0 row vh-100 justify-content-center">
            <div class="col-4 align-self-center">
                <div class="align-middle border-0 card">
                    <div class="card-body">

                        <div class="mb-5 text-center">
                            <figure class="text-center mb-3">
                                <img class="img-fluid" src="{{ asset('assets/images/bitmap.svg') }}" alt="Logo | Torna Fácil">
                            </figure>
                            <h1 class="pt-2 h4" >Área do Cliente</h1>
                        </div>

                        <x-auth.login.login-form ></x-auth.login.login-form>

                        <x-auth.auth-nav ></x-auth.auth-nav>

                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layouts.auth>