@section('pageTitle', 'Pantauan Peringkat')
<div>
    <div class="container-xl">
        <div class="row g-2 align-items-center mt-2">
            <div class="col">
                <h2 class="page-title">
                    Penilaian pelajaran {{ $lesson->lessonCategory->name }} v.{{ $lesson->version }}
                </h2>
            </div>
            <div class="col-auto ms-auto d-print-none">
                <div class="btn-list">
                    <span class=" d-sm-inline">
                        <x-href colorButton="btn" url="{{ route('school.dashboard') }}" title="Kembali" />
                    </span>
                </div>

            </div>
        </div>
        <div class="row row-cards g-2 mt-2">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <ul class="nav nav-tabs card-header-tabs" data-bs-toggle="tabs" role="tablist">
                            <li class="nav-item" role="presentation">
                                <a href="#tabs-home-14" class="nav-link active" data-bs-toggle="tab"
                                    aria-selected="true" role="tab">Nilai rata-rata</a>
                            </li>
                            <li class="nav-item" role="presentation">
                                <a href="#tabs-profile-14" class="nav-link" data-bs-toggle="tab" aria-selected="false"
                                    role="tab" tabindex="-1">Jawaban dan Nilai</a>
                            </li>
                        </ul>
                    </div>
                    <div class="card-body">
                        <div class="tab-content">
                            <div class="tab-pane fade active show" id="tabs-home-14" role="tabpanel">
                                <div class="col-md-12">
                                    <div class="row row-cards">
                                        @foreach ($usersRank as $item)
                                            <div class="col-md-6 col-lg-4">
                                                <div class="card text-center">
                                                    <div class="card-body">
                                                        <div class="card-title mb-2">Nilai Rata-Rata</div>
                                                        <h1>{{ $item['average'] ?? 0 }}</h1>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-lg-4">
                                                <div class="card text-center">
                                                    <div class="card-body">
                                                        <div class="card-title mb-2">Total Tugas Pelajaran</div>
                                                        <h1>{{ $item['totalSublesson'] ?? 0 }}</h1>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-lg-4">
                                                <div class="card text-center">
                                                    <div class="card-body">
                                                        <div class="card-title mb-2">Total Nilai Tugas</div>
                                                        <h1>{{ $item['total'] ?? 0 }}</h1>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="tabs-profile-14" role="tabpanel">
                                <div class="col-md-12">
                                    @php
                                        $taskLessons = $subLessons
                                            ->flatMap(function ($subLesson) {
                                                return $subLesson->taskLesson;
                                            })
                                            ->sortByDesc('time_rated');
                                    @endphp
                                    <div class="row row-cards">
                                        @foreach ($taskLessons as $item)
                                            <div class="card">
                                                <div class="card-body">
                                                    <b>[{{$item->subLesson->title}}]</b> {{ $item->information }} [ <b>{{ $item->grade == 0 ? "Belum dinilai" : $item->grade }}</b> ] -
                                                    {{ \Carbon\Carbon::parse($item->time_rated)->format('d/m/Y') }}
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


        </div>
    </div>
</div>
