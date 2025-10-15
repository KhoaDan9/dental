<?php

namespace App\Livewire\Forms;

use App\Models\PatientService;
use App\Models\WarrantyCard;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Validate;
use Livewire\Form;

class WarrantyCardForm extends Form
{
    public ?WarrantyCard $warranty_card = null;
    public ?PatientService $patient_service = null;

    public $patient_name = '';
    public $service_name = '';
    public $card_id = '';
    public $expiration_date = null;
    public $warranty_status = 'Không phát hành';
    public $note = '';
    public $last_update_name = '';
    public $message = '';

    public function setAttributes(PatientService $patient_service)
    {
        $this->patient_service = $patient_service;

        $this->patient_name = $patient_service->patient->name;
        $this->service_name = $patient_service->service_name;
        if ($patient_service->warrantyCard != null) {
            $warranty_card = $patient_service->warrantyCard;
            $this->warranty_card = $warranty_card;

            $this->service_name = $warranty_card->service_name;
            $this->card_id = $warranty_card->card_id;
            $this->expiration_date = $warranty_card->expiration_date;
            $this->warranty_status = $warranty_card->warranty_status;
            $this->note = $warranty_card->note;
            $this->last_update_name = $warranty_card->last_update_name;
        }
    }

    public function update()
    {
        $this->last_update_name = Auth::user()->username;
        if ($this->warranty_card == null) {
            $warranty_card = WarrantyCard::create(
                [
                    'clinic_id' => $this->patient_service->patient->clinic_id,
                    'patient_service_id' => $this->patient_service->id,
                    'service_name' => $this->service_name,
                    'card_id' => $this->card_id,
                    'expiration_date' => $this->expiration_date,
                    'warranty_status' => $this->warranty_status,
                    'note' => $this->note,
                    'last_update_name' => $this->last_update_name
                ]
            );
            $this->warranty_card = $warranty_card;
            $this->message = 'Thêm thông tin thẻ bảo hành thành công!';
        } else {
            if ($this->warranty_status == 'Không phát hành') {
                $this->card_id = null;
                $this->expiration_date = null;
                $this->warranty_card->update(
                    $this->only(['card_id', 'expiration_date', 'warranty_status', 'note', 'last_update_name'])
                );

                $this->message = 'Xóa thông tin thẻ bảo hành thành công!';
            } else {
                $this->warranty_card->update(
                    $this->only(['card_id', 'expiration_date', 'warranty_status', 'note', 'last_update_name'])
                );
                $this->message = 'Sửa thông tin thẻ bảo hành thành công!';
            }
        }
    }
}
