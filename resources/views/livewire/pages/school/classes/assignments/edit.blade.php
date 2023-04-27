@section('pageTitle', $classesId->name . ' | ' . $assignment->title)
<div>
    <div class="container-xl">
        <div class="row g-2 align-items-center mt-2">
            <div class="col">
                <!-- Page pre-title -->
                <div class="page-pretitle">
                    Pelajaran: <b>{{ $classesId->name }}</b>
                </div>
                <h2 class="page-title">
                    Buat Tugas
                </h2>
            </div>
            <!-- Page title actions -->
            <div class="col-auto ms-auto d-print-none">
                <div class="btn-list">
                    <span class="d-none d-sm-inline">
                        <a href="{{ route('school.classes.assignments.index', [$classesId->id]) }}" class="btn">
                            Kembali
                        </a>
                    </span>
                </div>
            </div>
        </div>
        <div class="card mt-3">
            <div class="card-body">
                <form wire:submit.prevent="updateForm" autocomplete="off">
                    <div class="row g-3 mb-3">
                        <div class="col-md-12">
                            <x-input type="text" name="title" label="Judul Tugas" required />
                        </div>
                        <div class="col-md-12">
                            <x-input type="text" name="subject" label="Deskripsi (isikan -)" required />
                        </div>
                        <div class="col-md-12">
                            <x-input type="text" name="url" label="Url (isikan -)" required />
                        </div>
                        <div class="col-md-6" wire:ignore>
                            <x-input type="text" name="due_date" id="due_date" label="Tanggal Mulai" required />
                        </div>
                        <div class="col-md-6" wire:ignore>
                            <x-input type="text" name="end_date" id="end_date" label="Tanggal Selesai" required />
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Ubah Data</button>
                </form>
            </div>
        </div>
    </div>
</div>
@push('js')
    <script>
        new Pikaday({
            field: document.getElementById('due_date'),
            format: 'YYYY/MM/DD'
        })
        new Pikaday({
            field: document.getElementById('end_date'),
            format: 'YYYY/MM/DD'
        })
    </script>
@endpush
