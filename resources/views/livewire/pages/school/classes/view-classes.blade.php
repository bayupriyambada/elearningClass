@section('pageTitle', $classes->name)
<div>
    <div class="container-xl">
        <div class="row g-2 align-items-center mt-2">
            <div class="col">
                <!-- Page pre-title -->
                <div class="page-pretitle">
                    Dibuat oleh: <b>{{ $classes->user->username }}</b>
                </div>
                <h2 class="page-title">
                    {{ $classes->name }}
                </h2>

            </div>
            <!-- Page title actions -->
            <div class="col-auto ms-auto d-print-none">
                <div class="btn-list">
                    <span class="d-none d-sm-inline">
                        <a href="{{ route('school.dashboard') }}" class="btn">
                            Kembali
                        </a>
                    </span>
                    <span class="d-none d-sm-inline">
                        <a href="{{ route('school.classes.materials.index', [$classes->id]) }}"
                            class="btn btn-primary">
                            Materi
                        </a>
                    </span>
                    <span class="d-none d-sm-inline">
                        <a href="{{ route('school.classes.assignments.index',[$classes->id]) }}" class="btn btn-info">
                            Tugas
                        </a>
                    </span>
                </div>
            </div>
        </div>
        <div class="row row-cards mt-3">

            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Kamu sudah bergabung, klik tombol untuk absensi hari ini ya <b>{{auth()->user()->username}} 🙌</b> </h3>
                        <div class="card-actions btn-actions">
                            <a href="#"  wire:click.prevent="submitAttendances({{json_encode($classes->id)}})" class="btn {{ $completedAbsensi ? 'btn-ghost-dark disabled' : 'btn-red' }}">
                                {{$completedAbsensi === 0 ? "Yuk Absensi" : "Sudah Absensi"}}
                                {{-- {{$labelAbsen}} --}}
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
