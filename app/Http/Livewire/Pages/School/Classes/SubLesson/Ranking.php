<?php

namespace App\Http\Livewire\Pages\School\Classes\SubLesson;

use App\Models\Lesson;
use Livewire\Component;
use App\Models\SubLesson;
use App\Models\TaskSubLesson;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class Ranking extends Component
{
    public $lesson;
    public $subLesson;
    public $subLessonId;
    public function mount($lessonId)
    {
        $this->lesson = Lesson::with(["lessonCategory"])
            ->whereHas("user", function ($user) {
                $user->select("id", "username");
            })
            ->findOrFail($lessonId);
    }
    public function render()
    {
        // $subLessons = SubLesson::where('lesson_id', $this->lesson->id)
        //     ->with('taskLesson.user')
        //     ->get()
        //     ->toArray();

        // // array untuk menampung nilai rata-rata taskLesson per user
        // $userTaskLessonAverages = [];

        // // menghitung rata-rata nilai taskLesson per user
        // foreach ($subLessons as $subLesson) {
        //     foreach ($subLesson['task_lesson'] as $taskLesson) {
        //         $user = $taskLesson['user'];
        //         if (!isset($userTaskLessonAverages[$user['id']])) {
        //             $userTaskLessonAverages[$user['id']] = [
        //                 'user' => $user,
        //                 'total_score' => 0,
        //                 'total_task' => 0,
        //             ];
        //         }
        //         $userTaskLessonAverages[$user['id']]['total_score'] += $taskLesson['grade'];
        //         $userTaskLessonAverages[$user['id']]['total_task']++;
        //     }
        // }

        // // menghitung nilai rata-rata taskLesson per user
        // foreach ($userTaskLessonAverages as &$average) {
        //     $average['average_score'] = $average['total_score'] / $average['total_task'];
        // }

        // // sorting berdasarkan nilai rata-rata taskLesson secara descending
        // usort($userTaskLessonAverages, function ($a, $b) {
        //     return $b['average_score'] - $a['average_score'];
        // });

        // // menentukan ranking per user
        // $rank = 1;
        // foreach ($userTaskLessonAverages as &$average) {
        //     $average['rank'] = $rank;
        //     $rank++;
        // }


        // dd($userTaskLessonAverages);
        // $subLessons = SubLesson::where("lesson_id", $this->lesson->id)
        //     ->with(["taskLesson" => function ($query) {
        //         $query->select("id", "user_id", "sub_lesson_id", "grade")
        //             ->where("user_id", auth()->user()->id);
        //     }])
        //     ->get()
        //     ->toArray();

        // $rankings = [];
        // foreach ($subLessons as $subLesson) {
        //     $task = $subLesson["task_lesson"];
        //     if ($task != null) {
        //         $user_id = $task["user_id"];
        //         $grade = $task["grade"];
        //         if (isset($rankings[$user_id])) {
        //             $rankings[$user_id]["grade"] += $grade;
        //         } else {
        //             $rankings[$user_id] = [
        //                 "grade" => $grade,
        //                 "name" => $task["user"]["name"]
        //             ];
        //         }
        //     }
        // }

        // usort($rankings, function ($a, $b) {
        //     return $b["grade"] - $a["grade"];
        // });

        // $rankingByUser = [];
        // $rank = 1;
        // foreach ($rankings as $ranking) {
        //     $name = $ranking["name"];
        //     if (!isset($rankingByUser[$name])) {
        //         $rankingByUser[$name] = [
        //             "rank" => $rank,
        //             "grade" => $ranking["grade"]
        //         ];
        //         $rank++;
        //     }
        // }
        // $subLessons = SubLesson::where("lesson_id", $this->lesson->id)
        //     ->with([
        //         'taskLesson' => function ($query) {
        //             $query->where('user_id', auth()->id()); // hanya tampilkan ranking user yang sedang login
        //             $query->select(
        //                 'sub_lesson_id',
        //                 DB::raw('SUM(grade) as total_grade')
        //             ); // ambil nilai total grade
        //             $query->groupBy('sub_lesson_id');
        //         },
        //         'taskLesson.user' // tambahkan relasi ke user
        //     ])
        //     ->get()
        //     ->map(function ($subLesson) {
        //         $subLesson['ranking'] = $subLesson->taskLesson->first()->total_grade ?? 0;
        //         return $subLesson;
        //     })
        //     ->sortByDesc('ranking')
        //     ->values();
        // dd($subLessons);
        // mendapatkan sub lesson beserta tugas-tugasnya

        // $subLessons = SubLesson::with('taskLesson')->where('lesson_id', $this->lesson->id)->get();
        // // Proses penghitungan rank dan rata-rata
        // $usersRank = [];
        // $currentUser = Auth::user();
        // foreach ($subLessons as $subLesson) {
        //     foreach ($subLesson['taskLesson'] as $task) {
        //         $userId = $task['user_id'];
        //         if (!isset($usersRank[$userId])) {
        //             $usersRank[$userId] = [
        //                 'userId' => $userId,
        //                 'username' => $task['user']['username'],
        //                 'ranking' => null,
        //                 'user' => [],
        //             ];
        //         }
        //         $usersRank[$userId]['user'][] = [
        //             'id' => $subLesson['id'],
        //             'rank' => null,
        //             'grade' => $task['grade'],
        //             'average' => null,
        //         ];
        //     }
        // }

        // // Menambahkan key 'userId' dengan value ID user yang sedang login
        // $loggedInUserId = Auth::id();
        // foreach ($usersRank as &$userRank) {
        //     if ($userRank['userId'] === $loggedInUserId) {
        //         $userRank['userId'] = $loggedInUserId;
        //         break;
        //     }
        // }
        // $subLessons = SubLesson::where('lesson_id', $this->lesson->id)
        //     ->with('taskLesson.user')
        //     ->get();

        // $usersRank = [];

        // foreach ($subLessons as $subLesson) {
        //     foreach ($subLesson->taskLesson as $task) {
        //         if (!$task->user) {
        //             continue;
        //         }

        //         $user = $task->user;

        //         if (isset($usersRank[$user->id]['grade'])) {
        //             $usersRank[$user->id]['grade'] += $task->grade;
        //             $usersRank[$user->id]['count']++;
        //         } else {
        //             $usersRank[$user->id]['grade'] = $task->grade;
        //             $usersRank[$user->id]['count'] = 1;
        //             $usersRank[$user->id]['username'] = $user->username;
        //             $usersRank[$user->id]['userId'] = $user->id;
        //         }
        //     }
        // }

        // // Calculate rank for each user based on their total grade
        // usort($usersRank, function ($a, $b) {
        //     if ($a['grade'] === $b['grade']) {
        //         return 0;
        //     }
        //     return ($a['grade'] < $b['grade']) ? 1 : -1;
        // });

        // $rank = 1;
        // $prevGrade = null;

        // foreach ($usersRank as &$userRank) {
        //     if ($prevGrade === null || $prevGrade !== $userRank['grade']) {
        //         $prevGrade = $userRank['grade'];
        //         $userRank['rank'] = $rank;
        //     } else {
        //         $userRank['rank'] = $rank;
        //     }
        //     $rank++;
        // }
        $subLessons = SubLesson::where('lesson_id', $this->lesson->id)
            ->where("isStatus", "task")
            ->with('taskLesson.user')
            ->get();

        $users = [];
        foreach ($subLessons as $subLesson) {
            // dd($subLesson);
            foreach ($subLesson['taskLesson'] as $task) {
                // dd($task);
                if (isset($task['user'])) {
                    $user = $task['user'];
                    $userId = $user['id'];
                    $username = $user['username'];
                    $grade = $task['grade'];

                    if (isset($users[$userId])) {
                        $users[$userId]['grades'][] = $grade;
                    } else {
                        $users[$userId] = [
                            'username' => $username,
                            'grades' => [$grade]
                        ];
                    }
                }
            }
        }

        $usersRank = [];
        foreach ($users as $userId => $userData) {
            $grades = $userData['grades'];
            $average = ceil(array_sum($grades)) / count($grades);
            $total = count($grades);

            $rank = 1;
            foreach ($users as $comparedUserId => $comparedUserData) {
                if ($comparedUserId !== $userId) {
                    $comparedGrades = $comparedUserData['grades'];
                    $comparedAverage = array_sum($comparedGrades) / count($comparedGrades);

                    if ($average < $comparedAverage) {
                        $rank++;
                    }
                }
            }

            $usersRank[] = [
                'userId' => $userId,
                'username' => $userData['username'],
                'average' => $average,
                'rank' => $rank,
                'total' => $total
            ];
        }

        $currentUserRank = null;
        if (Auth::check()) {
            $currentUserId = Auth::id();

            foreach ($usersRank as $userRank) {
                if ($userRank['userId'] === $currentUserId) {
                    $currentUserRank = $userRank;
                    break;
                }
            }
        }
        dd($usersRank, $subLessons);
        return view('livewire.pages.school.classes.sub-lesson.ranking', [
            'subLessons' => $subLessons,
            'usersRank' => $usersRank,
            'currentUserRank' => $currentUserRank,
            // 'subLessons' => $subLessons,
            // 'usersRank' => $usersRank,
            // "userTaskLessonAverages" =>
            // 'lesson' => $this->lesson,
            // 'subLessons' => $subLessons,
            // 'rankingByUser' => $rankingByUser
        ]);
    }
}
