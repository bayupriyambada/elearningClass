<?php

namespace App\Http\Livewire\Auth;

use App\Helpers\ToastHelpers;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class LoginComponent extends Component
{
    public $email;
    public $password;

    protected $rules = [
        'password' => 'required',
        'email' => 'required|email',
    ];

    public function loginHandle()
    {
        $this->validate();

        $credentials = [
            'email' => $this->email,
            'password' => $this->password
        ];

        if (Auth::attempt($credentials)) {
            if (auth()->user()->role->id === 1) {
                self::toast("success", "Berhasil masuk ke dalam aplikasi");
                return redirect(route("dashboard"));
            } else {
                self::toast("success", "Berhasil masuk ke dalam aplikasi");
                return redirect(route("school.dashboard"));
            }
        } else {
            self::toast("erorr", "Terjadi kesalahan pada akun anda.");
        }
    }
    public function render()
    {
        return view('livewire.auth.login-component')->layout("layouts.auth");
    }

    private function toast($toast, $message)
    {
        $this->dispatchBrowserEvent('alert', [
            'type' => $toast,
            'message' => $message
        ]);
    }
}
