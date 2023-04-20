<?php

namespace App\Http\Livewire\Auth;

use Livewire\Component;
use App\Helpers\ToastHelpers;
use Illuminate\Support\Facades\Auth;

class LogoutComponent extends Component
{
    public function logoutHandle()
    {
        Auth::logout();
        request()->session()->flush();
        request()->session()->regenerate();
        ToastHelpers::success($this, "Berhasil keluar aplikasi");
        return redirect(route('login'));
    }
    public function render()
    {
        return view('livewire.auth.logout-component');
    }
}
