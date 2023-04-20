<?php

namespace App\Http\Livewire\Pages\Users\Students;

use App\Models\User;
use Livewire\Component;
use App\Helpers\ToastHelpers;

class Edit extends Component
{
    public $studentId;
    public $students;
    public $username;
    public $fullname;
    public $email;
    public $avatar;

    public function mount($studentId)
    {
        $this->students = User::where('role_id', 3)->findOrFail($studentId);
        $this->studentId = $this->students->id;
        $this->username = $this->students->username;
        $this->fullname = $this->students->fullname;
        $this->email = $this->students->email;
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
            redirect(route('users.students.index'));
        } catch (\Exception $e) {
            ToastHelpers::success($this, $e->getMessage());
            redirect(route('users.students.index'));
        }
    }
    public function render()
    {
        return view('livewire.pages.users.students.edit');
    }
}
