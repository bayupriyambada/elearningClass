<?php

namespace App\Http\Livewire\Pages\School\Classes\Assignments;

use App\Models\Classes;
use Livewire\Component;
use App\Models\assignment;
use Livewire\WithPagination;
use App\Helpers\ToastHelpers;

class Index extends Component
{
    public $classesId;
    public $materialDeleteId;
    use WithPagination;
    public $perPage = 10;
    public function mount($classesId)
    {
        $this->classesId = Classes::select('id', 'name')->findOrFail($classesId);
    }
    public function render()
    {
        $assignments = assignment::where("classes_id", $this->classesId->id)
            ->with("user:id,username")
            ->select("id", "title", "url", "user_id")
            ->orderByDesc("created_at")
            ->paginate($this->perPage);
        return view('livewire.pages.school.classes.assignments.index', [
            'assignments' => $assignments
        ]);
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
