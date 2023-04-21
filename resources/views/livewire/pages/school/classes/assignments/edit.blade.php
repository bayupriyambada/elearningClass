@section('pageTitle', $classesId->name . ' | ' . $assignment->title)
<div>
    <div class="container-xl">
        <div class="row g-2 align-items-center mt-2">
            <div class="col">
                <!-- Page pre-title -->
                <div class="page-pretitle">
                  Pelajaran: <b>{{$classesId->name}}</b>
                </div>
                <h2 class="page-title">
                    Ubah tugas: {{$assignment->title}}
                </h2>
            </div>
            <!-- Page title actions -->
            <div class="col-auto ms-auto d-print-none">
                <div class="btn-list">
                    <span class="d-none d-sm-inline">
                        <x-href colorButton="btn" url="{{ route('school.classes.assignments.index', [$classesId->id]) }}" title="Kembali" />
                    </span>
                </div>
            </div>
        </div>
        <div class="card mt-3">
            <div class="card-body">
                <form wire:submit.prevent="updateData" autocomplete="off">
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

                    <button type="submit" class="btn btn-primary">Ubah Data</button>
                </form>
            </div>
        </div>
    </div>
</div>
