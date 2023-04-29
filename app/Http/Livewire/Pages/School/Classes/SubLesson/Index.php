<?php

namespace App\Http\Livewire\Pages\School\Classes\SubLesson;

use App\Models\Lesson;
use Livewire\Component;
use Illuminate\Support\Str;
use Livewire\WithPagination;
use App\Helpers\ToastHelpers;
use App\Models\lesson_categories;
use App\Models\SubLesson;

class Index extends Component
{
    public $lessonId;
    public $lesson;

    public $showModal = false;
    public $showModalDelete = false;
    public $subLessonId;
    public $subLesson;
    public $name;

    use WithPagination;
    public function mount($lessonId)
    {
        $this->lesson = Lesson::with("lessonCategory")->findOrFail($lessonId);
    }

    protected $rules = [
        'subLesson.title' => 'required|string|min:1|max:255',
        'subLesson.content' => 'required|string|min:1',
    ];

    public function edit($subLessonId)
    {
        $this->showModal = true;
        $this->subLessonId = $subLessonId;
        $this->subLesson = SubLesson::find($subLessonId);
    }

    public function createForm()
    {
        $this->showModal = true;
        $this->subLesson = null;
        $this->subLessonId = null;
    }

    public function save()
    {
        try {
            $this->validate();

            if (!is_null($this->subLessonId)) {
                $this->subLesson->save();
                ToastHelpers::success($this, "Berhasil memperbaharui pelajaran");
            } else {

                SubLesson::create([
                    'id' => Str::uuid(),
                    'title' => ucwords($this->subLesson['title']),
                    'content' => ucwords($this->subLesson['content']),
                    'user_id' => auth()->user()->id,
                    'lesson_id' => $this->lesson->id,
                ]);
                ToastHelpers::success($this, "Berhasil menambahkan pelajaran");
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

    public function confirmDelete($subLessonId)
    {
        $this->showModalDelete = true;
        $this->subLessonId = $subLessonId;
        $this->subLesson = lesson_categories::find($subLessonId);
        $this->name = $this->subLesson['name'];
    }

    public function closeDelete()
    {
        $this->showModalDelete = false;
    }

    public function deleted()
    {
        $this->subLesson = lesson_categories::find($this->subLessonId);
        $this->subLesson->delete();
        ToastHelpers::success($this, "Berhasil hapus kategori pelajaran: " . $this->subLesson->name);
        $this->showModalDelete = false;
    }
    public function render()
    {
        return view('livewire.pages.school.classes.sub-lesson.index', [
            'subLessons' => SubLesson::with("lesson")
                ->where("user_id", auth()->user()->id)
                ->orderByDesc('created_at')->paginate(12)
        ]);
    }
}
