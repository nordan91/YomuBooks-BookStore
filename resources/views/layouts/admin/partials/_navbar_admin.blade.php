<nav class="navbar p-0 fixed-top d-flex flex-row">
    <div class="navbar-menu-wrapper d-flex align-items-center justify-content-between w-100">
        <div class="d-flex align-items-center">
            <button class="navbar-toggler navbar-toggler align-self-center text-dark" type="button" data-toggle="minimize">
                <span class="mdi mdi-menu"></span>
            </button>
            <div class="navbar-brand-wrapper ms-3">
                @if(file_exists(public_path('assets/images/icon.png')))
                    <img src="{{ asset('assets/images/icon.png') }}" alt="YomuBooks" style="height: 124px; width: auto;">
                @else
                    <span style="font-weight: 700; font-size: 1.1rem; color: var(--primary-color);">YomuBooks</span>
                @endif
            </div>
        </div>
        <div class="d-flex align-items-center ms-auto">
            <ul class="navbar-nav navbar-nav-right d-flex flex-row align-items-center mb-0">
                <li class="nav-item nav-profile dropdown position-relative">
                    <a class="nav-link dropdown-toggle d-flex align-items-center px-2" href="#" data-bs-toggle="dropdown" id="profileDropdown" aria-expanded="false">
                        @if(Auth::check() && Auth::user()->profile_photo_path)
                            <img src="{{ asset('storage/' . Auth::user()->profile_photo_path) }}" alt="{{ Auth::user()->name }}" class="rounded-circle me-2">
                        @else
                            <div class="default-profile-icon me-2">
                                <i class="mdi mdi-account-circle"></i>
                            </div>
                        @endif
                        <span class="nav-profile-name">
                            {{ Auth::check() ? Auth::user()->name : 'Guest' }}
                        </span>
                        <i class="mdi mdi-chevron-down ms-1"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-end navbar-dropdown" aria-labelledby="profileDropdown">
                        <div class="dropdown-header text-center border-bottom pb-3 mb-2">
                            <div class="mb-2">
                                @if(Auth::check() && Auth::user()->profile_photo_path)
                                    <img src="{{ asset('storage/' . Auth::user()->profile_photo_path) }}" alt="{{ Auth::user()->name }}" class="rounded-circle" style="width: 60px; height: 60px;">
                                @else
                                    <div class="default-profile-icon mx-auto" style="width: 60px; height: 60px;">
                                        <i class="mdi mdi-account-circle" style="font-size: 3rem;"></i>
                                    </div>
                                @endif
                            </div>
                            <h6 class="mb-0">{{ Auth::check() ? Auth::user()->name : 'Guest' }}</h6>
                            <small class="text-muted">{{ Auth::check() ? Auth::user()->email : '' }}</small>
                        </div>
                        <a class="dropdown-item" href="#">
                            <i class="mdi mdi-account-circle text-primary"></i> Profile
                        </a>
                        <a class="dropdown-item" href="#">
                            <i class="mdi mdi-cog text-primary"></i> Settings
                        </a>
                        <div class="dropdown-divider"></div>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="dropdown-item">
                                <i class="mdi mdi-logout text-danger"></i> Logout
                            </button>
                        </form>
                    </div>
                </li>
            </ul>
            <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center ms-2" type="button"
            data-toggle="offcanvas">
                <span class="mdi mdi-menu"></span>
            </button>
        </div>
    </div>
</nav>
