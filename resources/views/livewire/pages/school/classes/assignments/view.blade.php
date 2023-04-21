@section('pageTitle', $classesId->name . ' | ' . $assignment->title)

<div>
    <div class="container-xl">
        <div class="row g-2 align-items-center mt-2">
            <div class="col">
                <!-- Page pre-title -->
                <div class="page-pretitle">
                    Dibuat oleh: <b>{{ $classesId->user->username }}</b>
                </div>
                <h2 class="page-title">
                    Pelajaran: {{ $classesId->name }} | Tugas: {{ $assignment->title }}
                </h2>

            </div>
            <!-- Page title actions -->
            <div class="col-auto ms-auto d-print-none">
                <div class="btn-list">
                    <span class="d-none d-sm-inline">
                        <x-href colorButton="btn" url="{{ route('school.classes.assignments.index', [$classesId->id]) }}"
                            title="Kembali" />
                    </span>
                </div>
            </div>
        </div>
        <div class="row row-cards mt-2">
            <div class="card">
                <div class="card-body">
                    <span>Tugas:</span>
                    <span><b>{{ $assignment->title }}</b></span>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <span>Deskripsi:</span>
                    <span>{{ $assignment->subject ?? 'Tidak menuliskan deskripsi' }}</span>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <span>Buka Tugas:</span>
                    <span>
                        <x-href colorButton="" target url="{{ url($assignment->url) }}"
                            title="Buka tugas dan kerjakan." />
                    </span>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <span>Batas Pengumpulan Tugas:</span>
                    <span class="text-success">
                        {{ $assignment->due_date }} s/d {{ $assignment->end_date }}
                        ({{ $countDate }} Hari)
                    </span>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    @if ($isSubmitted)
                    Sudah dikirimkan
                    @else
                    <form wire:submit.prevent="submitTask">
                        <div class="mb-3">
                            <div class="col-md-12 mb-3">
                                <x-input type="text" name="subject_submit" label="Deskripsi Jawaban" required />
                            </div>
                            <div class="col-md-12 mb-3">
                                <x-input type="text" name="assign_url" label="Url" required />
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">Kirim jawaban</button>
                    </form>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
