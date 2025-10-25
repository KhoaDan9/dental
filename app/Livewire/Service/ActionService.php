<?php

namespace App\Livewire\Service;

use App\Livewire\Forms\ServiceForm;
use App\Models\Clinic;
use App\Models\Service;
use App\Models\ServiceGroup;
//use App\Models\Supplier;
use Illuminate\Database\QueryException;
use Livewire\Component;
use Livewire\Attributes\Title;

#[Title('Danh sách dịch vụ/thủ thuật')]
class ActionService extends Component
{
    public ServiceForm $form;
    public Service $service;
    public $clinics = [];
    public $service_groups = [];
//    public $suppliers = [];
    public $is_create = '';
    public $successMessage = '';
    public $errorMessage = '';

    public function mount($value)
    {
        $this->service_groups = ServiceGroup::all();

//        $this->suppliers = Supplier::where('active', 1)->get();

        $this->clinics = Clinic::all();

        if (count($this->service_groups) == 0)
            return $this->errorMessage = 'Không thể thêm dịch vụ/thủ thuật do chưa có nhóm dịch vụ/thủ thuật. Xin vui lòng tạo nhóm dịch vụ/thủ thuật mới.';

        if ($value == 'create') {
            $this->is_create = 'create';
            $this->form->clinic_id = $this->clinics[0]->id;
            $this->form->service_group_id = $this->service_groups[0]->id;
        } else {
            $this->service = Service::where('active', 1)
                ->where('id', $value)->get()[0];
            $this->form->setAttributes($this->service);
        }
    }

    public function save()
    {
        $this->reset(['successMessage', 'errorMessage']);
        $this->form->validate();

        $service_id = $this->is_create == 'create' ? 0 : $this->service->id;

        if (Service::where('name', $this->form->name)->whereNot('id', $service_id)->exists())
            return $this->errorMessage = 'Tên dịch vụ/thủ thuật đã tồn tại. Xin vui lòng kiểm tra lại.';

        try {
            if ($this->is_create == 'create') {
                $this->form->store();
                $this->successMessage = 'Thêm dịch vụ/thủ thuật thành công!';
            } else {
                $this->form->update();
                $this->successMessage = 'Sửa thông tin dịch vụ/thủ thuật thành công!';
                $this->service = $this->form->service;
            }
        } catch (QueryException $e) {
            return $this->errorMessage = 'Đã xảy ra lỗi! Xin vui lòng liên hệ với chúng tôi.';
        }
    }

    public function saveAndExit()
    {
        $this->save();
        if(!$this->errorMessage) {
            $this->redirect('/services');
        }
    }

    public function render()
    {
        return view('livewire.service.action-service');
    }
}
