<div class="dropdown">
    <button class="btn btn-white border-0 dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
        <i class="text-secondary fa-solid fa-bell"></i>
        @if($count>0)
        <span class="position-absolute badge rounded-pill bg-danger">
            {{ $count }}
        </span>
        @endif
    </button>

    <ul class="dropdown-menu dropdown-menu-left">
        @if($count>0)
            @foreach($notifications as $notification)
            <li>
                <a class="dropdown-item" href="#">
                    <i class="text-{{ $notification->type->title }} fa-solid fa-bell"></i>
                    {{ $notification->content }}
                </a>
            </li>
            @endforeach
            <li><div class="dropdown-divider"></div></li>
        @endif
        <li><a class="dropdown-item" href="{{ route('notifications') }}">Ver todas as notificações</a></li>
    </ul>
</div>