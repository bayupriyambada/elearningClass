@section('pageTitle', 'Pantauan Peringkat')
<div>
    <div class="container-xl">
        <div class="row row-cards g-2 mt-2">
            <div class="col-md-3">
                <div class="card">
                    <div class="card-body text-center">
                        @dump($currentUserRank)
                        <div class="card-title mb-2">Ranking Anda</div>
                        <h1>{{$currentUserRank['rank']}}</h1>

                    </div>
                </div>
            </div>
            <div class="col-md-9">
                <div class="row row-cards">
                    <div class="col-md-6 col-lg-4">
                        <div class="card text-center">
                            <div class="card-body">
                                <div class="card-title mb-2">Nilai Rata-Rata</div>
                                <h1>{{$currentUserRank['average']}}</h1>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-4">
                        <div class="card text-center">
                            <div class="card-body">
                                <div class="card-title mb-2">Tugas yang dikumpulkan</div>
                                <h1>1</h1>
                            </div>
                        </div>
                    </div>
                    {{-- @dump($subLesson)
                    @if (isset($subLesson['taskLesson']) && !empty($subLesson['taskLesson']))
                    @foreach ($subLesson['taskLesson'] as $task)
                        <div class="d-flex justify-content-between">
                            <div class="mb-2">{{ $task['title'] }}</div>
                            <div class="mb-2">{{ $task['grade'] }}</div>
                        </div>
                    @endforeach
                    @endif --}}
                    {{-- @if (Auth::user()->id === $usersRank['userId'])
                        <p>Your rank: {{ $usersRank['rank'] }}</p>
                    @endif
                    @foreach ($usersRank as $userRank)
                        <p>Username: {{ $userRank['username'] }}</p>
                        @if (array_key_exists('user', $userRank))
                            <table>
                                <thead>
                                    <tr>
                                        <th>Sub Lesson</th>
                                        <th>Rank</th>
                                        <th>Grade</th>
                                        <th>Average</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($userRank['user'] as $task)
                                        <tr>
                                            <td>{{ $task['id'] }}</td>
                                            <td>{{ $task['rank'] }}</td>
                                            <td>{{ $task['grade'] }}</td>
                                            <td>{{ $task['average'] }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        @endif
                    @endforeach --}}

                    {{-- @foreach ($subLesson->userTasks as $task)
                        <div class="card">
                            <div class="card-body">
                                <p>Task {{ $task->number }}: {{ $task->grade }}</p>
                            </div>
                        </div>
                    @endforeach --}}
                </div>
            </div>
        </div>
    </div>
</div>
