<?php

namespace App\Http\Livewire\Pages\School\Classes\Materials;

use App\Models\Classes;
use Livewire\Component;
use App\Models\material;

class Views extends Component
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
    public function render()
    {
        return view('livewire.pages.school.classes.materials.views');
    }
}
