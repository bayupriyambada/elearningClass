<?php

namespace App\Http\Livewire\Pages\Users\Teacher;

use App\Models\User;
use Livewire\Component;
use App\Helpers\ToastHelpers;

class Edit extends Component
{
    public $teacherId;
    public $teachers;
    public $username;
    public $fullname;
    public $email;
    public $avatar;

    public function mount($dataId)
    {
        dd($dataId);
        // $this->teachers = User::where('role_id', 2)->findOrFail($dataId);
        // $this->teacherId = $this->teachers->id;
        // $this->username = $this->teachers->username;
        // $this->fullname = $this->teachers->fullname;
        // $this->email = $this->teachers->email;
    }
    protected $rules = [
        'username' => 'required|string|min:1',
        'fullname' => 'required|string|min:1',
        'avatar' => 'nullable',
    ];
    public function update()
    {
        $this->validate();
        try {
            User::where('id', $this->studentId)->update([
                'username' => $this->username,
                'fullname' => $this->fullname,
                'avatar' => $this->avatar,
                'role_id' => 3
            ]);
            ToastHelpers::success($this, "Berhasil memperbaharui data user");
            redirect(route('users.teachers.index'));
        } catch (\Exception $e) {
            ToastHelpers::success($this, $e->getMessage());
            redirect(route('users.teachers.index'));
        }
    }
    public function render()
    {
        return view('livewire.pages.users.teacher.edit');
    }
}
