<?php

namespace App\Http\Livewire\Pages\Users\Teacher;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;
use App\Helpers\ToastHelpers;
use Illuminate\Support\Facades\Hash;

class Index extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $search;
    protected $queryString = ['search'];
    public $pagination = 12;

    protected $listeners = ['render', '$refresh'];

    public function updatingSearch()
    {
        $this->resetPage();
    }
    public function deleteData($dataId)
    {
        try {
            $deleteData = $this->user->find($dataId);
            $deleteData->delete();
            ToastHelpers::success($this, "Berhasil menghapus data " . $deleteData->username);
        } catch (\Exception $e) {
            ToastHelpers::success($this, $e->getMessage());
        }
    }
    public function resetPassword($dataId)
    {
        try {
            User::where("role_id", 2)->find($dataId)->update([
                'password' => Hash::make('password')
            ]);
            ToastHelpers::success($this, "Berhasil reset kata sandi");
            return redirect(back());
        } catch (\Exception $e) {
            ToastHelpers::error($this, $e->getMessage());
        }
    }
    public function render()
    {
        $userTeachers = User::where("role_id", 2)
            ->orderByDesc("created_at")
            ->where('username', 'like', '%' . $this->search . '%')
            ->paginate($this->pagination);
        return view('livewire.pages.users.teacher.index', [
            'userTeachers' => $userTeachers
        ]);
    }
}
