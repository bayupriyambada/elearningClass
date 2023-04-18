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
        $this->classesId = Classes::select('id', 'name', 'code')->findOrFail($classesId);
    }
    public function render()
    {
        $materials = material::where("classes_id", $this->classesId->id)
            ->where('user_id', auth()->user()->id)->select("id", "title", "url")
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
