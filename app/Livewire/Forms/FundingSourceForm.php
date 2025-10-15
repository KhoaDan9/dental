<?php

namespace App\Livewire\Forms;

use App\Models\FundingSource;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Validate;
use Livewire\Form;

class FundingSourceForm extends Form
{
    public FundingSource $funding_source;

    #[Validate('required', message: 'Vui lòng nhập tên nguồn quỹ.')]
    public $name = '';
    public $clinic_id = '';
    public $type_of_transaction = [];
    public $note = '';
    public $active = 1;
    public $last_update_name = '';

    public function setAttributes(FundingSource $funding_source)
    {
        $this->funding_source = $funding_source;

        $this->name = $funding_source->name;
        $this->clinic_id = $funding_source->clinic_id;
        $this->type_of_transaction = $funding_source->type_of_transaction;
        $this->active = $funding_source->active;
        $this->note = $funding_source->note;
        $this->last_update_name = $funding_source->last_update_name;
    }

    public function store()
    {
        FundingSource::create([
            'name' => $this->name,
            'note' => $this->note,
            'clinic_id' => $this->clinic_id,
            'type_of_transaction' => $this->type_of_transaction,
            'active' => $this->active,
            'last_update_name' => Auth::user()->username
        ]);
        $this->reset(['name', 'note', 'type_of_transaction']);
    }

    public function update()
    {
        $this->last_update_name = Auth::user()->username;
        $this->funding_source->update(
            $this->only(['name', 'note', 'clinic_id', 'type_of_transaction', 'active', 'last_update_name'])
        );
    }
}
