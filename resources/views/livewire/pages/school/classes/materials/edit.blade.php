@section('pageTitle', $classesId->name . ' | ' . $materials->title)
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
                        <a href="{{route('school.classes.materials.index', [$classesId->id])}}" class="btn">
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
                        <x-input type="text" name="title" label="Judul Materi" required />
                    </div>
                    <div class="mb-3">
                        <x-input type="text" name="subject" label="Deskripsi (opsional)" />
                    </div>
                    <div class="mb-3">
                        <x-input type="text" name="url" label="Url (isikan -)" required />
                    </div>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </form>
            </div>
        </div>
    </div>
</div>
