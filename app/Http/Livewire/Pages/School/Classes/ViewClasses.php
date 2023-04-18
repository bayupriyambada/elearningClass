<?php

namespace App\Http\Livewire\Pages\School\Classes;

use App\Models\Classes;
use Livewire\Component;

class ViewClasses extends Component
{
    public $classes;
    public $classesName;
    public $classesSubject;
    public function mount($classesId)
    {
        $this->classes = Classes::findOrFail($classesId);
    }
    public function render()
    {
        return view('livewire.pages.school.classes.view-classes');
    }
}
