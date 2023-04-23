<?php

namespace App\Http\Livewire\Pages\School\Classes;

use Carbon\Carbon;
use App\Models\Classes;
use Livewire\Component;
use App\Models\attendance;
use Illuminate\Support\Str;
use Livewire\WithPagination;
use App\Helpers\ToastHelpers;

class ViewClasses extends Component
{
    public $classes;
    public $classesName;
    public $classesSubject;

    // attendances public
    public bool $isAbsensi;
    public $attendances;
    public $completedAbsensi;
    public $lateTime;

    public $pagination = 10;
    protected $paginationTheme = 'bootstrap';

    use WithPagination;

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
                ToastHelpers::info($this, "Waktu absensi dimulai pukul 07:20");
                $this->isAbsensi = 1;
            }
            if ($timeAttendances->gt($timeEnd)) {
                $this->isAbsensi = 0;
                ToastHelpers::info($this, "Waktu absensi berakhir pukul 17:00");
            }
            if ($this->completedAbsensi) {
                ToastHelpers::info($this, "Anda sudah absensi hari ini! Kembali esok hari.");
                return;
            }
            if ($timeAttendances->gte($timeStart) && $timeAttendances->lte($timeEnd)) {
                $twentyFourHoursLater = $timeEnd->copy()->addHours(24);
                if ($timeAttendances->gte($twentyFourHoursLater)) {
                    ToastHelpers::info($this, "Anda tidak diperbolehkan absensi karena sudah lebih dari 24 jam dari waktu absensi berakhir.");
                    $this->isAbsensi = 0;
                    return;
                }
                $isAttendanceLate = false;
                $message = "Yeay absensi pada pelajaran " . $this->classes->name . " berhasil";
            } else {
                $isAttendanceLate = true;
                $this->lateTime = $timeEnd->diff($timeAttendances)->format('%h jam %i menit');
                $message = "Anda terlambat absensi selama " . $this->lateTime;
            }
            attendance::create([
                'id' => Str::uuid(),
                'date_attendance' => Carbon::now(),
                'isAbsensi' => $isAttendanceLate ? 0 : 1,
                'user_id' => auth()->user()->id,
                'classes_id' => $this->classes->id,
            ]);
            $this->completedAbsensi = true;
            ToastHelpers::success($this, $isAttendanceLate ? $message : $message);
        } catch (\Exception $e) {
            ToastHelpers::error($this, $e->getMessage());
        }
    }
    public function render()
    {
        $attendancesId = attendance::with("users:id,username")
        ->orderByDesc("date_attendance")
        ->where("classes_id", $this->classes->id)->where("user_id", auth()->user()->id)->paginate($this->pagination);
        return view('livewire.pages.school.classes.view-classes', [
            'reportAttendance' => $attendancesId
        ]);
    }
}
