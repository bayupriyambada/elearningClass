<?php

namespace App\Http\Livewire\Pages\School\Classes\Materials;

use App\Models\Classes;
use Livewire\Component;
use App\Models\material;

class Edit extends Component
{
    public $classesId;
    public $materialsId;
    public $materials;
    public $title;
    public $subject;
    public $url;

    public function mount($classesId, $materialsId)
    {
        $this->classesId = Classes::findOrFail($classesId);
        $this->materials = material::findOrFail($materialsId);
        $this->materialsId = $this->materials->id;
        $this->title = $this->materials->title;
        $this->subject = $this->materials->subject;
        $this->url = $this->materials->url;
    }
    protected $rules = [
        'title' => 'required|string|min:1',
        'subject' => 'nullable',
        'url' => 'required',
    ];
    public function updateData()
    {
        $this->validate();

        try {
            material::where('id', $this->materialsId)->update([
                'title' => $this->title,
                'subject' => $this->subject,
                'url' => $this->url,
                'user_id' => auth()->user()->id,
                'classes_id' => $this->classesId->id
            ]);
            self::toast("success", "Berhasil merubah data materi.");
            redirect(route('school.classes.materials.index', [$this->classesId->id]));
        } catch (\Throwable $th) {
            self::toast("error", $th->getMessage());
            redirect(route('school.classes.materials.index', [$this->classesId->id]));
        }
    }
    public function render()
    {
        return view('livewire.pages.school.classes.materials.edit');
    }
    private function toast($toast, $message)
    {
        $this->dispatchBrowserEvent('alert', [
            'type' => $toast,
            'message' => $message
        ]);
    }
}