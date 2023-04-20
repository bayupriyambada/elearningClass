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
        try {
            $this->validate();

            $credentials = [
                'email' => $this->email,
                'password' => $this->password
            ];

            if (Auth::attempt($credentials)) {
                if (auth()->user()->role->id === 1) {
                    ToastHelpers::success($this, "Berhasil masuk ke dalam aplikasi");
                    return redirect(route("dashboard"));
                } else {
                    ToastHelpers::success($this, "Berhasil masuk ke dalam aplikasi");
                    return redirect(route("school.dashboard"));
                }
            } else {
                ToastHelpers::error($this, "Terjadi kesalahan pada akun anda.");
            }
        } catch (\Exception $e) {
            ToastHelpers::error($this, $e->getMessage());
        }
    }
    public function render()
    {
        return view('livewire.auth.login-component')->layout("layouts.auth");
    }
}
