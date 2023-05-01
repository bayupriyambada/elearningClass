<?php

namespace App\Http\Livewire\Pages\School\Classes\SubLesson;

use App\Models\Lesson;
use Livewire\Component;
use App\Models\SubLesson;
use Illuminate\Support\Str;
use App\Helpers\ToastHelpers;
use App\Models\TaskSubLesson;

class View extends Component
{
    public $lesson;
    public $subLesson;
    public $submitTask;
    public $submitTaskId;
    public $existsTaskId;
    public $url_submit;
    public $buttonLabel;
    public $readOnly;
    public function mount($lessonId, $subLessonId)
    {
        $this->lesson = Lesson::with(["lessonCategory"])->findOrFail($lessonId);
        $this->subLesson = SubLesson::with("user")
            ->where("isPublish", "publish")
            ->where("lesson_id", $this->lesson->id)->findOrFail($subLessonId);

        $this->submitTask = TaskSubLesson::where("user_id", auth()->user()->id)->where("sub_lesson_id", $this->subLesson->id)->first();
        $this->url_submit = $this->submitTask->url_submit ?? null;
        if (!is_null($this->submitTask)) {
            $this->buttonLabel = "Perbaharui Tugas";
        } else {
            $this->buttonLabel = "Kirim Tugas";
        }
        $this->readOnly = !$this->existsTaskId;
    }

    public function enabledEditForm()
    {
        $this->readOnly = false;
    }

    protected $rules = [
        'submitTask.url_submit' => 'required|string',
    ];

    protected $messages = [
        'submitTask.url_submit.required' => "Jawaban tidak boleh kosong"
    ];

    public function submitTask()
    {
        try {

            $this->validate();

            $this->existsTaskId = TaskSubLesson::where("sub_lesson_id", $this->subLesson->id)->where("user_id", auth()->user()->id)->first();
            if (!is_null($this->existsTaskId)) {
                $this->existsTaskId->update([
                    'url_submit' => $this->submitTask['url_submit'],
                ]);
                ToastHelpers::success($this, "Berhasil memperbaharui tugas");
            } else {
                TaskSubLesson::create([
                    'id' => Str::uuid(),
                    'url_submit' => $this->submitTask['url_submit'],
                    'sub_lesson_id' => $this->subLesson->id,
                    'user_id' => auth()->user()->id,
                ]);
                ToastHelpers::success($this, "berhasil mengirimkan tugas");
            }

            $this->buttonLabel = "Perbaharui Tugas";
            $this->readOnly = true;
        } catch (\Exception $e) {
            ToastHelpers::error($this, $e->getMessage());
        }
    }

    public function changeButtonLabel($newLabel)
    {
        $this->buttonLabel = $newLabel;
    }


    public function render()
    {
        return view('livewire.pages.school.classes.sub-lesson.view');
    }
}
