<header class="navbar-expand-md">
    <div class="collapse navbar-collapse" id="navbar-menu">
        <div class="navbar navbar-light">
            <div class="container-xl">
                <ul class="navbar-nav">
                    <li class="nav-item {{ Request::routeIs('dashboard', 'school.dashboard') ? 'active' : '' }}">
                        <a class="nav-link"
                            @if (auth()->user()->role_id === 1) href="{{ route('dashboard') }}"
                            @else href="{{ route('school.dashboard') }}" @endif>
                            <span class="nav-link-title">
                                Beranda
                            </span>
                        </a>
                    </li>
                    @if (auth()->user()->role_id === 1)
                        <li class="nav-item {{ Request::routeIs('users.*') ? 'active' : '' }} dropdown">
                            <a class="nav-link dropdown-toggle" href="#navbar-help" data-bs-toggle="dropdown"
                                data-bs-auto-close="outside" role="button" aria-expanded="false">
                                <span class="nav-link-title">
                                    Data Sekolah
                                </span>
                            </a>
                            <div class="dropdown-menu">
                                <a class="dropdown-item {{ Request::routeIs('users.students.index') ? 'active' : '' }}"
                                    href="{{ route('users.students.index') }}">
                                    Siswa
                                </a>
                                <a class="dropdown-item {{ Request::routeIs('users.teachers.index') ? 'active' : '' }}"
                                    href="{{ route('users.teachers.index') }}">
                                    Tenaga Didik
                                </a>
                            </div>
                        </li>
                        <li class="nav-item {{ Request::routeIs('categories.*') ? 'active' : '' }} dropdown">
                            <a class="nav-link dropdown-toggle" href="#navbar-help" data-bs-toggle="dropdown"
                                data-bs-auto-close="outside" role="button" aria-expanded="false">
                                <span class="nav-link-title">
                                    Data Master
                                </span>
                            </a>
                            <div class="dropdown-menu">
                                <a class="dropdown-item {{ Request::routeIs('categories.lesson.index') ? 'active' : '' }}"
                                    href="{{ route('categories.lesson.index') }}">
                                    Kategori Pelajaran
                                </a>
                            </div>
                        </li>
                    @endif
                </ul>
            </div>
        </div>
    </div>
</header>
