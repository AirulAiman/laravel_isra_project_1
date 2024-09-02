<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#nav" aria-controls="nav"
    aria-expanded="false">
</button>

@if (Request::is('admin/*') || Request::is('admin'))
    <div class="collapse navbar-collapse" id="nav">
        <ul class="navbar-nav">
            <li class="nav-item dropdown">
                <button class="btn dropdown-toggle no-caret" data-bs-toggle="dropdown" aria-expanded="false">
                    Organization
                </button>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="#">Organization List</a></li>
                </ul>
            </li>
            <li class="nav-item dropdown">
                <button class="btn dropdown-toggle no-caret" data-bs-toggle="dropdown" aria-expanded="false">
                    Project
                </button>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="/admin/projects">Project List</a></li>
                </ul>
            </li>
            <li class="nav-item dropdown">
                <button class="btn dropdown-toggle no-caret" data-bs-toggle="dropdown" aria-expanded="false">
                    Profile
                </button>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="#">Threat</a></li>
                    <li><a class="dropdown-item" href="#">Vulnerability</a></li>
                </ul>
            </li>
            <li class="nav-item dropdown">
                <button class="btn dropdown-toggle no-caret" data-bs-toggle="dropdown" aria-expanded="false">
                    Risk Management
                </button>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="#">Risk Assessment</a></li>
                    <li><a class="dropdown-item" href="#">Risk Treatment Plan</a></li>
                </ul>
            </li>
            <li class="nav-item dropdown">
                <button class="btn dropdown-toggle no-caret" data-bs-toggle="dropdown" aria-expanded="false">
                    User
                </button>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="#">User Listings</a></li>
                    <li><a class="dropdown-item" href="#">Status</a></li>
                </ul>
            </li>

        </ul>
    </div>
    <div class="d-flex">
        <div class="btn-group">
            <button type="button" class="btn btn-dark rounded-circle circle-btn" data-bs-toggle="dropdown"
                aria-expanded="false">
                <i class="fa-solid fa-shield-halved"></i>
            </button>
            <ul class="dropdown-menu dropdown-menu-end">
                <li><a class="dropdown-item" href="#">Profile</a></li>
                <li><a class="dropdown-item" href="#">Settings</a></li>
                <li>
                    <hr class="dropdown-divider">
                </li>
                <li>
                    <a class="dropdown-item">
                        <form id="logout" action="{{route('logout')}}" method="POST">
                            @csrf
                            <button type="submit">Logout</button>
                        </form>
                    </a>
                </li>
            </ul>
        </div>
    </div>
@elseif (Request::is('user/*') || Request::is('user'))
    <div class="collapse navbar-collapse" id="nav">
        <ul class="navbar-nav">
            <li class="nav-item dropdown">
                <button class="btn dropdown-toggle no-caret" data-bs-toggle="dropdown" aria-expanded="false">
                    Risk Management
                </button>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="#">Asset Register</a></li>
                    <li><a class="dropdown-item" href="#">Risk Assessment</a></li>
                    <li><a class="dropdown-item" href="#">Risk Treatment Plan</a></li>
                </ul>
            </li>
            <li class="nav-item dropdown">
                <button class="btn dropdown-toggle no-caret" data-bs-toggle="dropdown" aria-expanded="false">
                    Profile
                </button>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="#">Threat Profile</a></li>
                    <li><a class="dropdown-item" href="#">Vulnerabilities Profile</a></li>
                </ul>
            </li>
        </ul>
    </div>
    <div class="d-flex">
        <div class="btn-group">
            <button type="button" class="btn btn-dark rounded-circle circle-btn" data-bs-toggle="dropdown"
                aria-expanded="false">
                <i class="fa-solid fa-user"></i>
            </button>
            <ul class="dropdown-menu dropdown-menu-end">
                <li><a class="dropdown-item" href="#">Profile</a></li>
                <li><a class="dropdown-item" href="#">Settings</a></li>
                <li>
                    <hr class="dropdown-divider">
                </li>
                <li>
                    <a class="dropdown-item" href="/logout">
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button type="submit">Logout</button>
                        </form>
                    </a>
                </li>
            </ul>
        </div>
    </div>
@else
    @if (Request::is('/') || Request::is(''))
        <div class="d-flex">
            <button class="btn btn-dark" onclick="window.location.href='/login'">Login</button>
            <button class="btn btn-dark" onclick="window.location.href='/register'">register</button>
        </div>
    @elseif (Request::is('login'))
        <button class="btn btn-dark" onclick="window.location.href='/register'">register</button>
    @else
        <button class="btn btn-dark" onclick="window.location.href='/login'">Login</button>
    @endif
@endif

<style>
    .no-caret::after {
        display: none !important;
    }

    .circle-btn {
        width: 40px;
        height: 40px;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 0;
    }
</style>