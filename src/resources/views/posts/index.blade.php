<x-layouts.main>
<div class="card" >
    <div class="card-body">
        <h1 class="card-title">News</h1>
    </div>
</div>

<div class="row my-4">
    @for($i = 1; $i <= 9; $i++)
    <div class="col-4 mb-4">
        <div class="card" data-url="{{ route('posts.show', $i) }}" >
            <div class="card-body">
                <div class="row pb-4">
                    <div class="col-2 text-center pl-3">
                        <img src="https://picsum.photos/seed/{{ $i }}/50/50" class="rounded-circle mr-3" alt="Profile Image">
                    </div>
                    <div class="col-10 text-left">
                        <a href="#" class="h4 text-muted">John Doe</a>
                        <br>
                        <small>2025-05-11</small>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <h2 class="card-title text-left">Post Title {{ $i }}</h2>
                    </div>
                    <div class="col-12">
                        <img src="https://picsum.photos/seed/{{ $i }}/400/300" class="img-fluid mb-2" alt="Post Image">
                        <p class="card-text">This is a brief summary of post {{ $i }}. Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endfor
</div>

<div class="row" >
    <div class="col-12" >
        {{ $posts->links() }}
    </div>
</div>

<script>
    const cards = document.querySelectorAll('.card[data-url]');
    cards.forEach(card => {
        card.addEventListener('click', () => {
            window.location.href = card.getAttribute('data-url');
        });
    });
</script>
</x-layouts.main>