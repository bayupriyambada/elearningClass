@section('pageTitle', 'Pantauan Peringkat')
<div>
    <div class="container-xl">
        <div class="row row-cards g-2 mt-2">
            <div class="col-md-3">
                <div class="card">
                    <div class="card-body text-center">
                        <div class="card-title mb-2">Ranking Anda</div>
                        <h1>{{ $currentUserRank['rank'] ?? '' }}</h1>

                    </div>
                </div>
            </div>
            <div class="col-md-9">
                <div class="row row-cards">
                    <div class="col-md-6 col-lg-4">
                        <div class="card text-center">
                            <div class="card-body">
                                <div class="card-title mb-2">Nilai Rata-Rata</div>
                                <h1>{{ $currentUserRank['average'] ?? '' }}</h1>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-4">
                        <div class="card text-center">
                            <div class="card-body">
                                <div class="card-title mb-2">Tugas Ternilai</div>
                                <h1>{{ $currentUserRank['totalSubLesson'] ?? '' }}</h1>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-4">
                        <div class="card text-center">
                            <div class="card-body">
                                <div class="card-title mb-2">Total Nilai</div>
                                <h1>{{ $currentUserRank['total'] ?? '' }}</h1>
                            </div>
                        </div>
                    </div>

                    @php
                        $taskLessons = $subLessons
                            ->flatMap(function ($subLesson) {
                                return $subLesson->taskLesson;
                            })
                            ->sortByDesc('time_rated');
                    @endphp
                    @foreach ($taskLessons as $item)
                        <div class="card">
                            <div class="card-body">
                                {{ $item->information }} [ <b>{{ $item->grade }}</b> ] -
                                {{ \Carbon\Carbon::parse($item->time_rated)->format('d/m/Y') }}
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
