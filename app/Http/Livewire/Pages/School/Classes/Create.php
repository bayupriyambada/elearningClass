<?php

namespace App\Http\Livewire\Pages\School\Classes;

use App\Models\Classes;
use Livewire\Component;
use Illuminate\Support\Str;
use App\Helpers\ToastHelpers;

class Create extends Component
{
    public $name;
    public $subject;

    protected $rules = [
        'name' => 'required|string|min:1',
        'subject' => 'nullable',
    ];

    public function mount()
    {
        if (auth()->user()->role_id === 3) {
            abort(403);
        }
    }
    public function create()
    {
        $this->validate();
        try {
            Classes::create([
                'name' => $this->name,
                'subject' => $this->subject,
                'code' => Str::random(10),
                'user_id' => auth()->user()->id
            ]);
            ToastHelpers::success($this, "Berhasil menambahkan data pelajaran");
            redirect(route('school.classes.list'));
        } catch (\Exception $e) {
            ToastHelpers::error($this, $e->getMessage());
            redirect(route('school.classes.list'));
        }
    }
    public function render()
    {
        return view('livewire.pages.school.classes.create');
    }
}
