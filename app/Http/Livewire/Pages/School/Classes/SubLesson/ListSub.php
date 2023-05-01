<?php

namespace App\Http\Livewire\Pages\School\Classes\SubLesson;

use App\Models\Lesson;
use Livewire\Component;
use Livewire\WithPagination;
use App\Helpers\ToastHelpers;
use App\Models\JoinLesson;
use App\Models\SubLesson;

class ListSub extends Component
{
    public $lessonId;
    public $lesson;

    use WithPagination;
    public function mount($lessonId)
    {
        $this->lesson = Lesson::with("lessonCategory")->findOrFail($lessonId);
        $checkJoin = JoinLesson::where("lesson_id", $this->lesson->id)
            ->where("user_id", auth()->user()->id)
            ->where("isJoin", 1)
            ->first();
        if (!$checkJoin) {
            ToastHelpers::error($this, "Kamu belum gabung kelas, silahkan masukkan dengan passcode");
            return redirect(route("school.dashboard"));
        }
    }
    public function render()
    {
        return view('livewire.pages.school.classes.sub-lesson.list-sub', [
            'subLessons' => SubLesson::with("lesson.lessonCategory")
                ->where("lesson_id", $this->lesson->id)->get()
        ]);
    }
}
