@section('pageTitle', $classesId->name . ' | Buat Tugas')
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
                <form wire:submit.prevent="create" autocomplete="off">
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

                            <input wire:model.lazy="due_date" type="text" id="due_date" placeholder="DD/MM/YYYY"
                                class="form-control @error('due_date') is-invalid @enderror" />
                            @error('due_date')
                                <span class="invalid-feedback" role="alert">{{ $message }}</span>
                            @enderror
                            {{-- <x-input id="due_date" type="text" name="due_date" label="Mulai Tugas" required /> --}}
                        </div>
                        <div class="col-md-6">
                            <input wire:model.lazy="end_date" type="text" id="end_date" placeholder="DD/MM/YYYY"
                                class="form-control @error('end_date') is-invalid @enderror" />
                            @error('end_date')
                                <span class="invalid-feedback" role="alert">{{ $message }}</span>
                            @enderror
                            {{-- <x-input type="text" id="end_date" name="end_date" label="Selesai Tugas" required /> --}}
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Simpan Data</button>
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
