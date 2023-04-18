@section('pageTitle', $classesId->name . ' | Buat Materi')
<div>
    <div class="container-xl">
        <div class="row g-2 align-items-center mt-2">
            <div class="col">
                <!-- Page pre-title -->
                <div class="page-pretitle">
                  Pelajaran: <b>{{$classesId->name}}</b>
                </div>
                <h2 class="page-title">
                    Buat Materi
                </h2>
            </div>
            <!-- Page title actions -->
            <div class="col-auto ms-auto d-print-none">
                <div class="btn-list">
                    <span class="d-none d-sm-inline">
                        <a href="{{route('school.classes.materials.index', [encrypt($classesId->id)])}}" class="btn">
                            Kembali
                        </a>
                    </span>
                </div>
            </div>
        </div>
        <div class="card mt-3">
            <div class="card-body">
                <form wire:submit.prevent="updateData" autocomplete="off">
                    <div class="mb-3">
                        <label for="text1" class="form-label required">Judul Materi</label>
                        <input type="text" wire:model="title" class="form-control" name="example-text-input" placeholder="Eg: Web Programming">
                    </div>
                    <div class="mb-3">
                        <label for="text1" class="form-label">Deskripsi Materi (opsional)</label>
                        <input type="text" wire:model="subject" class="form-control" name="example-text-input" placeholder="Eg: Web Programming adalah pelajaran mengoding">
                    </div>
                    <div class="mb-3">
                        <label for="text1" class="form-label required">Url Materi</label>
                        <input type="text" wire:model="url" class="form-control" name="example-text-input" placeholder="Eg: https://google.slides">
                    </div>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </form>
            </div>
        </div>
    </div>
</div>
