<?php

namespace App\Http\Livewire\Pages;

use App\Models\User;
use Livewire\Component;

class Profile extends Component
{
    public $profile;
    public function mount($username)
    {

        $this->profile = User::where('username', $username)->firstOrFail();
        if (!$this->profile !== auth()->user()->username) {
            return redirect()->back();
        }
    }
    public function render()
    {
        return view('livewire.pages.profile');
    }
}
