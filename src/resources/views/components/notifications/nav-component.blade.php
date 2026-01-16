<div class="row mt-3 mb-4 px-3" >
    <div class="col-12 border-bottom p-0">
        <ul id="notification-nav" class="nav" >
            @foreach($items as $item)
            <li class="nav-item" >
                <a class="nav-link {{ $item['class'] }}" href="{{ $item['href'] }}" >
                    <i class="fa-solid fa-bell me-2"></i>
                    {{ $item['label'] }}
                </a>
            </li>
            @endforeach
        </ul>
    </div>
</div>