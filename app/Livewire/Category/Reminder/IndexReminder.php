<?php

namespace App\Livewire\Category\Reminder;

use App\Models\Reminder;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\Attributes\Title;


#[Title('Mẫu lời dặn')]
class IndexReminder extends Component
{
    public $successMessage = '';
    public $errorMessage = '';

    public function deleteReminder(Reminder $reminder)
    {
        $this->reset(['successMessage', 'errorMessage']);
        try {
            $reminder->delete();
            $this->successMessage = 'Xóa lời dặn thành công!';
        } catch (QueryException $e) {
            return $this->errorMessage = 'Đã xảy ra lỗi! Xin vui lòng liên hệ với chúng tôi.';
        }
    }
    public function render()
    {
        $reminders = Reminder::all();

        return view('livewire.category.reminder.index-reminder', [
            'reminders' => $reminders
        ]);
    }
}
