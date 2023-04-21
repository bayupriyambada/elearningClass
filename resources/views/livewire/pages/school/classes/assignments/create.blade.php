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
                    <div class="col-md-6">
                        <x-input type="datetime-local" name="due_date" label="Mulai Tugas" required />
                    </div>
                    <div class="col-md-6">
                          <x-input type="datetime-local" name="end_date" label="Selesai Tugas" required />
                      </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </form>
            </div>
        </div>
    </div>
</div>
