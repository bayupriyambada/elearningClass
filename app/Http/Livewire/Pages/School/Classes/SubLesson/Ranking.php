<?php

namespace App\Http\Livewire\Pages\School\Classes\SubLesson;

use App\Models\Lesson;
use Livewire\Component;
use App\Models\SubLesson;
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
        $subLessons = SubLesson::where('lesson_id', $this->lesson->id)
            ->where("isStatus", "task")
            ->with(["taskLesson" => function ($q) {
                $q->where("user_id", auth()->user()->id)
                    ->whereNotNull("grade") // hanya ambil taskLesson yang sudah di-input grade
                    ->orderByDesc("time_rated")
                    ->with("user");
            }])
            ->get();

        $users = [];
        foreach ($subLessons as $subLesson) {
            foreach ($subLesson['taskLesson'] as $task) {
                if (isset($task['user'])) {
                    $user = $task['user'];
                    $userId = $user['id'];
                    $username = $user['username'];
                    $grade = $task['grade'];

                    if ($grade > 0) { // hanya memproses grade yang bukan default 0
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
        }

        $usersRank = [];
        foreach ($users as $userId => $userData) {
            $grades = $userData['grades'];
            $average = array_sum($grades) / count($grades);
            $total = array_sum($grades);

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
                'average' => ceil($average),
                'rank' => $rank,
                'totalSubLesson' => count($grades),
                'total' => $total
            ];
        }

        // sort array usersRank berdasarkan waktu submit terakhir
        usort($usersRank, function ($a, $b) {
            return $a['taskLesson'][0]['time_rated'] <=> $b['taskLesson'][0]['time_rated'];
        });

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
        return view('livewire.pages.school.classes.sub-lesson.ranking', [
            'subLessons' => $subLessons,
            'usersRank' => $usersRank,
            'currentUserRank' => $currentUserRank,
        ]);
    }
}
