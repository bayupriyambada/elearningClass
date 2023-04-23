@section('pageTitle', $classesId->name . ' | ' . $classesId->assignments[0]['title'])

<div>
    <div class="container-xl">
        <div class="row g-2 align-items-center mt-2">
            <div class="col">
                <!-- Page pre-title -->
                <div class="page-pretitle">
                    Dibuat oleh: <b>{{ $classesId->user->username }}</b>
                </div>
                <h2 class="page-title">
                    Pelajaran: {{ $classesId->name }} | Tugas: {{ $title }}
                </h2>

            </div>
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
                    <span><b>{{ $title }}</b></span>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <span>Deskripsi:</span>
                    <span>{{ $subject ?? 'Tidak menuliskan deskripsi' }}</span>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <span>Buka Tugas:</span>
                    <span>
                        <x-href colorButton="" target url="{{ url($url) }}"
                            title="Buka tugas dan kerjakan." />
                    </span>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <span>Batas Pengumpulan Tugas:</span>
                    @if( Carbon\Carbon::now() > Carbon\Carbon::parse($end_date))
                    <span class="text-danger">Telah berakhir</span>
                    @else
                    <span class="text-success">
                        {{ $due_date }} s/d {{ $end_date }}
                        Silahkan mengumpulkan
                    </span>
                    @endif
                </div>
            </div>
            @if(Carbon\Carbon::now() <= Carbon\Carbon::parse($end_date))
            <div class="card">
                <div class="card-body">
                    <form autocomplete="off" wire:submit.prevent="submissionAssignment" x-on:form-submitted.window="location.reload()">
                        <div class="mb-3">
                            <div class="col-md-12 mb-3">
                                <x-input type="text" name="subject_submit" label="Deskripsi Jawaban" required />
                            </div>
                            <div class="col-md-12 mb-3">
                                <x-input type="text" name="assign_url" label="Url" required />
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">{{$isSubmitted ? "Perbaharui Jawaban": "Kirim jawaban"}}</button>
                    </form>
                </div>
            </div>
            @endif
        </div>
    </div>
</div>
