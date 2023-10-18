<nav class="navbar navbar-vertical fixed-left navbar-expand-md navbar-light bg-white" id="sidenav-main">
    <div class="container-fluid">
        <!-- Toggler -->
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#sidenav-collapse-main"
            aria-controls="sidenav-main" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <!-- Brand -->
        <a class="navbar-brand pt-0" href="{{ route('home') }}">
            <img src="{{ asset('argon') }}/img/brand/blue.png" class="navbar-brand-img" alt="...">
        </a>
        <!-- User -->
        <ul class="nav align-items-center d-md-none">
            <li class="nav-item dropdown">
                <a class="nav-link" href="#" role="button" data-toggle="dropdown" aria-haspopup="true"
                    aria-expanded="false">
                    <div class="media align-items-center">
                        <span class="avatar avatar-sm rounded-circle">
                            <img alt="Image placeholder" src="{{ asset('argon') }}/img/theme/team-1-800x800.jpg">
                        </span>
                    </div>
                </a>
                <div class="dropdown-menu dropdown-menu-arrow dropdown-menu-right">
                    <div class=" dropdown-header noti-title">
                        <h6 class="text-overflow m-0">{{ __('Welcome!') }}</h6>
                    </div>
                    <a href="{{ route('profile.edit') }}" class="dropdown-item">
                        <i class="ni ni-single-02"></i>
                        <span>{{ __('My profile') }}</span>
                    </a>
                    <a href="#" class="dropdown-item">
                        <i class="ni ni-settings-gear-65"></i>
                        <span>{{ __('Settings') }}</span>
                    </a>
                    <a href="#" class="dropdown-item">
                        <i class="ni ni-calendar-grid-58"></i>
                        <span>{{ __('Activity') }}</span>
                    </a>
                    <a href="#" class="dropdown-item">
                        <i class="ni ni-support-16"></i>
                        <span>{{ __('Support') }}</span>
                    </a>
                    <div class="dropdown-divider"></div>
                    <a href="{{ route('logout') }}" class="dropdown-item"
                        onclick="event.preventDefault();
                    document.getElementById('logout-form').submit();">
                        <i class="ni ni-user-run"></i>
                        <span>{{ __('Logout') }}</span>
                    </a>
                </div>
            </li>
        </ul>
        <!-- Collapse -->
        <div class="collapse navbar-collapse" id="sidenav-collapse-main">
            <!-- Collapse header -->
            <div class="navbar-collapse-header d-md-none">
                <div class="row">
                    <div class="col-6 collapse-brand">
                        <a href="{{ route('home') }}">
                            <img src="{{ asset('argon') }}/img/brand/blue.png">
                        </a>
                    </div>
                    <div class="col-6 collapse-close">
                        <button type="button" class="navbar-toggler" data-toggle="collapse"
                            data-target="#sidenav-collapse-main" aria-controls="sidenav-main" aria-expanded="false"
                            aria-label="Toggle sidenav">
                            <span></span>
                            <span></span>
                        </button>
                    </div>
                </div>
            </div>
            <!-- Form -->
            <form class="mt-4 mb-3 d-md-none">
                <div class="input-group input-group-rounded input-group-merge">
                    <input type="search" class="form-control form-control-rounded form-control-prepended"
                        placeholder="{{ __('Search') }}" aria-label="Search">
                    <div class="input-group-prepend">
                        <div class="input-group-text">
                            <span class="fa fa-search"></span>
                        </div>
                    </div>
                </div>
            </form>
            <!-- Navigation -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link active" href="#navbar-data" data-toggle="collapse" role="button"
                        aria-expanded="true" aria-controls="navbar-data">
                        <i class="ni ni-tv-2 text-primary"></i>
                        <span class="nav-link-text ">{{ __('Dashboard') }}</span>
                    </a>
                    <div class="collapse hidden" id="navbar-data">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a class="nav-link " href="{{ route('indoor.index') }}">
                                    <i class="fas fa-hospital text-blue"></i> {{ __('INDOOR') }}
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('outdoor.index') }}">
                                    <i class="fa fa-route text-navy"></i> {{ __('OUTDOOR') }}
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                @admin
                    <li class="nav-item ">
                        <a class="nav-link" href="{{ route('user.index') }}">
                            <i class="ni ni-badge text-blue"></i> {{ __('User') }}
                        </a>
                    </li>

                    <li class="nav-item ">
                        <a class="nav-link" href="{{ route('teknisi.index') }}">
                            <i class="ni ni-single-02 text-green"></i> {{ __('Teknisi') }}
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('area.index') }}">
                            <i class="ni ni-square-pin text-red"></i> {{ __('Area') }}
                        </a>
                    </li>
                    <li class="nav-item ">
                        <a class="nav-link" href="{{ route('lokasi.index') }}">
                            <i class="ni ni-pin-3 text-orange"></i> {{ __('Lokasi') }}
                        </a>
                    </li>
                @endadmin
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('ac.index') }}">
                        <i class="bi bi-usb-mini-fill text-blue">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                fill="currentColor" class="bi bi-usb-mini-fill" viewBox="0 0 16 16">
                                <path
                                    d="M3 3a1 1 0 0 0-1 1v1.293L.293 7A1 1 0 0 0 0 7.707V12a1 1 0 0 0 1 1h14a1 1 0 0 0 1-1V7.707A1 1 0 0 0 15.707 7L14 5.293V4a1 1 0 0 0-1-1H3Zm.5 5h9a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-9a.5.5 0 0 1-.5-.5v-1a.5.5 0 0 1 .5-.5Z" />
                            </svg>
                        </i>
                        <span class="nav-link-text">AC</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('service.index') }}">
                        <i class="ni ni-settings text-yellow"></i> {{ __('Service AC') }}
                    </a>
                </li>
            </ul>

        </div>
    </div>
</nav>
