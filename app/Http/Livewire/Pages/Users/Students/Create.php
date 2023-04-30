<?php

namespace App\Http\Livewire\Pages\Users\Students;

use App\Helpers\ToastHelpers;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;
use Illuminate\Support\Str;

class Create extends Component
{
    public $username;
    public $fullname;
    public $email;

    protected $rules = [
        'username' => 'required|string|min:3|max:100',
        'fullname' => 'required|string|max:200',
        'email' => 'required|email|unique:users,email',
    ];
    public function create()
    {
        $this->validate();
        try {
            User::create(['id' => Str::uuid(),
                'username' => $this->username,
                'fullname' => $this->fullname,
                'email' => $this->email,
                'registrationCode' => Date('Y') . Str::random(8),
                'role_id' => 3,
                'password' => Hash::make("password")
            ]);
            ToastHelpers::success($this, "Berhasil menambahkan data siswa");
            redirect(route("users.students.index"));
        } catch (\Exception $e) {
            ToastHelpers::error($this, $e->getMessage());
            redirect(route('users.students.index'));
        }
    }
    public function render()
    {
        return view('livewire.pages.users.students.create');
    }
}
