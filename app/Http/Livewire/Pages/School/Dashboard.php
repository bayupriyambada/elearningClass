<?php

namespace App\Http\Livewire\Pages\School;

use App\Models\Classes;
use Livewire\Component;

class Dashboard extends Component
{
    public function render()
    {
        $classes = Classes::where('user_id', auth()->user()->id)
            ->select("id", "name", "code", "user_id")
            ->withCount(['materials', 'assignments'])
            ->with("user:id,username")
            ->get();
        // dd($classes);
        return view('livewire.pages.school.dashboard', [
            'classes' => $classes
        ]);
    }
}
