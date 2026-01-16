<div class="row mt-3 mb-4 px-3" >
    <div class="col-12 border-bottom p-0">
        <ul id="scheduler-nav" class="nav" >
            <li class="nav-item" >
                <a class="nav-link fw-bold py-3 {{ request()->routeIs('scheduler.calendar') ? 'active' : 'text-dark' }}"
                    href="{{ route('scheduler.calendar') }}"
                >
                    <i class="fa-solid fa-calendar-days me-2"></i>
                    Calendário
                </a>
            </li>
            <li class="nav-item" >
                <a class="nav-link fw-bold py-3 {{ request()->routeIs('scheduler.events') ? 'active' : 'text-dark' }}"
                    href="{{ route('scheduler.events') }}"
                >
                    <i class="fa-solid fa-calendar-day"></i>
                    Eventos
                </a>
            </li>
            <li class="nav-item" >
                <a class="nav-link fw-bold py-3 {{ request()->routeIs('scheduler.contacts') ? 'active' : 'text-dark' }}"
                    href="{{ route('scheduler.contacts') }}"
                >
                    <i class="fa-solid fa-address-card me-2"></i>
                    Contatos
                </a>
            </li>
        </ul>
    </div>
</div>