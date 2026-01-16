@if(count($news))
    @foreach($news as $new)
    <div class="card my-4" >
        <div class="card-body">
            <div class="row">
                <div class="col-2 text-center">
                    <a href="{{ $new['url'] }}" >
                        <img src="https://picsum.photos/seed/{{ $new['id'] }}/400/300" class="card-img-start img-fluid" alt="Post Image">
                    </a>
                </div>
                <div class="col-10">
                    <h2 class="card-title">
                        <a class="text-decoration-none" href="{{ $new['url'] }}" >
                            {{ $new['title'] }}
                        </a>
                    </h2>
                    <h3 class="card-subtitle text-muted h6" >
                        Publicado em {{ $new['created_at'] }} por
                        @if($new['is_contact'])
                        <a href="{{ $new['url_contact'] }}">
                            <i class="fa-solid fa-user mr-2"></i> {{ $new['author'] }}
                        </a>
                        @else
                        <strong>{{ $new['author'] }}</strong>
                        @endif
                    </h3>
                    <p class="card-text mt-4">{{ $new['brief'] }}</p>
                    <a href="{{ $new['url'] }}" class="btn btn-primary">Read More</a>
                </div>
            </div>
        </div>
    </div>
    @endforeach
@else
<div class="alert alert-info text-center" >
    Não há notícias cadastradas
</div>
@endif