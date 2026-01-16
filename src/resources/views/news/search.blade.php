<x-layouts.main>
    <div class="row my-4 d-flex justify-content-between align-items-center" >
        <div class="col-12" >
            <h1>Buscar em notícias</h1>
        </div>
    </div>
    <div class="row" >
        <div class="col-12" >
            <x-news.search.form-component :result="$result" ></x-news.search.form-component>
        </div>
    </div>

    <div class="row" >
        <div class="col-12" >
            @if($result->isEmpty())
            <div class="alert alert-info text-center" >
                Não foram encontrados resultados
            </div>
            @else
                <p>Foram encontrados {{ $result->count() }} resultados:</p>

                @foreach ($result as $key => $new)
                <div class="card mb-3" >
                    <div class="card-body" >
                        <h2 class="card-title h3" >
                            {{ $key + 1 }}.
                            <a href="{{ route('new', $new) }}">
                                {{ $new->title }}
                            </a>
                        </h2>
                        <p class="h6" >de
                            <a href="{{ route('scheduler.contacts', [ 'contact_id' => $new->author->id ] ) }}">
                                <i class="fa-solid fa-user mr-2"></i>
                                {{ $new->author->profile->name() }}
                            </a>
                            em {{ $new->created_at->format('d M Y') }}</p>
                    </div>
                </div>
                @endforeach
            @endif
        </div>
    </div>

</x-layouts.main>