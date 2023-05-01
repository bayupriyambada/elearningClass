<?php

namespace App\Http\Livewire\Pages\School;

use App\Helpers\ToastHelpers;
use App\Models\Classes;
use App\Models\JoinLesson;
use App\Models\Lesson;
use App\Models\SubLesson;
use App\Models\TaskSubLesson;
use Livewire\Component;

class Dashboard extends Component
{
    public $showModal = false;
    public $classesForm;
    public $classesId;
    public $passcode;
    public function createForm()
    {
        $this->showModal = true;
        $this->classesForm = null;
        $this->classesId = null;
    }
    public function close()
    {
        $this->showModal = false;
    }

    public function joinLesson()
    {
        $checkPasscode = Lesson::where('passcode', $this->passcode)->first();
        if (strlen($this->passcode) > 10) {
            ToastHelpers::info($this, "Kode anda melebihi 10 karakter");
            $this->passcode = '';
        } else if (!$checkPasscode) {
            ToastHelpers::warning($this, "Kode yang anda masukan tidak ditemukan");
            $this->passcode = '';
        } else {
            $joinCheck = JoinLesson::where("user_id", auth()->user()->id)
                ->where("lesson_id", $checkPasscode->id)->first();
            if (!$joinCheck) {
                JoinLesson::create([
                    'user_id' => auth()->user()->id,
                    'lesson_id' => $checkPasscode->id,
                    'isJoin' => 1
                ]);
            }
            ToastHelpers::success($this, "Kode ditemukan, mengunjungi halaman.");
            return redirect(route('school.classes.sub.list', [$checkPasscode->id]));
        }
    }
    public function render()
    {

        $joinLessonCheck = JoinLesson::where("user_id", auth()->user()->id)
            ->whereHas("lesson", function ($q) {
                $q->select("id", "lesson_categories_id")
                ->with(["lessonCategory:id,name", "user:id,username"]);
            })
            ->get();
        $classes = Lesson::where('user_id', auth()->user()->id)
            ->with(["user:id,username", "lessonCategory"])
            ->withCount("subLesson")
            ->orderByDesc("created_at")
        ->get();
        // dd($classes);
        return view('livewire.pages.school.dashboard', [
            'classes' => $classes,
            'joinLessonCheck' => $joinLessonCheck,
        ]);
    }
}
