<div class="dropdown">

    <button class="btn btn-white border-0 dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
        <i class="text-secondary fa-solid fa-envelope"></i>
        @if($count>0)
        <span class="position-absolute badge rounded-pill bg-danger">
            {{ $count }}
        </span>
        @endif
    </button>

    <ul class="dropdown-menu dropdown-menu-right">
        @if($count>0)
            @foreach($messages as $message)
            <li>
                <a class="dropdown-item" href="{{ route('message', $message) }}">
                    <i class="text-primary fa-solid fa-envelope"></i>
                    {{ Str::limit($message->subject, 24) }}
                </a>
            </li>
            @endforeach
            <li><div class="dropdown-divider"></div></li>
        @endif
        <li><a class="dropdown-item" href="{{ route('messages') }}">Ver todas as mensagens</a></li>
    </ul>

</div>