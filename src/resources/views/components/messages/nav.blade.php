<div class="row mt-3 mb-4 px-3" >
    <div class="col-12 border-bottom p-0">
        <ul id="scheduler-nav" class="nav float-start" >
            <li class="nav-item" >
                <a class="nav-link {{ request()->routeIs('messages') ? 'active' : 'secondary' }}"
                    href="{{ route('messages') }}"
                >
                    <i class="fa-solid fa-inbox mr-2"></i> Inbox
                </a>
            </li>
            <li class="nav-item" >
                <a class="nav-link {{ request()->routeIs('messages.sent') ? 'active' : 'secondary' }}"
                    href="{{ route('messages.sent') }}"
                >
                    <i class="fa-solid fa-paper-plane mr-2"></i> Sent
                </a>
            </li>
            <li class="nav-item" >
                <a class="nav-link {{ request()->routeIs('messages.saved') ? 'active' : 'pill-success' }}"
                    href="{{ route('messages.saved') }}"
                >
                    <i class="fa-solid fa-bookmark mr-2"></i> Saved
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-danger {{ request()->routeIs('messages.trash') ? 'text-danger border-bottom border-3 border-danger' : 'secondary' }}"
                    href="{{ route('messages.trash') }}"
                >
                    <i class="fa-solid fa-trash mr-2"></i> Trash
                </a>
            </li>
        </ul>

        <ul class="nav float-end" >
            <li class="nav-item" >
                <a class="btn btn-sm btn-success"
                    href="{{ route('message.create') }}"
                >
                    <i class="fa-solid fa-feather mr-2"></i> Compose
                </a>
            </li>
        </ul>

    </div>
</div>
