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
            ->with("user")
            ->max("grade");
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
        $totalSubLessons = count($subLessons);
        foreach ($users as $userId => $userData) {
            $grades = $userData['grades'];
            $average = array_sum($grades) / $totalSubLessons;
            $total = array_sum($grades);

            $usersRank[] = [
                'userId' => $userId,
                'username' => $userData['username'],
                'average' => ceil($average),
                'totalSublesson' => $totalSubLessons,
                'total' => $total,
            ];
        }

        usort(
            $usersRank,
            function ($a, $b) {
                if ($b['average'] == $a['average']) {
                    return 0;
                }
                return ($b['average'] < $a['average']) ? -1 : 1;
            }
        );

        // beri peringkat pada setiap user
        $rank = 0;
        $prevAverage = null;
        foreach ($usersRank as &$userRank) {
            if ($userRank['average'] != $prevAverage) {
                $prevAverage = $userRank['average'];
                $rank++;
            }
            $userRank['rank'] = $rank;
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

        return view('livewire.pages.school.classes.sub-lesson.ranking', [
            'subLessons' => $subLessons,
            'usersRank' => $usersRank,
            'currentUserRank' => $currentUserRank,
        ]);
    }
}
