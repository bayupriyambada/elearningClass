<?php

namespace App\Http\Livewire\Pages\School\Classes\Assignments;

use App\Models\Classes;
use Livewire\Component;
use App\Models\assignment;
use Illuminate\Support\Str;
use App\Helpers\ToastHelpers;

class Create extends Component
{
    public $classesId;
    public $materials;
    public $title;
    public $subject;
    public $url;
    public $due_date;
    public $end_date;

    public function mount($classesId)
    {
        $this->classesId = Classes::findOrFail($classesId);
    }
    protected $rules = [
        'title' => 'required|string|min:1',
        'subject' => 'nullable',
        'url' => 'required',
        'due_date' => 'required',
        'end_date' => 'required',
    ];
    public function create()
    {
        $this->validate();

        try {
            $test = assignment::create([
                'id' => Str::uuid(),
                'title' => $this->title,
                'subject' => $this->subject,
                'url' => $this->url,
                'user_id' => auth()->user()->id,
                'classes_id' => $this->classesId->id,
                'due_date' => $this->due_date,
                'end_date' => $this->end_date
            ]);
            ToastHelpers::success($this, "Berhasil menambahkan data tugas");
            redirect(route('school.classes.assignments.index', [$this->classesId->id]));
        } catch (\Exception $e) {
            dd($e->getMessage());
            ToastHelpers::error($this, $e->getMessage());
            redirect(route('school.classes.assignments.index', [$this->classesId->id]));
        }
    }
    public function render()
    {
        return view('livewire.pages.school.classes.assignments.create');
    }
}
