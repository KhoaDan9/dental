<?php

namespace App\Livewire\Forms;

use App\Models\Finance;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Validate;
use Livewire\Form;

class FinanceForm extends Form
{
    public Finance $finance;

    #[Validate('required', message: 'Vui lòng nhập tên nhóm thu/chi.')]
    public $name = '';
    public $clinic_id = '';
    public $group = 'Nội bộ';
    public $item = [];
    public $receipt = false;
    public $payment = false;
    public $note = '';
    public $active = 1;
    public $last_update_name = '';

    public function setAttributes(Finance $finance)
    {
        $this->finance = $finance;

        $this->name = $finance->name;
        $this->clinic_id = $finance->clinic_id;
        $this->group = $finance->group;
        $this->active = $finance->active;
        $this->note = $finance->note;
        $this->last_update_name = $finance->last_update_name;
    }

    public function store()
    {
        $this->payment = in_array('payment', $this->item);
        $this->receipt = in_array('receipt', $this->item);

        Finance::create([
            'name' => $this->name,
            'note' => $this->note,
            'clinic_id' => $this->clinic_id,
            'group' => $this->group,
            'receipt' => $this->receipt,
            'payment' => $this->payment,
            'active' => $this->active,
            'last_update_name' => Auth::user()->username
        ]);
        $this->reset(['name', 'note', 'group', 'item']);
    }

    public function update()
    {
        $this->payment = in_array('payment', $this->item);
        $this->receipt = in_array('receipt', $this->item);
        $this->last_update_name = Auth::user()->username;
        $this->finance->update(
            $this->only(['name', 'note', 'clinic_id', 'group', 'receipt', 'payment', 'active', 'last_update_name'])
        );
    }
}
