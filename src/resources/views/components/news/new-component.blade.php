<div class="card" >
    <img src="https://picsum.photos/seed/{{ $new['id'] }}/1200/675" class="card-img img-fluid" alt="{{ $new['title'] }} | TornaFácil">
    <div class="card-body">
        <h1 class="card-title">{{ $new['title'] }}</h1>
        <h2 class="card-subtitle text-muted h6" >
            Publicado em {{ $new['created_at'] }} por
            @if($new['is_contact'])
            <a href="{{ $new['url_contact'] }}">
                <i class="fa-solid fa-user mr-2"></i>
                {{ $new['author'] }}
            </a>
            @else
            <strong>{{ $new['author'] }}</strong>
            @endif
        </h2>
        <div class="card-text mt-4">
            {{ $new['content'] }}
        </div>
    </div>
</div>