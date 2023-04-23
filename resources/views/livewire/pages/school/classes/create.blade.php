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
                   <div class="col-md-12 mb-3">
                        <x-input type="text" name="name" label="Judul" required />
                    </div>
                   <div class="col-md-12 mb-3">
                        <x-input type="text" name="subject" label="Deskripsi" required />
                    </div>
                    <button type="submit" class="btn btn-primary">Tambah Data</button>
                </form>
            </div>
        </div>
    </div>
</div>
