<?php

namespace App\Livewire\Service;

use App\Livewire\Forms\ServiceGroupForm;
use App\Models\ServiceGroup;
use Illuminate\Database\QueryException;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\Attributes\Title;

#[Title('Danh sách nhóm dịch vụ/thủ thuật')]
class IndexServiceGroup extends Component
{
    public $service_groups = [];
    public ServiceGroupForm $form;

    public $successMessage = '';
    public $errorMessage = '';
    public $searchString = '';


    #[On('searchServiceGroupUpdate')]
    public function updateSearchString($searchString){
        $this->successMessage = '';
        $this->searchString = $searchString;
        $this->service_groups = $searchString === ''
            ? ServiceGroup::all()
            : ServiceGroup::where('name', 'LIKE', '%' . $searchString . '%')->get();
    }

    public function mount() {
        $this->service_groups = ServiceGroup::all();
    }

    public function deleteServiceGroup(ServiceGroup $service_group)
    {
        try {
            $service_group->delete();
            $this->updateSearchString($this->searchString);
            $this->successMessage = 'Xóa nhóm danh mục thành công!';
        } catch (QueryException $e) {
            if ($e->getCode() == 23000) {
                $this->errorMessage = 'Không thể xóa nhóm dịch vụ "' . $service_group->name . '" vì vẫn còn dịch vụ liên quan!';
            }
            else
                $this->errorMessage = 'Đã xảy ra lỗi khi xóa nhóm dịch vụ. Vui lòng thử lại sau!';
        }
    }

    public function render()
    {
        return view('livewire.service.index-service-group');
    }
}
