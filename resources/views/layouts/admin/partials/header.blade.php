<div class="header d-flex justify-content-between align-items-center">
    <button id="toggleSidebar" class="btn btn-outline-secondary btn-sm">☰</button>

    <div class="dropdown">
        <button class="btn btn-light dropdown-toggle" type="button" id="userMenu" data-bs-toggle="dropdown" aria-expanded="false">
            {{ Auth::user()->name ?? 'Admin' }}
        </button>
        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userMenu">
            <li><a class="dropdown-item" href="{{ route('admin.profile') }}">My Profile</a></li>
            <li><a class="dropdown-item" href="{{ route('admin.changePassword') }}">Change Password</a></li>
            <li><a class="dropdown-item" href="{{ route('admin.settings') }}">Settings</a></li>
            <li><a class="dropdown-item" href="{{ url('/') }}" target="_blank">Visit Site</a></li>
            <li><hr class="dropdown-divider"></li>
            <li>
                <form id="logoutForm" action="{{ route('logout') }}" method="POST" onsubmit="return confirmLogout()">
                    @csrf
                    <button type="submit" class="dropdown-item text-danger">Logout</button>
                </form>
            </li>
        </ul>

    </div>
</div>
