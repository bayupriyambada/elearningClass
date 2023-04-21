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
                        <x-href colorButton="btn" url="{{ route('school.dashboard') }}" title="Kembali" />
                    </span>
                    <span class="d-none d-sm-inline">
                        <x-href colorButton="btn btn-primary"
                            url="{{ route('school.classes.materials.index', [$classes->id]) }}" title="Materi" />
                    </span>
                    <span class="d-none d-sm-inline">
                        <x-href colorButton="btn btn-info"
                            url="{{ route('school.classes.assignments.index', [$classes->id]) }}" title="Tugas" />
                    </span>
                </div>
            </div>
        </div>
        <div class="row row-cards mt-2">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Anda {{ $completedAbsensi ? 'sudah' : 'belum' }} melakukan absensi hari
                            ini <b>{{ auth()->user()->username }} 🙌</b> </h3>
                        <div class="card-actions btn-actions">
                            <a href="#" wire:click.prevent="submitAttendances({{ json_encode($classes->id) }})"
                                class="btn {{ $completedAbsensi ? 'btn-ghost-dark disabled' : 'btn-red' }}">
                                {{ $completedAbsensi ? 'Telah absensi' : 'Belum absensi' }}
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row row-cards mt-2">
            <h2>Riwayat Absensi [{{ $reportAttendance->count() }}]</h2>
            @foreach ($reportAttendance as $index => $item)
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">{{ $index + 1 }}.
                                {{ $item->isAbsensi === 0 ? 'terlambat' : 'berhasil' }} absensi </h3>
                            <div class="card-actions btn-actions">
                                {{ Carbon\Carbon::parse($item->date_attendance)->format('l, d M Y || H:i') }}
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach

            {{ $reportAttendance->links() }}
        </div>
    </div>
</div>
