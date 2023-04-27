<?php

namespace App\Http\Livewire\Pages\School\Classes\Materials;

use App\Models\Classes;
use Livewire\Component;
use App\Models\material;
use Livewire\WithPagination;
use App\Helpers\ToastHelpers;
use Illuminate\Support\Collection;

class Index extends Component
{
    public $classesId;
    public $materialDeleteId;
    public int $amount = 10;
    public int $offset = 0;
    public Collection $materials;

    public bool $showLoadMoreButton;
    public function mount($classesId)
    {
        $this->classesId = Classes::with("user:id,username")->select('id', 'name', "user_id")->findOrFail($classesId);
        $this->loadData();
    }
    public function loadData()
    {
        $material = material::query()
            ->where("classes_id", $this->classesId->id)
            ->with("user:id,username")
            ->select("id", "title", "url", "user_id")
            ->orderByDesc("created_at")
        ->offset($this->offset)->limit($this->amount)->get();
        $this->materials = isset($this->materials) ? $this->materials->merge($material) : $material;

        $this->offset += $this->amount;

        $this->showLoadMoreButton = material::count() > $this->offset;
    }
    public function render()
    {
        return view('livewire.pages.school.classes.materials.index');
    }

    public function deleteData($materialDeleteId)
    {
        try {
            $deleteData = material::find($materialDeleteId);
            $deleteData->delete();
            $this->materials->forget($this->materials->search(function ($item, $key) use ($materialDeleteId) {
                return $item->id === $materialDeleteId;
            }));
            ToastHelpers::success($this, "Berhasil menghapus data " . $deleteData->title);
        } catch (\Exception $e) {
            ToastHelpers::success($this, $e->getMessage());
        }
    }
}
