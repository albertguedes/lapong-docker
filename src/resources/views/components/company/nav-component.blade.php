<div class="row mb-4 px-3" >
    <div class="col-12 border-bottom p-0">
        <ul id="scheduler-nav" class="nav" >
            <li class="nav-item" >
                <a class="nav-link fw-bold py-3 {{ request()->routeIs('company') ? 'active' : 'text-dark' }}"
                    href="{{ route('company') }}"
                >
                    <i class="fa-solid fa-info me-2"></i>
                    Info
                </a>
            </li>
            <li class="nav-item" >
                <a class="nav-link fw-bold py-3 {{ request()->routeIs('company.employers') ? 'active' : 'text-dark' }}"
                    href="{{ route('company.employers') }}"
                >
                    <i class="fa-solid fa-users me-2"></i>
                    Employers
                </a>
            </li>
            <li class="nav-item" >
                <a class="nav-link fw-bold py-3 {{ request()->routeIs('company.clients') ? 'active' : 'text-dark' }}"
                    href="{{ route('company.clients') }}"
                >
                    <i class="fa-solid fa-user-injured me-2"></i>
                    Patients
                </a>
            </li>
        </ul>
    </div>
</div>