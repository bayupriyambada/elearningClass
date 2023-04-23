<?php

namespace App\Http\Livewire\Pages\School\Classes\Assignments;

use Carbon\Carbon;
use App\Models\submit;
use App\Models\Classes;
use Livewire\Component;
use App\Models\assignment;
use Illuminate\Support\Str;
use App\Helpers\ToastHelpers;

class View extends Component
{
    public $classesId;
    public $assignmentId;
    public $assignment;
    public $title;
    public $subject;
    public $url;
    public $due_date;
    public $end_date;
    public $countDate;
    public $user_id;

    // submit
    public $subject_submit;
    public $assign_url;
    public $submitAssignment;
    public $isSubmit;
    public $sent_assignment;

    public $isSubmitted = false;
    public function mount($classesId, $assignmentId)
    {
        $this->classesId = Classes::with([
            'user' => function ($query) {
                $query->select('id', 'username');
            },
            'assignments' => function ($assign) use ($classesId) {
                $assign
                    ->where("classes_id", $classesId)
                    ->select("id", "title", "subject", "classes_id", "url", "due_date", "end_date");
            }
        ])
            ->select("id", "name", "user_id")
            ->findOrFail($classesId);

        $this->assignment = $this->classesId->assignments->where('id', $assignmentId)->first();
        $this->assignmentId = $this->assignment->id;
        $this->title = $this->assignment->title;
        $this->subject = $this->assignment->subject;
        $this->url = $this->assignment->url;
        $this->due_date = $this->assignment->due_date;
        $this->end_date = $this->assignment->end_date;
        $submitAssignment = $this->assignment->submitAssignment->where("user_id", auth()->user()->id)->where("assignment_id", $this->assignmentId)->first();
        $this->assign_url = optional($submitAssignment)->assign_url ?? "";
        $this->sent_assignment = optional($submitAssignment)->sent_assignment ?? "";
        $this->subject_submit = optional($submitAssignment)->subject_submit ?? "";
        $this->isSubmit = optional($submitAssignment)->isSubmit ?? false;
    }

    protected $rules = [
        'subject_submit' => 'required|string|min:1',
        'assign_url' => 'required',
    ];
    public function updatedIsSubmitted($value)
    {
        if ($value) {
            $this->submissionAssignment();
            $this->dispatchBrowserEvent('form-submitted');
        }
    }
    public function submissionAssignment()
    {
        try {
            $this->validate();
            if (now() > $this->end_date) {
                ToastHelpers::error($this, "Pengumpulan tugas telah berakhir");
                return;
            }
            $this->assignment->submitAssignment()->updateOrCreate(
                ['assignment_id' => $this->assignment->id, 'user_id' => auth()->user()->id],
                [
                    'id' => Str::uuid(),
                    'subject_submit' => $this->subject_submit,
                    'assign_url' => $this->assign_url,
                    'user_id' => auth()->user()->id,
                    'isSubmit' => 1,
                    'sent_assignment' => now(),
                ]
            );
            ToastHelpers::success($this, "Berhasil mengirimkan tugas " . $this->assignment->title);
            $this->isSubmitted = true;
            $this->dispatchBrowserEvent('form-submitted');
        } catch (\Exception $e) {
            ToastHelpers::error($this, $e->getMessage());
        }
    }
    public function render()
    {
        return view('livewire.pages.school.classes.assignments.view');
    }
}
