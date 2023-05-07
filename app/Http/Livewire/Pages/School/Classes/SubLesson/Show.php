<?php

namespace App\Http\Livewire\Pages\School\Classes\SubLesson;

use App\Models\Lesson;
use Livewire\Component;
use App\Models\SubLesson;
use App\Helpers\ToastHelpers;

class Show extends Component
{
    public $lesson;
    public $subLesson;
    public $isOpen;

    protected $listeners = ['openCloseTask', '$refresh'];
    public function mount($lessonId, $subLessonId)
    {
        $this->lesson = Lesson::with(["lessonCategory"])->findOrFail($lessonId);
        $this->subLesson = SubLesson::with("user")
            ->where("user_id", auth()->user()->id)
            ->where("isPublish", "publish")
            ->where("lesson_id", $this->lesson->id)->findOrFail($subLessonId);
    }

    public function openCloseTask()
    {
        $subLesson = SubLesson::where('isStatus', 'task')->findOrFail($this->subLesson->id);
        if (!$subLesson->isOpen) {
            $subLesson->update(['isOpen' => 1]);
            ToastHelpers::success($this, "Berhasil membuka susulan tugas");
        } else if ($subLesson->isOpen) {
            $subLesson->update(['isOpen' => 0]);
            ToastHelpers::success($this, "Telah menutup susulan tugas");
        }
    }


    public function render()
    {
        return view('livewire.pages.school.classes.sub-lesson.show');
    }
}
