@section('pageTitle', 'Buat Pelajaran')

<div>
    <div class="container-xl">
        <div class="row g-2 align-items-center mt-2">
            <div class="col">
                <!-- Page pre-title -->
                <h2 class="page-title">
                    Buat Pelajaran
                </h2>
            </div>
            <!-- Page title actions -->
            <div class="col-auto ms-auto d-print-none">
                <div class="btn-list">
                    <span class="d-none d-sm-inline">
                        <a href="{{route('school.classes.list')}}" class="btn">
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
                        <label for="text1" class="form-label required">Judul Pelajaran</label>
                        <input type="text" wire:model="name" class="form-control" name="example-text-input" placeholder="Eg: Web Programming">
                    </div>
                    <div class="mb-3">
                        <label for="text1" class="form-label">Deskripsi Pelajaran (opsional)</label>
                        <input type="text" wire:model="subject" class="form-control" name="example-text-input" placeholder="Eg: Web Programming adalah pelajaran mengoding">
                    </div>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </form>
            </div>
        </div>
    </div>
</div>
