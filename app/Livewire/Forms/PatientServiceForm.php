<?php

namespace App\Livewire\Forms;

use App\Models\PatientService;
use App\Models\WarrantyCard;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Validate;
use Livewire\Form;

class PatientServiceForm extends Form
{
    public PatientService $patient_service;
    public $patient_id = '';
    public $service_id = '';

    #[Validate('required', message: 'Vui lòng chọn thủ thuật điều trị.')]
    public $service_name = '';
    public $symptom = '';
    public $diagnosis = '';
    public $teeth = '';
    public $price = '';
    public $total_price = '';
    public $quantity = 1;
    public $discount1 = 0;
    public $discount2 = 0;
    public $employee_id = '';
    public $supporter_id = null;
    public $visit_count = '';
    public $date = '';
    public $note = '';
    public $id = '';
    public $last_update_name = '';
//    public $warranty_card = false;
    public $successMessage = '';

    public function store()
    {
        if($this->supporter_id == $this->employee_id)
            $this->supporter_id =null;

        $patient_service = PatientService::create([
            'patient_id' => $this->patient_id,
            'symptom' => $this->symptom,
            'service_name' => $this->service_name,
            'diagnosis' => $this->diagnosis,
            'teeth' => $this->teeth,
            'price' => (int) str_replace('.', '', $this->price),
            'total_price' => (int) str_replace('.', '', $this->total_price),
            'quantity' => $this->quantity,
            'discount1' => (int) str_replace('.', '', $this->discount1),
            'discount2' => (int) str_replace('.', '', $this->discount2),
            'employee_id' => $this->employee_id,
            'supporter_id' => $this->supporter_id,
            'note' => $this->note,
            'last_update_name' => Auth::user()->username,
            'date' => $this->date,
            'visit_count' => $this->visit_count
        ]);
//        if ($this->warranty_card == true) {
//            WarrantyCard::create([
//                'patient_service_id' => $patient_service->id,
//                'service_name' => $this->service_name,
//                'warranty_status' => 'Chưa có thẻ'
//            ]);
//        }

        $this->reset(['symptom', 'service_name', 'diagnosis', 'teeth', 'price', 'total_price', 'quantity', 'discount1', 'discount2']);
        $this->id = $patient_service->id;
    }

    public function update()
    {
        $this->last_update_name = Auth::user()->username;
        if($this->supporter_id == $this->employee_id)
            $this->supporter_id = '';

//        if ($this->warranty_card == false && $this->patient_service->warrantyCard != null) {
//            $this->patient_service->warrantyCard->delete();
//        } else if ($this->warranty_card == true && $this->patient_service->warrantyCard == null) {
//            WarrantyCard::create([
//                'patient_service_id' => $this->patient_service->id,
//                'service_name' => $this->service_name,
//                'warranty_status' => 'Chưa có thẻ'
//            ]);
//        }
        $this->patient_service->update(
            [
            'symptom' => $this->symptom,
            'service_name' => $this->service_name,
            'diagnosis' => $this->diagnosis,
            'teeth' => $this->teeth,
            'price' => (int) str_replace('.', '', $this->price),
            'total_price' => (int) str_replace('.', '', $this->total_price),
            'quantity' => $this->quantity,
            'discount1' => (int) str_replace('.', '', $this->discount1),
            'discount2' => (int) str_replace('.', '', $this->discount2),
            'employee_id' => $this->employee_id,
            'supporter_id' => $this->supporter_id,
            'note' => $this->note,
            'last_update_name' => $this->last_update_name,
            'date' => $this->date,
            'visit_count' => $this->visit_count
            ]
        );

        $this->successMessage = "Chỉnh sửa thông tin thủ thuật điều trị thành công!";
    }

    public function setAttributes(PatientService $patient_service)
    {
        $this->patient_service = $patient_service;

//        if ($this->patient_service->warrantyCard != null)
//            $has_warranty_card = true;
//        else
//            $has_warranty_card = false;

        $this->symptom = $patient_service->symptom;
        $this->service_name = $patient_service->service_name;
        $this->diagnosis = $patient_service->diagnosis;
        $this->teeth = $patient_service->teeth;
        $this->price = number_format($patient_service->price, 0, ',', '.');
        $this->total_price = number_format($patient_service->total_price, 0, ',', '.');
        $this->quantity = $patient_service->quantity;
        $this->discount1 = $patient_service->discount1;
        $this->discount2 = number_format($patient_service->discount2, 0, ',', '.');
        $this->employee_id = $patient_service->employee_id;
        $this->supporter_id = $patient_service->supporter_id;
        $this->last_update_name = $patient_service->last_update_name;
        $this->date = Carbon::parse($patient_service->date)->format('Y-m-d H:i');
//        $this->warranty_card = $has_warranty_card;
        $this->visit_count = $patient_service->visit_count;
        $this->note = $patient_service->note;
    }
}
