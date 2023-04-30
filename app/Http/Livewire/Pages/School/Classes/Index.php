<?php

namespace App\Http\Livewire\Pages\School\Classes;

use App\Models\Classes;
use Livewire\Component;
use Illuminate\Support\Str;
use Livewire\WithPagination;
use App\Helpers\ToastHelpers;
use App\Models\Lesson;
use App\Models\lesson_categories;
use PhpParser\Builder\Class_;

class Index extends Component
{

    public $showModal = false;
    public $showModalDelete = false;
    public $classesId;
    public $classes;
    public $name;

    public $materialDeleteId;
    use WithPagination;
    public $perPage = 10;

    protected $rules = [
        'classes.lesson_categories_id' => 'required',
    ];
    public function edit($classesId)
    {
        $this->showModal = true;
        $this->classesId = $classesId;
        $this->classes = Lesson::find($classesId);
    }

    public function createForm()
    {
        $this->showModal = true;
        $this->classes = null;
        $this->classesId = null;
    }

    public function save()
    {
        try {
            $this->validate();

            if (!is_null($this->classesId)) {
                $existingCategory = Lesson::where('lesson_categories_id', $this->classes['lesson_categories_id'])->first();
                if ($existingCategory) {
                    ToastHelpers::info($this, "Tidak dapat mengubah ke pelajaran yang sama");
                } else {
                    $this->classes->save();
                }
                ToastHelpers::success($this, "Berhasil memperbaharui pelajaran");
            } else {
                $existingCategory = Lesson::where('lesson_categories_id', $this->classes['lesson_categories_id'])->first();
                if ($existingCategory) {
                    ToastHelpers::info($this, "Telah mempunyai pelajaran yang sama");
                } else {
                    Lesson::create([
                        'id' => Str::uuid(),
                        'lesson_categories_id' => $this->classes['lesson_categories_id'],
                        'passcode' => Str::random(10),
                        'user_id' => auth()->user()->id
                    ]);
                    ToastHelpers::success($this, "Berhasil menambahkan pelajaran");
                }
            }
            $this->showModal = false;
        } catch (\Exception $e) {
            ToastHelpers::error($this, $e->getMessage());
        }
    }

    public function close()
    {
        $this->showModal = false;
    }

    public function confirmDelete($classesId)
    {
        $this->showModalDelete = true;
        $this->classesId = $classesId;
        $this->classes = Lesson::find($classesId);
        $this->name = $this->classes['lesson_categories_id'];
    }

    public function closeDelete()
    {
        $this->showModalDelete = false;
    }

    public function deleted()
    {
        $this->classes = Lesson::find($this->classesId);
        $this->classes->delete();
        ToastHelpers::success($this, "Berhasil hapus pelajaran");
        $this->showModalDelete = false;
    }

    public function render()
    {
        $lessonCategories = lesson_categories::latest()->get();
        $lessonByUser = Lesson::where("user_id", auth()->user()->id)
            ->with("lessonCategory")
            ->orderByDesc("created_at")->paginate(12);
        return view('livewire.pages.school.classes.index', [
            'classesByUser' => Classes::where('user_id', auth()->user()->id)
                ->withCount("materials", "assignments")
                ->orderByDesc('created_at')->paginate(10),
            'lessonCategories' => $lessonCategories,
            'lessonByUser' => $lessonByUser,
        ]);
    }
}
