<?php

namespace App\Http\Livewire\Pages;

use App\Models\{attendance, Classes, User};
use Livewire\Component;

class DashboardComponent extends Component
{
    public function render()
    {
        $usersCount = User::where("role_id", "!=", 1)->count();
        $classesCount = Classes::query()->count();
        $attendancesCount = attendance::query()->where("user_id", "!=", 1)->count();
        return view('livewire.pages.dashboard-component', [
            'usersCount' => $usersCount,
            'classesCount' => $classesCount,
            'attendancesCount' => $attendancesCount,
        ]);
    }
}
