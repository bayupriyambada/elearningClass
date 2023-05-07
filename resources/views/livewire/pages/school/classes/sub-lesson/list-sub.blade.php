@section('pageTitle', 'Pelajaran ' . $lesson->lessonCategory->name)
<div>
    <div class="container-xl">
        <div class="row g-2 align-items-center mt-2">
            <div class="col">
                <!-- Page pre-title -->
                <h2 class="page-title">
                    Pelajaran Anda : {{ $lesson->lessonCategory->name }}
                </h2>
            </div>
            <!-- Page title actions -->
            <div class="col-auto ms-auto d-print-none">
                <div class="btn-list">
                    <span class=" d-sm-inline">
                        <x-href colorButton="btn" url="{{ route('school.dashboard') }}" title="Kembali" />
                    </span>
                </div>

            </div>
        </div>
        <div class="row row-cards mt-2">
            @forelse ($subLessons as $index => $subLesson)
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title"> {{ $index + 1 }}. [<b>{{$subLesson->isStatus === "material" ? "materi": "tugas"}}</b>] {{ $subLesson->title }}
                            </h3>
                            <div class="card-actions btn-actions">
                                <a href="{{ route('school.classes.sub.view', [$lesson->id, $subLesson->id]) }}"
                                    class="btn-action" title="Lihat {{ $subLesson->title }}">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-eye"
                                        width="24" height="24" viewBox="0 0 24 24" stroke-width="2"
                                        stroke="currentColor" fill="none" stroke-linecap="round"
                                        stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                        <path d="M10 12a2 2 0 1 0 4 0a2 2 0 0 0 -4 0"></path>
                                        <path
                                            d="M21 12c-2.4 4 -5.4 6 -9 6c-3.6 0 -6.6 -2 -9 -6c2.4 -4 5.4 -6 9 -6c3.6 0 6.6 2 9 6">
                                        </path>
                                    </svg>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <span class="card-subtitle">Saat ini belum mempunyai materi / tugas.</span>
                        </div>
                    </div>
                </div>
            @endforelse
        </div>
    </div>
</div>
