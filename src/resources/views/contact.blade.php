<x-layouts.main>

    <div class="card" >
        <div class="card-body">
            <h1 class="card-title">Contact</h1>
        </div>
    </div>

    <div class="row mt-4" >

        <div class="col-6" >
            <div class="card contact-card" >
                <div class="card-body">
                    <dl class="row">

                        <dt class="col-1 text-center mb-3">
                            <i class="h4 text-muted fa-solid fa-at"></i>
                        </dt>
                        <dd class="col-11">
                            <a href="mailto:contato@tornafacil.com.br">contato@tornafacil.com.br</a>
                        </dd>

                        <dt class="col-1 text-center mb-3">
                            <i class="h4 text-muted fa-solid fa-phone"></i>
                        </dt>
                        <dd class="col-11">
                            (11) 99999-9999 | (11) 88888-8888
                        </dd>

                        <dt class="col-1 text-center">
                            <i class="h4 text-muted fa-solid fa-location-dot"></i>
                        </dt>
                        <dd class="col-11">
                            Avenida Paulista 123 - Bela Vista - SP
                        </dd>
                    </dl>

                    <div class="row">
                        <div class="col-12">
                            <div id="map" class="tornafacil-map" ></div>
                        </div>
                    </div>

                </div>
            </div>
        </div>

        <div class="col-6 contact-col" >
            <div class="card contact-card" >
                <div class="card-body">
                    <form action="{{ route('contact.send') }}" method="POST">

                        @csrf

                        <div class="mb-3">
                            <div class="input-group">
                                <span class="input-group-text"><i class="fa-solid fa-user"></i></span>
                                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name') }}" placeholder="Digite seu nome completo" required>
                                @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-3">
                            <div class="input-group">
                                <span class="input-group-text"><i class="fa-solid fa-envelope"></i></span>
                                <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email') }}" placeholder="Digite seu E-mail" required>
                                @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-3">
                            <div class="input-group">
                                <span class="input-group-text"><i class="fa-solid fa-comment"></i></span>
                                <textarea class="form-control @error('message') is-invalid @enderror" id="message" name="message" rows="15" placeholder="Digite sua mensagem" required>{{ old('message') }}</textarea>
                                @error('message')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="w-100 text-center">
                            <button type="submit" class="btn btn-primary btn-lg">Send Message</button>
                        </div>

                    </form>
                </div>
            </div>
        </div>

    </div>

    @push('styles')
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />
    @endpush

    @push('footer_scripts')
    <script type="text/javascript" src="{{ asset('assets/js/script.js') }}" ></script>
    <script type="text/javascript" src="{{ asset('assets/js/pages/contact.js') }}" ></script>
    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>
    @endpush

</x-layouts.main>