<x-layouts.main>

    <div class="row my-4 d-flex justify-content-between align-items-center" >
        <h1>
            <div class="float-start">
                Profissionais
            </div>
        </h1>
    </div>

    <div class="row" >
        <div class="col-12" >
            <form class="mb-4" action="{{ route('medical.professional.search') }}" method="GET" >
                <div class="input-group">
                    <input type="text" class="form-control" name="query" placeholder="Pesquisar profissionais" required>
                    <button type="submit" class="btn btn-primary">Buscar</button>
                </div>
            </form>
        </div>
    </div>

    <div class="row" >
        <div class="col-12" >
            @foreach ( $professionals as $professional )
            <div class="card mb-4" >
                <div class="card-body">
                    <div class="row">
                        <div class="col-1 text-center">
                            <img class="img-fluid" src="https://picsum.photos/seed/{{ $professional->id }}/50/50" alt="Profile Image">
                        </div>
                        <div class="col-11 d-flex align-items-center">
                            <h2 class="card-title h5 text-capitalize text-start" >
                                <a href="{{ route('medical.professional.show', ['professional' => $professional->id]) }}" >
                                {{ $professional->profile->name() }}
                                </a>
                            </h2>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>

    <div class="row" >
        <div class="col-12" >
            {{ $professionals->links() }}
        </div>
    </div>

</x-layouts.main>