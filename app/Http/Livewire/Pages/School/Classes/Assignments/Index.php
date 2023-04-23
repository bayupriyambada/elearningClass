<?php

namespace App\Http\Livewire\Pages\School\Classes\Assignments;

use App\Models\Classes;
use Livewire\Component;
use App\Models\assignment;
use Livewire\WithPagination;
use App\Helpers\ToastHelpers;
use App\Models\submit;

class Index extends Component
{
    public $classesId;
    public $materialDeleteId;
    use WithPagination;
    public $perPage = 10;
    public $assignmentSubmit;
    public $submitted = [];
    public function mount($classesId)
    {
        $this->classesId = Classes::select('id', 'name')->findOrFail($classesId);
    }
    public function render()
    {
        $assignments = assignment::where("classes_id", $this->classesId->id)
            ->with("user:id,username", "submitAssignment.user")
            ->select("id", "title", "url", "user_id")
            ->withCount("submitAssignment")
            ->orderByDesc("created_at")
            ->paginate($this->perPage);
        return view('livewire.pages.school.classes.assignments.index', [
            'assignments' => $assignments
        ]);
    }

    public function userSubmission($dataId)
    {
        $this->submitted = assignment::where("classes_id", $this->classesId->id)
            ->with("submitAssignment.user")
            ->orderByDesc("created_at")
            ->find($dataId);
    }

    public function deleteData($materialDeleteId)
    {
        try {
            $deleteData = assignment::find($materialDeleteId);
            $deleteData->delete();
            ToastHelpers::success($this, "Berhasil menghapus data tugas " . $deleteData->title);
        } catch (\Exception $e) {
            ToastHelpers::error($this, $e->getMessage());
        }
    }
}
