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
        $this->classesId = Classes::with("user:id,username")->findOrFail($classesId);
        $this->assignment = assignment::with("submitAssignment", "submitAssignment.user")->findOrFail($assignmentId);
        $this->assignmentId = $this->assignment->id;
        $this->title = $this->assignment->title;
        $this->subject = $this->assignment->subject;
        $this->url = $this->assignment->url;
        $this->due_date = $this->assignment->due_date;
        $this->end_date = $this->assignment->end_date;
        $this->countDate = Carbon::parse($this->due_date)->diffInDays($this->end_date);
        $this->user_id = $this->assignment->user_id;

        $this->submitAssignment = Submit::where("assignment_id", $this->assignment->id)
            ->where("user_id", auth()->user()->id)
            ->first();
        $this->assign_url = $this->submitAssignment->assign_url ?? "";
        $this->sent_assignment = $this->submitAssignment->sent_assignment ?? "";
        $this->subject_submit = $this->submitAssignment->subject_submit ?? "";
        $this->isSubmit = $this->submitAssignment->isSubmit ?? false;
    }

    protected $rules = [
        'subject_submit' => 'required|string|min:1',
        'assign_url' => 'required',
    ];
    public function submitTask()
    {
        try {
            $this->validate();
            $status = $this->submitAssignment ? "update" : "create";
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
            if ($status === "create") {
                ToastHelpers::success($this, "Berhasil mengumpulkan tugas " . $this->assignment->title);
            } else {
                ToastHelpers::success($this, "Berhasil memperbaharui tugas " . $this->assignment->title);
            }
            $this->isSubmitted = true;
        } catch (\Exception $e) {
            ToastHelpers::error($this, $e->getMessage());
        }
    }
    public function render()
    {
        return view('livewire.pages.school.classes.assignments.view');
    }
}
