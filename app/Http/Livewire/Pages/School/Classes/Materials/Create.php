<?php

namespace App\Http\Livewire\Pages\School\Classes\Materials;

use App\Models\Classes;
use Livewire\Component;
use App\Models\material;
use Illuminate\Support\Str;
use App\Helpers\ToastHelpers;

class Create extends Component
{
    public $classesId;
    public $materials;
    public $title;
    public $subject;
    public $url;

    public function mount($classesId)
    {
        $this->classesId = Classes::findOrFail($classesId);
    }
    protected $rules = [
        'title' => 'required|string|min:1',
        'subject' => 'nullable',
        'url' => 'required',
    ];
    public function create()
    {
        $this->validate();

        try {
            material::create([
                'id' => Str::uuid(),
                'title' => $this->title,
                'subject' => $this->subject,
                'url' => $this->url,
                'user_id' => auth()->user()->id,
                'classes_id' => $this->classesId->id
            ]);
            ToastHelpers::success($this, "Berhasil menambahkan data materi");
            redirect(route('school.classes.materials.index', [$this->classesId->id]));
        } catch (\Exception $e) {
            ToastHelpers::error($this, $e->getMessage());
            redirect(route('school.classes.materials.index', [$this->classesId->id]));
        }
    }
    public function render()
    {
        return view('livewire.pages.school.classes.materials.create');
    }
}
