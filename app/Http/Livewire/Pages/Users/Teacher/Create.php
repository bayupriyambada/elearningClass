<?php

namespace App\Http\Livewire\Pages\Users\Teacher;

use App\Models\User;
use Livewire\Component;
use Illuminate\Support\Str;
use App\Helpers\ToastHelpers;
use Illuminate\Support\Facades\Hash;

class Create extends Component
{
    public $username;
    public $fullname;
    public $email;
    public $avatar;

    protected $rules = [
        'username' => 'required|string|min:3|max:100|unique:users,username',
        'fullname' => 'required|string|max:200',
        'email' => 'required|email|unique:users,email',
        'avatar' => 'nullable'
    ];
    public function create()
    {
        try {
            User::create([
                'id' => Str::uuid(),
                'username' => $this->username,
                'fullname' => $this->fullname,
                'email' => $this->email,
                'registrationCode' => Date('Y') . Str::random(8),
                'role_id' => 2,
                'avatar' => $this->avatar,
                'password' => Hash::make("password")
            ]);
            ToastHelpers::success($this, "Berhasil menambahkan data tenaga didik");
            redirect(route("users.teachers.index"));
        } catch (\Exception $e) {
            ToastHelpers::error($this, $e->getMessage());
            redirect(route('users.teachers.index'));
        }
    }
    public function render()
    {
        return view('livewire.pages.users.teacher.create');
    }
}
