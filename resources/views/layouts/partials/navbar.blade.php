<div class="sticky-top">
    <header class="navbar navbar-expand-md navbar-light d-print-none">
        <div class="container-xl">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbar-menu"
                aria-controls="navbar-menu" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <h1 class="navbar-brand navbar-brand-autodark d-none-navbar-horizontal pe-0 pe-md-3">
                <a href="#">
                    <span>CMS BELAJAR</span>
                </a>
            </h1>
            <div class="navbar-nav flex-row order-md-last">
                <div class="nav-item d-none d-md-flex me-3">
                </div>
                <div class="nav-item dropdown">
                    <a href="#" class="nav-link d-flex lh-1 text-reset p-0" data-bs-toggle="dropdown"
                        aria-label="Open user menu">
                        <span class="avatar avatar-sm"
                            style="background-image: url('https://ui-avatars.com/api/?name={{ auth()->user()->username }}')"></span>
                        <div class="d-none d-xl-block ps-2">
                            <div class="font-bold">{{ auth()->user()->username }}</div>
                        </div>
                    </a>
                    <div class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                        <a href="{{ route('profile') }}" class="dropdown-item">Profile</a>
                        <div class="dropdown-divider"></div>
                        @livewire('auth.logout-component')
                    </div>
                </div>
            </div>
        </div>
    </header>
    @include('layouts.partials.menu')
</div>
