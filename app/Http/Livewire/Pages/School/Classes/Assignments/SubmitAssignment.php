<?php

namespace App\Http\Livewire\Pages\School\Classes\Assignments;

use App\Models\assignment;
use App\Models\Classes;
use Livewire\Component;

class SubmitAssignment extends Component
{
    public $classesId;
    public $submitAssignment;
    public $subject;
    public $url;
    public function mount($submitAssignment = null)
    {
        $this->submitAssignment = $submitAssignment;
        $this->subject = optional($submitAssignment)->subject;
        $this->url = optional($submitAssignment)->url;
    }
    public function submitTask()
    {
        $this->validate([
            'subject' => 'required|min:1|max:255',
            'url' => 'required|min:1',
        ]);

        $assignment = assignment::findOrFail($this->submitAssignment);
        dd($assignment);
    }
    public function render()
    {
        return view('livewire.pages.school.classes.assignments.submit-assignment');
    }
}
