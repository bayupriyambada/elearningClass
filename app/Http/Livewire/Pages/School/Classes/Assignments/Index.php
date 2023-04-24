<?php

namespace App\Http\Livewire\Pages\School\Classes\Assignments;

use App\Models\submit;
use App\Models\Classes;
use Livewire\Component;
use App\Models\assignment;
use Livewire\WithPagination;
use App\Helpers\ToastHelpers;
use Illuminate\Support\Collection;

class Index extends Component
{
    public $classesId;
    public $materialDeleteId;
    // use WithPagination;
    // public $perPage = 10;
    public $assignmentSubmit;
    public $submitted = [];
    public int $amount = 10;
    public int $offset = 0;
    public Collection $assignments;

    public bool $showLoadMoreButton;

    public function mount($classesId)
    {
        $this->classesId = Classes::select('id', 'name')->findOrFail($classesId);
        $this->loadAssign();
    }

    public function loadAssign()
    {
        $assign = assignment::query()
            ->where("classes_id", $this->classesId->id)
            ->with("user:id,username", "submitAssignment.user")
            ->select("id", "title", "url", "user_id")
            ->withCount("submitAssignment")
        ->offset($this->offset)->limit($this->amount)->get();
        $this->assignments = isset($this->assignments) ? $this->assignments->merge($assign) : $assign;

        $this->offset += $this->amount;

        $this->showLoadMoreButton = assignment::count() > $this->offset;
    }
    public function render()
    {
        return view('livewire.pages.school.classes.assignments.index');
    }

    public function userSubmission($dataId)
    {
        $this->submitted = assignment::where("classes_id", $this->classesId->id)
            ->with("submitAssignment.user")
            ->orderByDesc("created_at")
            ->find($dataId);
    }

    public function deleteData($assignmentId)
    {
        try {
            $deleteData = assignment::find($assignmentId);
            $deleteData->delete();
            $this->assignments->forget($this->assignments->search(function ($item, $key) use ($assignmentId) {
                return $item->id === $assignmentId;
            }));
            ToastHelpers::success($this, "Berhasil menghapus data tugas " . $deleteData->title);
        } catch (\Exception $e) {
            ToastHelpers::error($this, $e->getMessage());
        }
    }
}
