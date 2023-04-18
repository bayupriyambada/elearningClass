@section('pageTitle', $classesId->name . ' | Buat Tugas')
<div>
    <div class="container-xl">
        <div class="row g-2 align-items-center mt-2">
            <div class="col">
                <!-- Page pre-title -->
                <div class="page-pretitle">
                  Pelajaran: <b>{{$classesId->name}}</b>
                </div>
                <h2 class="page-title">
                    Buat Tugas
                </h2>
            </div>
            <!-- Page title actions -->
            <div class="col-auto ms-auto d-print-none">
                <div class="btn-list">
                    <span class="d-none d-sm-inline">
                        <a href="{{route('school.classes.assignments.index', [$classesId->id])}}" class="btn">
                            Kembali
                        </a>
                    </span>
                </div>
            </div>
        </div>
        <div class="card mt-3">
            <div class="card-body">
                <form wire:submit.prevent="create" autocomplete="off">
                    <div class="mb-3">
                        <label for="text1" class="form-label required">Judul</label>
                        <input type="text" wire:model="title" class="form-control" name="example-text-input" placeholder="Eg: Web Programming">
                    </div>
                    <div class="mb-3">
                        <label for="text1" class="form-label">Deskripsi (opsional)</label>
                        <input type="text" wire:model="subject" class="form-control" name="example-text-input" placeholder="Eg: Kumpulkan tugas semaksimal mungkin">
                    </div>
                    <div class="mb-3">
                        <label for="text1" class="form-label required">Url</label>
                        <input type="text" wire:model="url" class="form-control" name="example-text-input" placeholder="Eg: https://google.slides">
                    </div>
                    <div class="mb-3">
                        <label for="text1" class="form-label required">Mulai Tugas</label>
                        <input type="datetime-local" wire:model="due_date" class="form-control" name="example-text-input" placeholder="Eg: https://google.slides">
                    </div>
                    <div class="mb-3">
                        <label for="text1" class="form-label required">Selesai Tugas</label>
                        <input type="datetime-local" wire:model="end_date" class="form-control" name="example-text-input" placeholder="Eg: https://google.slides">
                    </div>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </form>
            </div>
        </div>
    </div>
</div>
