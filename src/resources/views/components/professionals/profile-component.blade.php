<div class="row">
    <div class="col-12 pb-3" >

        <div class="card bg-transparent" >
            <div class="card-body">
                <h1 class="fw-bold mb-3" >
                    <i class="fa fa-user-doctor"></i>
                    {{ $professional['name'] }}
                </h1>
                <h2 class="h6 text-muted">
                    <i class="fa fa-building"></i>
                    {{ $professional['company'] }}
                </h2>
            </div>
        </div>

        <div class="card" >
            <div class="card-body">

                @if ($professional['is_contact'])
                <a href="{{ route('scheduler.contacts', ['contact_id' => $professional['id']]) }}" class="btn btn-primary" >
                    <i class="fa-solid fa-address-book mr-2"></i>
                    Contato
                </a>
                @else
                <a href="#" class="btn btn-success" >
                    <i class="fa-solid fa-address-book mr-2"></i>
                    Adicionar Contato
                </a>
                @endif

                <a href="{{ route('message.create', ['receiver_id' => $professional['id']]) }}" class="btn btn-primary" >
                    <i class="fa-solid fa-envelope mr-2"></i>
                    Send Message
                </a>

                <a href="{{ route('news', ['author_id' => $professional['id']]) }}" class="btn btn-success" >
                    <i class="fa-solid fa-newspaper mr-2"></i>
                    News
                </a>
            </div>
        </div>

    </div>

</div>
