<?php

namespace App\Http\Livewire\Pages\School\Classes;

use App\Models\Classes;
use Livewire\Component;

class Join extends Component
{
    public $code;

    public function joinClass()
    {
        try {
            $join = Classes::where('code', $this->code)->first();
            if (!$join) {
                self::toast("error", "Kode tidak ditemukan");
                $this->code = '';
            } else {
                self::toast("success", "Kode ditemukan, beralih ke halaman..");
                return redirect(route('school.classes.view', [$join->id]));
            }
        } catch (\Throwable $th) {
            self::toast("error", $th->getMessage());
        }
    }
    public function render()
    {
        return view('livewire.pages.school.classes.join');
    }
    private function toast($toast, $message)
    {
        $this->dispatchBrowserEvent('alert', [
            'type' => $toast,
            'message' => $message
        ]);
    }
}
