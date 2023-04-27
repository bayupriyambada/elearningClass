@section('pageTitle', 'Dasbor ' . auth()->user()->username)

<div>
    <div class="container-xl">
        <div class="row g-2 align-items-center mt-2">
            <div class="col">
                <h2 class="page-title">
                    Dasbor Anda
                </h2>
            </div>
            <!-- Page title actions -->
            <div class="col-auto ms-auto d-print-none">
                <div class="btn-list">
                    @if (auth()->user()->role_id != 3 && auth()->user()->role_id !== 1)
                        <span class="d-none d-sm-inline">
                            <x-href colorButton="btn btn-success" url="{{ route('school.classes.create') }}"
                                title="Buat kelas anda" />
                        </span>
                        <span class="d-none d-sm-inline">
                            <x-href colorButton="btn btn-yellow" url="{{ route('school.classes.list') }}"
                                title="Semua kelas anda" />
                        </span>
                    @endif
                    <x-href colorButton="btn btn-primary" url="{{ route('school.classes.join') }}"
                        title="Gabung Kelas" />
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
                            <h3 class="m-0 mb-1"><a href="#">{{ $class->name }}</a></h3>
                            <div class="text-muted">Kode: <b class="text-danger">{{ $class->code }}</b></div>
                            <div class="mt-3">
                                <span class="badge bg-green-lt">{{ $class->user->username }}</span>
                            </div>
                        </div>
                        <div class="d-flex">
                            <x-href colorButton="card-btn" url="#"
                                title="{{ $class->materials_count }} Materi" />
                            <x-href colorButton="card-btn" url="#"
                                title="{{ $class->assignments_count }} Tugas" />
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
