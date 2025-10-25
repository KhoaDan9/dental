<?php

namespace App\Livewire\Category\Reminder;

use App\Livewire\Forms\ReminderForm;
use App\Models\Clinic;
use App\Models\Reminder;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\Attributes\Title;


#[Title('Mẫu lời dặn')]
class ActionReminder extends Component
{
    public ReminderForm $form;
    public Reminder $reminder;
    public $successMessage = '';
    public $errorMessage = '';

    public $clinics = [];
    public $is_create = '';

    public function mount($value)
    {
        $this->clinics = Clinic::all();

        try {
            if ($value == 'create') {
                $this->is_create = 'create';
                $this->form->clinic_id = $this->clinics[0]->id;
            } else {
                $this->reminder = Reminder::where('id', $value)->get()[0];
                $this->form->setAttributes($this->reminder);
            }
        } catch (QueryException $e) {
            return $this->errorMessage = 'Đã xảy ra lỗi! Xin vui lòng liên hệ với chúng tôi.';
        }
    }

    public function save()
    {
        $this->reset(['successMessage', 'errorMessage']);
        $this->form->validate();

        $reminder_id = $this->is_create == 'create' ? 0 : $this->reminder->id;

        if (Reminder::where('name', $this->form->name)->whereNot('id', $reminder_id)->exists())
            return $this->errorMessage = 'Tên lời dặn đã tồn tại. Xin vui lòng kiểm tra lại.';

        if ($this->is_create == 'create') {
            $this->form->store();
            $this->successMessage = 'Thêm mẫu lời dặn thành công';
        } else {
            $this->form->update();
            $this->successMessage = 'Sửa thông tin lời dặn thành công!';
        }
    }

    public function saveAndExit(){
        $this->save();
        if(!$this->errorMessage){
            $this->redirect('/reminders');
        }
    }

    public function render()
    {
        return view('livewire.category.reminder.action-reminder');
    }
}
