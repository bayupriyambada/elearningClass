@section('pageTitle', 'Dasbor ' .auth()->user()->username)

<div>
    <div class="container-xl">
        <div class="row g-2 align-items-center mt-2">
            <div class="col">
                <!-- Page pre-title -->
                <h2 class="page-title">
                    Dasbor {{auth()->user()->username}}
                </h2>
            </div>
            <!-- Page title actions -->
            <div class="col-auto ms-auto d-print-none">
                <div class="btn-list">
                    @if (auth()->user()->role_id != 3 && auth()->user()->role_id !== 1)
                    <span class="d-none d-sm-inline">
                        <a href="{{ route('school.classes.list') }}" class="btn btn-yellow">
                            Semua Kelas {{auth()->user()->name}}
                        </a>
                    </span>
                    <span class="d-none d-sm-inline">
                        <a href="{{ route('school.classes.create') }}" class="btn">
                            Buat Kelas
                        </a>
                    </span>
                    @endif
                    <a href="{{ route('school.classes.join') }}" class="btn btn-primary d-none d-sm-inline-block">
                        <!-- Download SVG icon from http://tabler-icons.io/i/plus -->
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                            viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                            stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                            <path d="M12 5l0 14"></path>
                            <path d="M5 12l14 0"></path>
                        </svg>
                        Gabung Kelas
                    </a>
                    <a href="#" class="btn btn-primary d-sm-none btn-icon" data-bs-toggle="modal"
                        data-bs-target="#modal-report" aria-label="Create new report">
                        <!-- Download SVG icon from http://tabler-icons.io/i/plus -->
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                            viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                            stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                            <path d="M12 5l0 14"></path>
                            <path d="M5 12l14 0"></path>
                        </svg>
                    </a>
                </div>
            </div>
        </div>

        {{-- card --}}
        <div class="row row-cards mt-3">
            @foreach ($classes as $class)
            <div class="col-md-6 col-lg-3">
                <div class="card">
                    <div class="card-body p-4 text-center">
                        <span class="avatar avatar-xl mb-3 rounded"
                            style="background-image: url('https://ui-avatars.com/api/?name={{ $class->name }}')"></span>
                        <h3 class="m-0 mb-1"><a href="#">{{$class->name}}</a></h3>
                        <div class="text-muted">Kode: <b class="text-danger">{{$class->code}}</b></div>
                        <div class="mt-3">
                            <span class="badge bg-green-lt">{{$class->user->username}}</span>
                        </div>
                    </div>
                    <div class="d-flex">
                        <a href="#" class="card-btn">
                            {{$class->materials_count}} Materi
                        </a>
                        <a href="#" class="card-btn">
                            {{$class->assignments_count}} Tugas
                        </a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
