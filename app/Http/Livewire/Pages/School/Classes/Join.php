<?php

namespace App\Http\Livewire\Pages\School\Classes;

use App\Models\Classes;
use Livewire\Component;
use App\Helpers\ToastHelpers;
use App\Models\Lesson;
use Exception;

class Join extends Component
{
    public $code;
    public function joinClass()
    {
        try {
            $join = Lesson::where('passcode', $this->code)->first();
            if (!$join) {
                ToastHelpers::error($this, "Kode tidak dapat ditemukan");
                $this->code = '';
            } else {
                ToastHelpers::success($this, "Kode ditemukan, mengunjungi halaman.");
                // return redirect(route('school.classes.view', [$join->id]));
                return redirect(route('school.classes.sub.index', [$join->id]));
            }
        } catch (Exception $e) {
            ToastHelpers::error($this, $e->getMessage());
        }
    }
    public function render()
    {
        return view('livewire.pages.school.classes.join');
    }
}
