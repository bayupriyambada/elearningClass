<?php

namespace App\Http\Livewire\Pages\Users\Teacher;

use App\Models\User;
use Livewire\Component;
use Illuminate\Support\Str;
use App\Helpers\ToastHelpers;
use Illuminate\Support\Facades\Hash;
use Livewire\WithPagination;

class Index extends Component
{
    public $search = '';
    public $pagination = 12;
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $showModal = false;
    public $showModalConfirm = false;
    public $text = '';
    public $userTeacherId;
    public $userTeacher;
    public $username;

    public bool $showLoadMoreButton;

    public function updatingSearch()
    {
        $this->resetPage();
    }

    protected function rules()
    {
        return [
            'userTeacher.username' => 'required|string|min:1|max:255',
            'userTeacher.fullname' => 'required|string|min:1|max:300',
            'userTeacher.email' => 'required|string|email|unique:users,email,' . $this->userTeacherId
        ];
    }

    protected $messages = [
        'userTeacher.email.unique' => "Email ini telah dipakai"
    ];

    public function edit($userTeacherId)
    {
        $this->showModal = true;
        $this->userTeacherId = $userTeacherId;
        $this->userTeacher = User::roleTeachers()->find($userTeacherId);
    }

    public function createForm()
    {
        $this->showModal = true;
        $this->userTeacher = null;
        $this->userTeacherId = null;
    }

    public function save()
    {
        try {
            $this->validate();

            if (!is_null($this->userTeacherId)) {
                $this->userTeacher->save();
                ToastHelpers::success($this, "Berhasil memperbaharui data tenaga didik");
            } else {
                User::create([
                    'id' => Str::uuid(),
                    'username' => Str::lower($this->userTeacher['username']),
                    'fullname' => ucwords($this->userTeacher['fullname']),
                    'email' => $this->userTeacher['email'],
                    'registrationCode' => Date('Y') . Str::random(8),
                    'role_id' => 3,
                    'email_verified_at' => now(),
                    'password' => Hash::make("password")
                ]);
                ToastHelpers::success($this, "Berhasil menambahkan tenaga didik baru");
            }
            $this->showModal = false;
        } catch (\Exception $e) {
            ToastHelpers::error($this, $e->getMessage());
        }
    }

    public function close()
    {
        $this->showModal = false;
    }

    public function confirmDelete($userTeacherId)
    {
        $this->showModalConfirm = true;
        $this->userTeacherId = $userTeacherId;
        $this->userTeacher = User::roleTeachers()->find($userTeacherId);
        $this->username = $this->userTeacher['username'];
        $this->text = 'Apakah anda ingin menghapus siswa dengan nama ' . $this->username . ' ?';
    }

    public function closeConfirm()
    {
        $this->showModalConfirm = false;
    }

    public function deleted()
    {
        try {
            $this->userTeacher = User::roleTeachers()->find($this->userTeacherId);
            $this->userTeacher->delete();
            ToastHelpers::success($this, "Berhasil hapus siswa : " . $this->userTeacher->username);
            $this->showModalConfirm = false;
        } catch (\Exception $e) {
            ToastHelpers::error($this, $e->getMessage());
        }
    }


    public function resetPassword($userTeacherId)
    {
        $this->showModalConfirm = true;
        $this->userTeacherId = $userTeacherId;
        $this->userTeacher = User::roleTeachers()->find($userTeacherId);
        $this->username = $this->userTeacher['username'];
        $this->text = 'Apakah anda ingin atur ulang sandi tenaga didik dengan nama ' . $this->username . ' ?';
    }
    public function resetPass()
    {
        try {
            $this->userTeacher = User::roleTeachers()->find($this->userTeacherId);
            $this->userTeacher->update([
                'password' => Hash::make('password')
            ]);
            ToastHelpers::success($this, "Berhasil atur ulang sandi tenaga didik : " . $this->userTeacher->username);
            $this->showModalConfirm = false;
        } catch (\Exception $e) {
            ToastHelpers::error($this, $e->getMessage());
        }
    }

    public function modalAction()
    {
        if ($this->text == 'Apakah anda ingin menghapus tenaga didik dengan nama ' . $this->username . ' ?') {
            $this->deleted();
        } else {
            $this->resetPass();
        }
    }

    public function render()
    {
        return view('livewire.pages.users.teacher.index', [
            'userTeachers' => User::query()
                ->roleTeachers()
                ->where('username', 'like', '%' . $this->search . '%')
                ->orderByDesc("created_at")
                ->paginate(20)
        ]);
    }
}
