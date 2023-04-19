<?php

namespace App\Http\Livewire\Pages\School\Classes\Materials;

use App\Models\Classes;
use Livewire\Component;
use App\Models\material;
use Livewire\WithPagination;

class Index extends Component
{
    public $classesId;
    public $materialDeleteId;
    use WithPagination;
    public $perPage = 10;
    public function mount($classesId)
    {
        $this->classesId = Classes::with("user:id,username")->select('id', 'name', "user_id")->findOrFail($classesId);
    }
    public function render()
    {
        $materials = material::where("classes_id", $this->classesId->id)
            ->with("user:id,username")
            ->select("id", "title", "url", "user_id")
            ->orderByDesc("created_at")
            ->paginate($this->perPage);
        return view('livewire.pages.school.classes.materials.index', [
            'materials' => $materials
        ]);
    }

    public function deleteData($materialDeleteId)
    {
        $deleteData = material::find($materialDeleteId);
        $deleteData->delete();
        self::toast("success", "Berhasil menghapus data " . $deleteData->title);
    }
    private function toast($toast, $message)
    {
        $this->dispatchBrowserEvent('alert', [
            'type' => $toast,
            'message' => $message
        ]);
    }
}