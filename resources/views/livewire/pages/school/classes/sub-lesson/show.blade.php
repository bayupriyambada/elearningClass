@section('pageTitle', 'Pelajaran ' . $lesson->lessonCategory->name . ' | Sub: ' . $subLesson->title)

<div>
    <div class="container-xl">
        <div class="row g-2 align-items-center mt-2">
            <div class="col">
                <!-- Page pre-title -->
                <h2 class="page-title">
                    Pelajaran : {{ $lesson->lessonCategory->name }} | Sub: {{ $subLesson->title }}
                </h2>
            </div>
            <!-- Page title actions -->
            <div class="col-auto ms-auto d-print-none">
                <div class="btn-list">
                    <span class=" d-sm-inline">
                        <x-href colorButton="btn" url="{{ route('school.classes.sub.index', [$lesson->id]) }}"
                            title="Kembali" />
                    </span>
                </div>

            </div>
        </div>
        <div class="row justify-content-center mt-2">
            <div class="col-lg-10 col-xl-9">
                <div class="row row-cards mt-2">
                    <div class="card">
                        <div class="card-body">
                            <h2>Pelajaran : {{ $lesson->lessonCategory->name }} | Sub: {{ $subLesson->title }}</h2>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-body">
                            <span>Status: <b>{{$subLesson->isStatus}}</b> | Dibuat oleh: <b>{{ $subLesson->user->username }}</b></span>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-body">
                            {!! $subLesson->content !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
