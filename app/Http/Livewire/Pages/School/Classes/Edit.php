<?php

namespace App\Http\Livewire\Pages\School\Classes;

use App\Models\Classes;
use Livewire\Component;
use App\Helpers\ToastHelpers;

class Edit extends Component
{
    public $editClasses;
    public $name;
    public $subject;
    public $code;
    protected $rules = [
        'name' => 'required|string|min:1',
        'subject' => 'nullable',
    ];
    public function mount($classesId)
    {
        $this->editClasses = Classes::where("user_id", auth()->user()->id)->findOrFail($classesId);
        $this->name = $this->editClasses->name;
        $this->subject = $this->editClasses->subject;
        $this->code = $this->editClasses->code;
        if (auth()->user()->role_id === 3) {
            abort(403);
        }
    }
    public function update()
    {
        $this->validate();
        try {
            $this->editClasses->update([
                'name' => $this->name,
                'subject' => $this->subject,
                'code' => $this->code,
                'user_id' => auth()->user()->id
            ]);
            ToastHelpers::success($this, "Berhasil memperbaharui data pelajaran");
            redirect(route('school.classes.list'));
        } catch (\Exception $e) {
            ToastHelpers::error($this, $e->getMessage());
            redirect(route('school.classes.list'));
        }
    }
    public function render()
    {
        return view('livewire.pages.school.classes.edit');
    }
}
