<?php

namespace App\Http\Livewire\Pages\School\Classes;

use App\Models\Classes;
use Livewire\Component;
use Livewire\WithPagination;
use App\Helpers\ToastHelpers;

class ListClasses extends Component
{
    public $materialDeleteId;
    use WithPagination;
    public $perPage = 10;
    public function deleteData($listClassId)
    {
        try {
            $deleteData = Classes::find($listClassId);
            $deleteData->delete();
            ToastHelpers::success($this, "Berhasil menghapus data " . $deleteData->title);
        } catch (\Exception $e) {
            ToastHelpers::error($this, $e->getMessage());
        }
    }
    public function render()
    {
        return view('livewire.pages.school.classes.list-classes', [
            'classesByUser' => Classes::where('user_id', auth()->user()->id)
                ->withCount("materials")
                ->orderByDesc('created_at')->paginate(10)
        ]);
    }
}
