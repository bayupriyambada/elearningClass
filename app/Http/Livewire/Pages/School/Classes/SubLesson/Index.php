<?php

namespace App\Http\Livewire\Pages\School\Classes\SubLesson;

use App\Models\Lesson;
use Livewire\Component;
use Illuminate\Support\Str;
use Livewire\WithPagination;
use App\Helpers\ToastHelpers;
use App\Models\SubLesson;

class Index extends Component
{
    public $lessonId;
    public $lesson;

    public $showModal = false;
    public $showModalDelete = false;
    public $subLessonId;
    public $subLesson;
    public $title;
    public $isPublish;
    public $isStatus;

    public $selectedSubLesson = [];
    public bool $bulkDisabled = true;

    use WithPagination;
    public function mount($lessonId)
    {
        $this->lesson = Lesson::with("lessonCategory")
            ->where("user_id", auth()->user()->id)
            ->findOrFail($lessonId);
    }

    protected $rules = [
        'subLesson.title' => 'required|string|min:1|max:255',
        'subLesson.content' => 'required|string|min:1',
        'subLesson.isPublish' => 'required|in:draft,publish',
        'subLesson.isStatus' => 'required|in:material,task',
    ];

    public function edit($subLessonId)
    {
        $this->showModal = true;
        $this->subLessonId = $subLessonId;
        $this->subLesson = SubLesson::find($subLessonId);
        $this->emit('reinit', [
            'subLesson' => $this->subLesson,
        ]);
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
                ToastHelpers::success($this, "Berhasil memperbaharui sub pelajaran");
            } else {
                SubLesson::create([
                    'id' => Str::uuid(),
                    'title' => ucwords($this->subLesson['title']),
                    'content' => $this->subLesson['content'],
                    'isPublish' => $this->subLesson['isPublish'],
                    'isStatus' => $this->subLesson['isStatus'],
                    'user_id' => auth()->user()->id,
                    'lesson_id' => $this->lesson->id,
                ]);
                ToastHelpers::success($this, "Berhasil menambahkan sub pelajaran");
            }
            $this->showModal = false;
            $this->reset([
                'id', "title", "content", "isPublish", "isStatus"
            ]);
        } catch (\Exception $e) {
            ToastHelpers::error($this, $e->getMessage());
        }
    }

    public function close()
    {
        $this->showModal = false;
        $this->subLesson = null;
        $this->subLessonId = null;
        $this->reset(['subLesson']);
        $this->emit('reinit', null);
    }

    public function confirmDelete($subLessonId)
    {
        $this->showModalDelete = true;
        $this->subLessonId = $subLessonId;
        $this->subLesson = SubLesson::find($subLessonId);
        $this->title = $this->subLesson['title'];
    }
    public function closeDelete()
    {
        $this->showModalDelete = false;
    }
    public function deleted()
    {
        $this->subLesson = SubLesson::find($this->subLessonId);
        $this->subLesson->delete();
        ToastHelpers::success($this, "Berhasil menghapus sub pelajaran: " . $this->subLesson->title);
        $this->showModalDelete = false;
    }
    public function deleteSelected()
    {
        SubLesson::query()
            ->whereIn('id', $this->selectedSubLesson)
            ->delete();
        $this->selectedSubLesson = [];
        ToastHelpers::success($this, "Berhasil menghapus sub pelajaran");
    }

    public function render()
    {
        $this->bulkDisabled = count($this->selectedSubLesson) < 1;
        return view('livewire.pages.school.classes.sub-lesson.index', [
            'subLessons' => SubLesson::with("lesson.lessonCategory")
                ->where("lesson_id", $this->lesson->id)
                ->orderBy("created_at", "asc")
                ->get()
        ]);
    }
}
