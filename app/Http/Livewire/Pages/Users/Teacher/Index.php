<?php

namespace App\Http\Livewire\Pages\Users\Teacher;

use App\Models\User;
use Livewire\Component;
use App\Helpers\ToastHelpers;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Hash;

class Index extends Component
{
    public $search = '';
    public $page = 1;
    public $pagination = 12;
    public int $offset = 0;
    public Collection $teachers;
    public bool $showLoadMoreButton;

    public function mount()
    {
        $this->loadData();
    }
    public function loadData($search = '')
    {
        $users = User::query()
            ->roleTeachers()
            ->where('username', 'like', '%' . $search . '%')
            ->orderByDesc("created_at")
            ->offset(($this->page - 1) * $this->pagination)
            ->limit($this->pagination)->get();
        $this->teachers = isset($this->teachers) ? $this->teachers->merge($users) : $users;
        $this->offset += $this->pagination;
        $this->showLoadMoreButton = User::roleTeachers()->count() > $this->offset;
    }
    public function resetList()
    {
        $this->teachers = collect([]);
        $this->page = 1;
    }
    public function updatedSearch($value)
    {
        $this->resetList();
        $this->loadData($value);
    }
    public function loadMore()
    {
        $this->page++;
        $this->loadData($this->search);
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
            User::roleTeachers()->find($dataId)->update([
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
        return view('livewire.pages.users.teacher.index');
    }
}
