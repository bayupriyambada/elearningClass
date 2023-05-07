<?php

namespace App\Http\Livewire\Pages;

use App\Models\{attendance, Classes, Lesson, lesson_categories, SubLesson, User};
use Livewire\Component;

class DashboardComponent extends Component
{
    public function render()
    {
        $usersCount = User::where("role_id", "!=", 1)->count();
        $userTeachers = User::where("role_id", 2)->count();
        $userStudents = User::where("role_id", 3)->count();
        $classesCount = Classes::query()->count();
        $lessonCount = Lesson::query()->count();
        $lessonCategoriesCount = lesson_categories::query()->count();
        return view('livewire.pages.dashboard-component', [
            'usersCount' => $usersCount,
            'classesCount' => $classesCount,
            'lessonCount' => $lessonCount,
            'userTeachers' => $userTeachers,
            'userStudents' => $userStudents,
            'lessonCategoriesCount' => $lessonCategoriesCount,
        ]);
    }
}
