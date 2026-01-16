<x-layouts.main>

    <div class="row my-4 d-flex justify-content-between align-items-center" >
        <h1>
            @if($author)
            <div class="float-start text-capitalize">
                Notícias de <strong>{{ $author }}</strong>
            </div>
            @else
            <div class="float-start">
                Notícias
            </div>
            @endif
        </h1>
    </div>

    <div class="row" >
        <div class="col-12" >
            <x-news.search.form-component ></x-news.search.form-component>
        </div>
    </div>

    <div class="row" >
        <div class="col-12" >
            <x-news.list-component :news="$news" ></x-news.list-component>
        </div>
    </div>

</x-layouts.main>