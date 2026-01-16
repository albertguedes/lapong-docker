<form method="GET" action="{{ route('news.search') }}">
    <div class="input-group mb-3">
        <input type="text" class="form-control" name="query" placeholder="Buscar notícias" aria-label="Buscar notícias" aria-describedby="button-addon2">
        <button class="btn btn-outline-secondary" type="submit" id="button-addon2">
            <i class="fa-solid fa-magnifying-glass"></i>
            Buscar
        </button>
    </div>
</form>
