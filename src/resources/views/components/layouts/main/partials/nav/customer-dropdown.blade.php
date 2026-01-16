<div class="dropdown d-inline-flex justify-content-evenly">
    <button class="btn btn-white dropdown-toggle border-0" type="button" data-bs-toggle="dropdown" aria-expanded="false">
        <i class="text-secondary fa-solid fa-user"></i>
    </button>

    <ul class="dropdown-menu dropdown-menu-right">
        <li><a class="dropdown-item" href="{{ route('customer.profile') }}"><i class="text-secondary fa-solid fa-user"></i> Profile</a></li>
        <li><a class="dropdown-item" href="{{ route('company') }}"><i class="text-secondary fa-solid fa-building"></i> Company</a></li>
        <li><a class="dropdown-item" href="{{ route('messages') }}"><i class="text-secondary fa-solid fa-envelope"></i> Messages</a></li>
        <li><a class="dropdown-item" href="{{ route('notifications') }}"><i class="text-secondary fa-solid fa-bell"></i> Notifications</a></li>
        <li><a class="dropdown-item border-top pt-2 mt-2 text-danger"
                href="{{ route('logout') }}"
                onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                <i class="fa-solid fa-right-from-bracket"></i> Logout
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">@csrf</form>
        </li>
    </ul>
</div>