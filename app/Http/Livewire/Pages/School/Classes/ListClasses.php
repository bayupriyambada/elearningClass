<?php

namespace App\Http\Livewire\Pages\School\Classes;

use App\Models\Classes;
use Livewire\Component;
use Livewire\WithPagination;

class ListClasses extends Component
{
    // public $classesId;
    public $materialDeleteId;
    use WithPagination;
    public $perPage = 10;
    // public function mount($classesId)
    // {
    //     $this->classesId = Classes::where('user_id', auth()->user()->id)
    //         ->select('id', 'name')->findOrFail($classesId);
    // }
    public function deleteData($listClassId)
    {
        $deleteData = Classes::find($listClassId);
        $deleteData->delete();
        self::toast("success", "Berhasil menghapus data " . $deleteData->title);
    }
    public function render()
    {
        return view('livewire.pages.school.classes.list-classes', [
            'classesByUser' => Classes::where('user_id', auth()->user()->id)
                ->select('id', 'name')->orderByDesc('created_at')->paginate(10)
        ]);
    }
    private function toast($toast, $message)
    {
        $this->dispatchBrowserEvent('alert', [
            'type' => $toast,
            'message' => $message
        ]);
    }
}
