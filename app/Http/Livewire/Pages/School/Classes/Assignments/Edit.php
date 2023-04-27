<?php

namespace App\Http\Livewire\Pages\School\Classes\Assignments;

use App\Models\Classes;
use Livewire\Component;
use App\Models\assignment;
use App\Helpers\ToastHelpers;

class Edit extends Component
{
    public $classesId;
    public $assignmentId;
    public $assignment;
    public $title;
    public $subject;
    public $due_date;
    public $end_date;
    public $url;

    public function mount($classesId, $assignmentId)
    {
        $this->classesId = Classes::findOrFail($classesId);
        $this->assignment = assignment::findOrFail($assignmentId);
        $this->assignmentId = $this->assignment->id;
        $this->title = $this->assignment->title;
        $this->subject = $this->assignment->subject;
        $this->due_date = $this->assignment->due_date;
        $this->end_date = $this->assignment->end_date;
        $this->url = $this->assignment->url;
    }
    protected $rules = [
        'title' => 'required|string|min:1',
        'subject' => 'nullable|string',
        'url' => 'required|string',
        'due_date' => 'required|date|after_or_equal:today',
        'end_date' => 'required|after:due_date',
    ];
    public function updateForm()
    {
        $this->validate();

        try {
            assignment::where('id', $this->assignmentId)->update([
                'title' => $this->title,
                'subject' => $this->subject,
                'url' => $this->url,
                'due_date' => $this->due_date,
                'end_date' => $this->end_date,
                'user_id' => auth()->user()->id,
                'classes_id' => $this->classesId->id
            ]);
            ToastHelpers::success($this, "Berhasil memperbaharui data tugas");
            redirect(route('school.classes.assignments.index', [$this->classesId->id]));
        } catch (\Exception $e) {
            ToastHelpers::success($this, $e->getMessage());
            redirect(route('school.classes.assignments.index', [$this->classesId->id]));
        }
    }
    public function render()
    {
        return view('livewire.pages.school.classes.assignments.edit');
    }
}
