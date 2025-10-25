<?php

namespace App\Livewire\Service;

use App\Livewire\Forms\ServiceGroupForm;
use App\Models\Clinic;
use App\Models\ServiceGroup;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\Attributes\Title;

#[Title('Danh sách nhóm dịch vụ/thủ thuật')]
class ActionServiceGroup extends Component
{
    public ServiceGroupForm $form;
    public ServiceGroup $service_group;
    public $clinics = [];
    public $is_create = '';
    public $successMessage = '';
    public $errorMessage = '';


    public function mount($value)
    {
        $this->clinics = Clinic::all();

        if ($value == 'create') {
            $this->is_create = 'create';
            $this->form->clinic_id = $this->clinics[0]->id;
        } else {
            $this->service_group = ServiceGroup::where('id', $value)->get()[0];
            $this->form->setAttributes($this->service_group);
        }
    }
    public function save()
    {
        $this->reset(['successMessage', 'errorMessage']);
        $this->form->validate();

        $service_group_id = $this->is_create == 'create' ? 0 : $this->service_group->id;

        if (ServiceGroup::where('name', $this->form->name)->whereNot('id', $service_group_id)->exists())
            return $this->errorMessage = 'Tên nhóm dịch vụ/thủ thuật đã tồn tại. Xin vui lòng kiểm tra lại.';

        try {
            if ($this->is_create == 'create') {
                $this->form->store();
                $this->successMessage = 'Thêm nhóm dịch vụ/thủ thuật thành công!';
            } else {
                $this->form->update();
                $this->successMessage = 'Sửa thông tin nhóm dịch vụ/thủ thuật thành công!';
            }
        } catch (QueryException $e) {
            $this->errorMessage = 'Đã xảy ra lỗi. Vui lòng liên hệ lại với chúng tôi!';
        }
    }

    public function saveAndExit(){
        $this->save();
        if(!$this->errorMessage) {
            $this->redirect('/service-groups');
        }
    }

    public function render()
    {
        return view('livewire.service.action-service-group');
    }
}
