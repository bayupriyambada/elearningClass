<?php

namespace App\Http\Livewire\Pages\Users\Students;

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
    public $userStudentId;
    public $userStudent;
    public $username;

    public bool $showLoadMoreButton;

    public function updatingSearch()
    {
        $this->resetPage();
    }

    protected function rules()
    {
        return [
            'userStudent.username' => 'required|string|min:1|max:255',
            'userStudent.fullname' => 'required|string|min:1|max:300',
            'userStudent.email' => 'required|string|email|unique:users,email,' . $this->userStudentId
        ];
    }

    protected $messages = [
        'userStudent.email.unique' => "Email ini telah dipakai"
    ];

    public function edit($userStudentId)
    {
        $this->showModal = true;
        $this->userStudentId = $userStudentId;
        $this->userStudent = User::roleStudents()->find($userStudentId);
    }

    public function createForm()
    {
        $this->showModal = true;
        $this->userStudent = null;
        $this->userStudentId = null;
    }

    public function save()
    {
        try {
            $this->validate();

            if (!is_null($this->userStudentId)) {
                $this->userStudent->save();
                ToastHelpers::success($this, "Berhasil memperbaharui data siswa");
            } else {
                User::create([
                    'id' => Str::uuid(),
                    'username' => Str::lower($this->userStudent['username']),
                    'fullname' => ucwords($this->userStudent['fullname']),
                    'email' => $this->userStudent['email'],
                    'registrationCode' => Date('Y') . Str::random(8),
                    'role_id' => 3,
                    'email_verified_at' => now(),
                    'password' => Hash::make("password")
                ]);
                ToastHelpers::success($this, "Berhasil menambahkan siswa baru");
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

    public function confirmDelete($userStudentId)
    {
        $this->showModalConfirm = true;
        $this->userStudentId = $userStudentId;
        $this->userStudent = User::roleStudents()->find($userStudentId);
        $this->username = $this->userStudent['username'];
        $this->text = 'Apakah anda ingin menghapus siswa dengan nama ' . $this->username . ' ?';
    }

    public function closeConfirm()
    {
        $this->showModalConfirm = false;
    }

    public function deleted()
    {
        try {
            $this->userStudent = User::roleStudents()->find($this->userStudentId);
            $this->userStudent->delete();
            ToastHelpers::success($this, "Berhasil hapus siswa : " . $this->userStudent->username);
            $this->showModalConfirm = false;
        } catch (\Exception $e) {
            ToastHelpers::error($this, $e->getMessage());
        }
    }


    public function resetPassword($userStudentId)
    {
        $this->showModalConfirm = true;
        $this->userStudentId = $userStudentId;
        $this->userStudent = User::roleStudents()->find($userStudentId);
        $this->username = $this->userStudent['username'];
        $this->text = 'Apakah anda ingin atur ulang sandi siswa dengan nama ' . $this->username . ' ?';
    }
    public function resetPass()
    {
        try {
            $this->userStudent = User::roleStudents()->find($this->userStudentId);
            $this->userStudent->update([
                'password' => Hash::make('password')
            ]);
            ToastHelpers::success($this, "Berhasil atur ulang sandi siswa : " . $this->userStudent->username);
            $this->showModalConfirm = false;
        } catch (\Exception $e) {
            ToastHelpers::error($this, $e->getMessage());
        }
    }

    public function modalAction()
    {
        if ($this->text == 'Apakah anda ingin menghapus siswa dengan nama ' . $this->username . ' ?') {
            $this->deleted();
        } else {
            $this->resetPass();
        }
    }

    public function importData()
    {
        // $data = Excel
    }

    public function render()
    {
        return view('livewire.pages.users.students.index', [
            'userStudents' => User::query()
                ->roleStudents()
                ->where('username', 'like', '%' . $this->search . '%')
                ->orderByDesc("created_at")
                ->paginate(20)
        ]);
    }
}
