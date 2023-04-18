<?php

namespace App\Http\Livewire\Pages;

use App\Models\{assignment, attendance, Classes, User, material, submit};
use Livewire\Component;

class DashboardComponent extends Component
{
    public function render()
    {
        $usersCount = User::where("role_id", "!=", 1)->count();
        $classesCount = Classes::query()->count();
        $materialCount = material::query()->count();
        $attendancesCount = attendance::query()->where("user_id", "!=", 1)->count();
        $assignmentCount = assignment::query()->count();
        $submitAssignmentCount = submit::query()->count();
        return view('livewire.pages.dashboard-component', [
            'usersCount' => $usersCount,
            'classesCount' => $classesCount,
            'materialCount' => $materialCount,
            'attendancesCount' => $attendancesCount,
            'assignmentCount' => $assignmentCount,
            'submitAssignmentCount' => $submitAssignmentCount,
        ]);
    }
}
