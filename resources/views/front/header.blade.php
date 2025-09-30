<nav class="navbar navbar-expand-lg shadow-sm" style="background: linear-gradient(90deg, #4b6cb7, #182848);">
    <div class="container-fluid">
        <!-- Brand -->
        <a class="navbar-brand text-white fs-4 fw-bold text-uppercase ajax-link" href="{{ url('/') }}">
            {{ config('app.name', 'TravelMS') }}
        </a>

        <!-- Toggler for mobile -->
        <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent"
                aria-controls="navbarContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
            <span class="navbar-toggler-icon text-white"></span>
        </button>

        <!-- Navbar links -->
        <div class="collapse navbar-collapse" id="navbarContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">

                <!-- Main Links -->
                <li class="nav-item">
                    <a class="nav-link ajax-link text-white fw-medium px-3 text-uppercase" href="{{ url('/about') }}">About</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link ajax-link text-white fw-medium px-3 text-uppercase" href="{{ url('/services') }}">Services</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link ajax-link text-white fw-medium px-3 text-uppercase" href="{{ url('/contact') }}">Contact</a>
                </li>

                <!-- Packages Dropdown -->
                <li class="nav-item dropdown">
                    <a class="nav-link ajax-link dropdown-toggle text-white fw-medium px-3 text-uppercase" href="#" id="packagesDropdown"
                       role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Packages
                    </a>
                    <ul class="dropdown-menu shadow-lg border-0 rounded-3" aria-labelledby="packagesDropdown">
                        <li><a class="dropdown-item" href="{{ url('/packages/domestic') }}">Domestic</a></li>
                        <li><a class="dropdown-item" href="{{ url('/packages/international') }}">International</a></li>
                        <li><a class="dropdown-item" href="{{ url('/packages/custom') }}">Custom Packages</a></li>
                    </ul>
                </li>

                <!-- Policies Dropdown -->
                <li class="nav-item dropdown">
                    <a class="nav-link ajax-link dropdown-toggle text-white fw-medium px-3 text-uppercase" href="#" id="policiesDropdown"
                       role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Policies
                    </a>
                    <ul class="dropdown-menu shadow-lg border-0 rounded-3" aria-labelledby="policiesDropdown">
                        <li><a class="dropdown-item" href="{{ url('/terms') }}">Terms & Conditions</a></li>
                        <li><a class="dropdown-item" href="{{ url('/privacy') }}">Privacy Policy</a></li>
                        <li><a class="dropdown-item" href="{{ url('/cancellation') }}">Cancellation Policy</a></li>
                        <li><a class="dropdown-item" href="{{ url('/operations') }}">Operations</a></li>
                    </ul>
                </li>

                <!-- Join Us -->
                <li class="nav-item dropdown">
                    <a class="nav-link ajax-link dropdown-toggle text-white fw-medium px-3 text-uppercase" href="#" id="joinDropdown"
                       role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Join Us
                    </a>
                    <ul class="dropdown-menu shadow-lg border-0 rounded-3" aria-labelledby="joinDropdown">
                        <li><a class="dropdown-item" href="{{ route('register') }}">Become Partner</a></li>
                        <li><a class="dropdown-item" href="{{ route('register') }}">Become Supplier</a></li>
                    </ul>
                </li>
            </ul>

            <!-- Right Side: Auth -->
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                @guest
                    @if (Route::has('login'))
                        <li class="nav-item">
                            <a class="btn btn-outline-light rounded-pill px-4 me-2 fw-bold" href="{{ route('login') }}">Login</a>
                        </li>
                    @endif
                    @if (Route::has('register'))
                        <li class="nav-item">
                            <a class="btn btn-light rounded-pill px-4 fw-bold" href="{{ route('register') }}">Register</a>
                        </li>
                    @endif
                @else
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link ajax-link dropdown-toggle text-white fw-medium" href="#" role="button"
                           data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            {{ Auth::user()->name }}
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end shadow-lg border-0 rounded-3" aria-labelledby="navbarDropdown">
                            <li>
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                   onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    Logout
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </li>
                        </ul>
                    </li>
                @endguest
            </ul>
        </div>
    </div>
</nav>
