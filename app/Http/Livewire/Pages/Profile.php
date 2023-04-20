<?php

namespace App\Http\Livewire\Pages;

use App\Models\User;
use Livewire\Component;
use App\Helpers\ToastHelpers;
use Illuminate\Support\Facades\Hash;

class Profile extends Component
{
    public $profileId;
    public $profile;
    public $username;
    public $fullname;
    public $email;
    public $phone;
    public $address;
    public $avatar;
    public $registrationCode;
    public $password;
    public $oldPassword;
    public function mount()
    {
        $this->profile = User::where("id", auth()->user()->id)->firstOrFail();
        $this->profileId = $this->profile->id;
        $this->username = $this->profile->username;
        $this->fullname = $this->profile->fullname;
        $this->email = $this->profile->email;
        $this->phone = $this->profile->phone;
        $this->address = $this->profile->address;
        $this->oldPassword = $this->profile->password;
        $this->registrationCode = $this->profile->registrationCode;
    }

    protected $rules = [
        'username' => 'required|string|min:1',
        'fullname' => 'required|string|min:1',
        'avatar' => 'nullable',
        'phone' => 'nullable',
        'address' => 'nullable',
    ];
    public function updateProfile()
    {
        try {
            $this->validate();
            if ($this->password) {
                $password = Hash::make($this->password);
            } else {
                $password = $this->oldPassword;
            }
            User::where('id', $this->profileId)->update([
                'username' => $this->username,
                'fullname' => $this->fullname,
                'phone' => $this->phone,
                'avatar' => $this->avatar,
                'address' => $this->address,
                'password' => $password
            ]);
            ToastHelpers::success($this, "Berhasil memperbaharui data diri");
            if (auth()->user()->role_id === 1) {
                redirect(route('dashboard'));
            } else {
                redirect(route('school.dashboard'));
            }
        } catch (\Exception $e) {
            ToastHelpers::success($this, $e->getMessage());
            if (auth()->user()->role_id === 1) {
                redirect(route('dashboard'));
            } else {
                redirect(route('school.dashboard'));
            }
        }
    }
    public function render()
    {
        return view('livewire.pages.profile');
    }
}
