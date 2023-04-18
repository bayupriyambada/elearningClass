<?php

namespace App\Http\Livewire\Auth;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class LogoutComponent extends Component
{
    public function logoutHandle()
    {
        Auth::logout();
        request()->session()->flush();
        request()->session()->regenerate();
        self::toast("success", "Berhasil keluar aplikasi");
        return redirect(route('login'));
    }
    public function render()
    {
        return view('livewire.auth.logout-component');
    }

    private function toast($toast, $message)
    {
        $this->dispatchBrowserEvent('alert', [
            'type' => $toast,
            'message' => $message
        ]);
    }
}
