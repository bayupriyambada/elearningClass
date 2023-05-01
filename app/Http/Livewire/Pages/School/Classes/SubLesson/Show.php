<?php

namespace App\Http\Livewire\Pages\School\Classes\SubLesson;

use App\Models\Lesson;
use Livewire\Component;
use App\Models\SubLesson;
use Illuminate\Support\Str;
use App\Helpers\ToastHelpers;
use App\Models\TaskSubLesson;

class Show extends Component
{
    public $lesson;
    public $subLesson;
    public function mount($lessonId, $subLessonId)
    {
        $this->lesson = Lesson::with(["lessonCategory"])->findOrFail($lessonId);
        $this->subLesson = SubLesson::with("user")
            ->where("user_id", auth()->user()->id)
            ->where("isPublish", "publish")
            ->where("lesson_id", $this->lesson->id)->findOrFail($subLessonId);
    }


    public function render()
    {
        return view('livewire.pages.school.classes.sub-lesson.show');
    }
}
