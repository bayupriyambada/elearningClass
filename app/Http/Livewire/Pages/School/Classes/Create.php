<?php

namespace App\Http\Livewire\Pages\School\Classes;

use App\Models\Classes;
use Livewire\Component;
use Illuminate\Support\Str;

class Create extends Component
{
    public $name;
    public $subject;

    protected $rules = [
        'name' => 'required|string|min:1',
        'subject' => 'nullable',
    ];
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
            self::toast("success", "Berhasil menambahkan data pelajaran.");
            redirect(route('school.classes.index'));
        } catch (\Throwable $th) {
            self::toast("error", $th->getMessage());
            redirect(route('school.classes.index'));
        }
    }
    public function render()
    {
        return view('livewire.pages.school.classes.create');
    }

    private function toast($toast, $message)
    {
        $this->dispatchBrowserEvent('alert', [
            'type' => $toast,
            'message' => $message
        ]);
    }
}
