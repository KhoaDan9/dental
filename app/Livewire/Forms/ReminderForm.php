<?php

namespace App\Livewire\Forms;

use App\Models\Reminder;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Validate;
use Livewire\Form;

class ReminderForm extends Form
{
    public ?Reminder $reminder;

    #[Validate('required', message: 'Vui lòng nhập tên lời dặn.')]
    public $name = '';
    public $active = 1;
    public $clinic_id = '';
    public $note = '';
    public $detail = '';
    public $last_update_name = '';

    public function store()
    {
        Reminder::create([
            'name' => $this->name,
            'active' => $this->active,
            'note' => $this->note,
            'detail' => $this->detail,
            'clinic_id' => $this->clinic_id,
            'last_update_name' => Auth::user()->username
        ]);
        $this->reset(['name', 'note', 'detail']);
    }

    public function setAttributes(Reminder $reminder)
    {
        $this->reminder = $reminder;

        $this->name = $reminder->name;
        $this->clinic_id = $reminder->clinic_id;
        $this->active = $reminder->active;
        $this->note = $reminder->note;
        $this->detail = $reminder->detail;
        $this->last_update_name = $reminder->last_update_name;
    }

    public function update()
    {
        $this->last_update_name = Auth::user()->username;
        $this->reminder->update(
            $this->only(['name', 'clinic_id', 'active', 'note', 'detail', 'last_update_name'])
        );
    }
}
