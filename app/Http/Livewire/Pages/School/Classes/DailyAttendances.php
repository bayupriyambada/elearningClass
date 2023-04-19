<?php

namespace App\Http\Livewire\Pages\School\Classes;

use Carbon\Carbon;
use Livewire\Component;
use Carbon\CarbonPeriod;
use App\Models\attendance;
use Livewire\WithPagination;

class DailyAttendances extends Component
{
    public $tanggal_awal;
    public $tanggal_akhir;
    public $absensi_harian;
    public $total_absensi;
    public $date;
    use WithPagination;

    // protected $listeners = ['absensiStored' => '$refresh'];

    // public function updated($field, $value)
    // {
    //     $this->getAbsensiHarian();
    // }
    public function mount()
    {
        $this->date = collect();

        $monthStartDate = Carbon::now()->startOfMonth();
        $monthEndDate = Carbon::now()->endOfMonth();

        for ($date = $monthStartDate->copy(); $date->lte($monthEndDate); $date->addDay()) {
            $this->date->push($date->copy());
        }
    }
    public function render()
    {
        // $start = Carbon::now()->startOfMonth()->endOfMonth();
        // dd($start);
        return view('livewire.pages.school.classes.daily-attendances', [
            'date' => $this->date
        ]);
    }
}
