<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#nav" aria-controls="nav"
    aria-expanded="false">
</button>

@if (Request::is('admin/*') || Request::is('admin'))
    {{-- ADMIN --}}
    <div class="collapse navbar-collapse" id="nav">
        <ul class="navbar-nav">
            <li class="nav-item dropdown">
                <button class="btn dropdown-toggle no-caret" data-bs-toggle="dropdown" aria-expanded="false">
                    Organization
                </button>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="/admin/test/organizations">Organization Listings</a></li>
                </ul>
            </li>
            <li class="nav-item dropdown">
                <button class="btn dropdown-toggle no-caret" data-bs-toggle="dropdown" aria-expanded="false">
                    Project
                </button>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="/admin/projects">Project Listings</a></li>
                </ul>
            </li>
            <li class="nav-item dropdown">
                <button class="btn dropdown-toggle no-caret" data-bs-toggle="dropdown" aria-expanded="false">
                    Profile
                </button>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="/admin/profile/threats/view">Threat Profile</a></li>
                    <li><a class="dropdown-item" href="/admin/profile/vulnerabilities/view">Vulnerability Profile</a></li>
                    <li><a class="dropdown-item" href="/user/profile/process/index">Process Profile</a></li>
                </ul>
            </li>
            <li class="nav-item dropdown">
                <button class="btn dropdown-toggle no-caret" data-bs-toggle="dropdown" aria-expanded="false">
                    Risk Management
                </button>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="/risk_assessments">Risk Assessment</a></li>
                    <li><a class="dropdown-item" href="/admin/rtp">Risk Treatment Plan</a></li>
                    <li><a class="dropdown-item" href="/user/asset_register">Asset Register</a></li>
                </ul>
            </li>
            <li class="nav-item dropdown">
                <button class="btn dropdown-toggle no-caret" data-bs-toggle="dropdown" aria-expanded="false">
                    User Management
                </button>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="/admin/user-management/">User Listings</a></li>
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
                <li><a class="dropdown-item" href="/profile/show">Profile</a></li>
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
    {{-- USER --}}
    <div class="collapse navbar-collapse" id="nav">
        <ul class="navbar-nav">
            <li class="nav-item dropdown">
                <button class="btn dropdown-toggle no-caret" data-bs-toggle="dropdown" aria-expanded="false">
                    Risk Management
                </button>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="/user/asset_register">Asset Register</a></li>
                    <li><a class="dropdown-item" href="/user/risk_assessments">Risk Assessment</a></li>
                    <li><a class="dropdown-item" href="/admin/rtp">Risk Treatment Plan</a></li>
                </ul>
            </li>
            <li class="nav-item dropdown">
                <button class="btn dropdown-toggle no-caret" data-bs-toggle="dropdown" aria-expanded="false">
                    Profile
                </button>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="/user/profile/threats">Threat Profile</a></li>
                    <li><a class="dropdown-item" href="/user/profile/Vulnerability">Vulnerabilities Profile</a></li>
                    <li><a class="dropdown-item" href="/user/profile/processes">Process Profile</a></li>
                    <li><a class="dropdown-item" href="/user/profile/controls-management">Control Profile</a></li>

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
        {{-- PUBLIC --}}
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
