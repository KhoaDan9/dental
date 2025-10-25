<?php

namespace App\Livewire\Appointment;

use App\Models\Appointment;
use App\Models\Patient;
use Carbon\Carbon;
use Illuminate\Database\QueryException;
use Livewire\Component;
use Livewire\Attributes\Title;


#[Title('Quản lý lịch hẹn')]
class IndexAppointment extends Component
{
    public Patient $patient;
    public $appointments = [];
    public $from_date = '';
    public $to_date = '';

    public $successMessage = '';
    public $errorMessage = '';


    public function mount()
    {
        $this->from_date = Carbon::now()->format('Y-m-d');
        $this->to_date = Carbon::now()->addDays(3)->format('Y-m-d');
    }

    public function searchAppointment()
    {
        $this->appointments = Appointment::orderBy('date')->whereBetween('date', [
            $this->from_date,
            $this->to_date
        ])
            ->get()
            ->groupBy(function ($appointment) {
                $date = $appointment->date->format('d/m/Y');
                $dayName = ucwords($appointment->date->dayName);
                return "$date - $dayName";
            })
            ->map(function ($group) {
                return $group->sortBy('date');
            });
    }

    public function deleteAppointment(Appointment $appointment)
    {
        $this->reset(['successMessage', 'errorMessage']);

        try {
            $appointment->delete();
            $this->successMessage = 'Xóa lịch hẹn thành công!';
        } catch (QueryException $e) {
            $this->errorMessage = 'Đã xảy ra lỗi khi xóa lịch hẹn. Vui lòng thử lại sau!';
        }
    }

    public function render()
    {
        $this->searchAppointment();
        return view('livewire.appointment.index-appointment');
    }
}
