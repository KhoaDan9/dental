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
        $this->from_date = Carbon::now('Asia/Ho_Chi_Minh')->format('Y-m-d');
        $this->to_date = Carbon::now('Asia/Ho_Chi_Minh')->addDays(3)->format('Y-m-d');

        $this->searchAppointment();
    }

    public function searchAppointment()
    {
        $daysInVietnamese = [
            'Sunday' => 'Chủ Nhật',
            'Monday' => 'Thứ Hai',
            'Tuesday' => 'Thứ Ba',
            'Wednesday' => 'Thứ Tư',
            'Thursday' => 'Thứ Năm',
            'Friday' => 'Thứ Sáu',
            'Saturday' => 'Thứ Bảy',
        ];
        $this->appointments = Appointment::orderBy('date')->whereBetween('date', [
            $this->from_date,
            $this->to_date
        ])
            ->get()
            ->groupBy(function ($appointment) use ($daysInVietnamese) {
                $date = $appointment->date->format('d/m/Y');
                $dayName = $daysInVietnamese[$appointment->date->dayName];
                return "$date - $dayName";
            })
            ->map(function ($group) {
                return $group->sortBy('date');
            });
    }

    public function deleteAppointment(Appointment $appointment)
    {
        try {
            $appointment->delete();
            $this->successMessage = 'Xóa lịch hẹn thành công!';
        } catch (QueryException $e) {
            $this->errorMessage = 'Đã xảy ra lỗi khi xóa lịch hẹn. Vui lòng thử lại sau!';
        }
    }

    public function render()
    {
        return view('livewire.appointment.index-appointment');
    }
}
