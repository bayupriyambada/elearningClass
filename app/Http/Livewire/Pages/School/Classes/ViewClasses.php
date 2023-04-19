<?php

namespace App\Http\Livewire\Pages\School\Classes;

use Carbon\Carbon;
use App\Models\Classes;
use Livewire\Component;
use App\Models\attendance;
use Illuminate\Support\Str;

class ViewClasses extends Component
{
    public $classes;
    public $classesName;
    public $classesSubject;
    // attendances public
    public $isAbsensi;
    public $attendances;
    public $completedAbsensi;

    public function mount($classesId)
    {
        $this->classes = Classes::findOrFail($classesId);
        $this->attendances = attendance::where('user_id', auth()->user()->id)
            ->where("classes_id", $this->classes->id)
            ->whereDate('date_attendance', Carbon::today())
            ->first();
        $this->completedAbsensi = !is_null($this->attendances);
    }

    public function submitAttendances()
    {
        try {
            $timeAttendances = Carbon::now();
            $timeStart = Carbon::today()->setHour(7)->setMinute(20)->setSecond(0);
            $timeEnd = Carbon::today()->setHour(17)->setMinute(0)->setSecond(0);

            if ($timeAttendances->lt($timeStart)) {
                self::toast("info", "Waktu absensi dimulai pukul 07:20");
                return;
            }
            if ($timeAttendances->gt($timeEnd)) {
                self::toast("info", "Waktu absensi berakhir pukul 17:00");
                return;
            }
            if ($this->completedAbsensi) {
                self::toast("info", "Anda sudah absensi hari ini! Kembali esok hari.");
                return;
            }
            attendance::create([
                'id' => Str::uuid(),
                'date_attendance' => Carbon::now(),
                'isAbsensi' => 1,
                'user_id' => auth()->user()->id,
                'classes_id' => $this->classes->id,
            ]);
            $this->completedAbsensi = true;
            self::toast("success", "Yeay absensi pada pelajaran " . $this->classes->name . " berhasil");
            $this->emit("updateCompletedAttendances");
        } catch (\Throwable $th) {
            self::toast("error", $th->getMessage());
        }
    }
    public function render()
    {
        $attendancesId = attendance::with("users:id,username")->where("classes_id", $this->classes->id)->where("user_id", auth()->user()->id)->get();
        return view('livewire.pages.school.classes.view-classes', [
            'reportAttendance' => $attendancesId
        ]);
    }
    private function toast($toast, $message)
    {
        $this->dispatchBrowserEvent('alert', [
            'type' => $toast,
            'message' => $message
        ]);
    }
}
