<?php

namespace App\Http\Livewire\Pages\Users\Students;

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
    protected $user;
    public int $offset = 0;
    public Collection $students;

    public bool $showLoadMoreButton;

    public function resetPassword($dataId)
    {
        try {
            $this->user->find($dataId)->update([
                'password' => Hash::make('password')
            ]);
            ToastHelpers::success($this, "Berhasil reset kata sandi");
            return redirect(back());
        } catch (\Exception $e) {
            ToastHelpers::error($this, $e->getMessage());
        }
    }
    public function mount()
    {
        $this->loadData();
    }
    public function loadData($search = '')
    {
        $users = User::query()
            ->roleStudents()
            ->where('username', 'like', '%' . $search . '%')
            ->orderByDesc("created_at")
            ->offset(($this->page - 1) * $this->pagination)
            ->limit($this->pagination)->get();
        $this->students = isset($this->students) ? $this->students->merge($users) : $users;
        $this->offset += $this->pagination;
        $this->showLoadMoreButton = User::roleStudents()->count() > $this->offset;
    }
    public function resetList()
    {
        $this->students = collect([]);
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
            $deleteData = User::roleStudents()->find($dataId);
            $deleteData->delete();
            $this->materials->forget($this->materials->search(function ($item, $key) use ($dataId) {
                return $item->id === $dataId;
            }));
            ToastHelpers::success($this, "Berhasil menghapus data user" . $deleteData->username);
        } catch (\Exception $e) {
            ToastHelpers::success($this, $e->getMessage());
        }
    }
    public function render()
    {
        return view('livewire.pages.users.students.index');
    }
}
