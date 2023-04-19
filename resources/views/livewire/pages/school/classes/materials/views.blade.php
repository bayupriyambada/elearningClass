@section('pageTitle', $classesId->name . ' | ' . $materials->title)

<div>
    <div class="container-xl">
        <div class="row g-2 align-items-center mt-2">
            <div class="col">
                <!-- Page pre-title -->
                <div class="page-pretitle">
                    Dibuat oleh: <b>{{ $classesId->user->username }}</b>
                </div>
                <h2 class="page-title">
                    Pelajaran: {{ $classesId->name }} | Materi: {{$materials->title}}
                </h2>

            </div>
            <!-- Page title actions -->
            <div class="col-auto ms-auto d-print-none">
                <div class="btn-list">
                    <span class="d-none d-sm-inline">
                        <a href="{{ route('school.classes.materials.index', [$classesId->id]) }}" class="btn">
                            Kembali
                        </a>
                    </span>
                </div>
            </div>
        </div>
        <div class="row row-cards mt-2">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <span>
                            Materi:
                            <br>
                            <b>{{$materials->title}}</b>
                        </span>
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <span>
                            Deskripsi:
                            <br>
                            <b>{{$materials->subject ?? "Tidak menuliskan deskripsi"}}</b>
                        </span>
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <span>
                            Buka Materi:
                            <br>
                            <b><a href="{{url($materials->url)}}" target="_blank">{{$materials->url}}</a></b>
                        </span>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
