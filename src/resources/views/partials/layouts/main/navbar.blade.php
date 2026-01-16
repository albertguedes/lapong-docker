<div class="container" >

    <a class="navbar-brand" href="{{ route('dashboard') }}">
        <img id="logo" class="img-fluid" src="{{ asset('assets/images/bitmap.svg') }}"  alt="Logo | Torna Fácil" >
    </a>

    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainmenu" aria-controls="mainmenu" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div id="mainmenu" class="collapse navbar-collapse" >

        <ul class="navbar-nav me-auto">
            <li class="nav-item active">
                <a class="nav-link {{ request()->routeIs('dashboard') ? 'active' : 'text-secondary' }} pe-3" href="{{ route('dashboard') }}">
                    <i class="fa-solid fa-gauge me-2"></i>
                    Dashboard
                </a>
            </li>
            <li class="nav-item active">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fa-solid fa-calendar me-2"></i>
                        Agenda
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <li>
                            <a class="dropdown-item  {{ request()->routeIs('scheduler.calendar') ? 'active' : '' }}" href="{{ route('scheduler.calendar') }}">
                                <i class="fa-solid fa-calendar-days me-2"></i>
                                Calendário
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item  {{ request()->routeIs('scheduler.events') ? 'active' : '' }}" href="{{ route('scheduler.events') }}">
                                <i class="fa-solid fa-calendar-day me-2"></i>
                                Eventos
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item  {{ request()->routeIs('scheduler.contacts') ? 'active' : '' }}" href="{{ route('scheduler.contacts') }}">
                                <i class="fa-solid fa-address-card me-2"></i>
                                Contatos
                            </a>
                        </li>
                    </ul>
                </li>
            </li>

            <li class="nav-item active">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fa-solid fa-laptop-medical me-2"></i>
                        Área Médica
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <li>
                            <a class="dropdown-item  {{ request()->routeIs('medical.cases') ? 'active' : '' }}" href="{{ route('medical.cases') }}">
                                <i class="fa-solid fa-file-medical me-2"></i>
                                Prontuário
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item  {{ request()->routeIs('medical.professional') ? 'active' : '' }}" href="{{ route('medical.professional') }}">
                                <i class="fa-solid fa-user-doctor me-2"></i>
                                Buscar Profissionais
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item  {{ request()->routeIs('medical.consult') ? 'active' : '' }}" href="{{ route('medical.consult') }}">
                                <i class="fa-solid fa-note-sticky me-2"></i>
                                Marcar Consultas
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item  {{ request()->routeIs('medical.consult') ? 'active' : '' }}" href="{{ route('medical.consult') }}">
                                <i class="fa-solid fa-microscope me-2"></i>
                                Marcar Exames
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item  {{ request()->routeIs('medical.consult') ? 'active' : '' }}" href="{{ route('medical.consult') }}">
                                <i class="fa-solid fa-note-sticky me-2"></i>
                                Fármacia
                            </a>
                        </li>
                    </ul>
                </li>
            </li>

            <li class="nav-item active">
                <a class="nav-link {{ request()->routeIs('news') ? 'active' : '' }}" href="{{ route('news') }}" >
                    <i class="fa-solid fa-newspaper me-2"></i> News
                </a>
            </li>
        </ul>

        <ul class="navbar-nav ms-auto">
            <li class="nav-item pe-3" >
                <x-layouts.main.partials.nav.notifications-alert ></x-layouts.main.partials.nav.notifications-alert>
            </li>
            <li class="nav-item pe-3" >
                <x-layouts.main.partials.nav.messages-alert ></x-layouts.main.partials.nav.messages-alert>
            </li>
            <li class="nav-item" >
                <x-layouts.main.partials.nav.customer-dropdown ></x-layouts.main.partials.nav.customer-dropdown>
            </li>
        </ul>
    </div>
</div>
