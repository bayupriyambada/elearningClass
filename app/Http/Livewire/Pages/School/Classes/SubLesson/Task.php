<?php

namespace App\Http\Livewire\Pages\School\Classes\SubLesson;

use App\Models\Lesson;
use Livewire\Component;
use App\Models\SubLesson;
use App\Helpers\ToastHelpers;
use App\Models\TaskSubLesson;

class Task extends Component
{
    public $lesson;
    public $subLesson;
    public $taskLessonId;
    public $taskLesson;
    public $urlSubmit;

    public $showModal = false;
    public function mount($lessonId, $subLessonId)
    {
        $this->lesson = Lesson::with(["lessonCategory"])->findOrFail($lessonId);
        $this->subLesson = SubLesson::with("user")
            ->where("user_id", auth()->user()->id)
            ->where("isStatus", "task")
            ->where("lesson_id", $this->lesson->id)->findOrFail($subLessonId);
    }

    public function close()
    {
        $this->showModal = false;
    }

    public function modalTask($taskLessonId)
    {
        $this->showModal = true;
        $this->taskLessonId = $taskLessonId;
        $this->taskLesson = TaskSubLesson::find($taskLessonId);
        $this->urlSubmit = $this->taskLesson->url_submit;
    }

    protected function rules()
    {
        return [
            'taskLesson.information' => 'nullable|string|max:255',
            'taskLesson.grade' => 'required|numeric',
        ];
    }

    public function saveTask()
    {
        try {
            $this->validate();

            if (!is_null($this->taskLessonId)) {
                $this->taskLesson->update([
                    'taskLesson.information' => $this->taskLesson['information'],
                    'taskLesson.grade' => $this->taskLesson['grade'],
                    'rated' => 1,
                    'time_rated' => now()
                ]);
                ToastHelpers::success($this, "Berhasil memberikan penilaian tugas");
            }
            $this->showModal = false;
        } catch (\Exception $e) {
            ToastHelpers::error($this, $e->getMessage());
        }
    }
    public function render()
    {
        $taskSubmit = TaskSubLesson::with("user")
        ->where("sub_lesson_id", $this->subLesson->id)->orderByDesc("created_at")->get();
        return view('livewire.pages.school.classes.sub-lesson.task', [
            'taskSubmit' => $taskSubmit
        ]);
    }
}
