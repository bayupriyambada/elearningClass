@section('pageTitle', $classesId->name . ' | ' . $materials->title)

<div>
    <div class="container-xl">
        <div class="row g-2 align-items-center mt-2">

            <div class="col">
                <div class="page-pretitle">
                    Dibuat oleh: <b>{{ $classesId->user->username }}</b>
                </div>
                <h2 class="page-title">
                    Pelajaran: {{ $classesId->name }} | Materi: {{$materials->title}}
                </h2>

            </div>
            <div class="col-auto ms-auto d-print-none">
                <div class="btn-list">
                    <span class="d-none d-sm-inline">
                        <x-href colorButton="btn" url="{{ route('school.classes.materials.index', [$classesId->id]) }}" title="Kembali" />
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
                            <b>
                                <x-href colorButton="" target url="{{ url($materials->url) }}" title="Buka materi dan pelajari." />
                        </span>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
