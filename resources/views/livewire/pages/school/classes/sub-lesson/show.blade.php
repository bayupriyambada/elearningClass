@section('pageTitle', 'Pelajaran ' . $lesson->lessonCategory->name . ' | Sub: ' . $subLesson->title)

<div>
    <div class="container-xl">
        <div class="row g-2 align-items-center mt-2">
            <div class="col">
                <h2 class="page-title">
                    Pelajaran : {{ $lesson->lessonCategory->name }} | Sub: {{ $subLesson->title }}
                </h2>
            </div>
            <div class="col-auto ms-auto d-print-none">
                <div class="btn-list">
                    <span class=" d-sm-inline">
                        @if ($subLesson->isStatus === 'task')
                            <button wire:click="openCloseTask({{ json_encode($subLesson->id) }})"
                                class="btn {{$subLesson->isOpen === 1 ? "btn-danger" : "btn-primary"}} ">{{$subLesson->isOpen === 1 ? "Tutup Tugas" : "Buka Tugas"}}</button>
                        @endif
                    </span>
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
                            <span>Status: <b>{{ $subLesson->isStatus }}</b> | Dibuat oleh:
                                <b>{{ $subLesson->user->username }}</b></span>
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
