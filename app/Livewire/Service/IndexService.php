<?php

namespace App\Livewire\Service;

use App\Models\Service;
use Illuminate\Database\QueryException;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\Attributes\Title;

#[Title('Danh sách dịch vụ/thủ thuật')]
class IndexService extends Component
{
    public $successMessage = '';
    public $errorMessage = '';
    public $searchString = '';
    public $services = [];

    #[On('searchServiceUpdate')]
    public function updateSearchString($searchString){
        $this->successMessage = '';
        $this->searchString = $searchString;
        $this->services = $searchString === ''
            ? Service::with('supplier')->get()
            : Service::where('name', 'LIKE', '%' . $searchString . '%')->with('supplier')->get();
    }

    public function deleteService(Service $service) {
        try {
            $this->errorMessage = '';
            $service->delete();
            $this->updateSearchString($this->searchString);
            $this->successMessage = 'Xóa dịch vụ/thủ thuật thành công!';
        } catch (QueryException $e) {
            if ($e->getCode() == 23000) {
                $this->successMessage = '';
                $this->errorMessage = 'Không thể xóa nhóm dịch vụ "' . $service->name . '" vì vẫn còn dịch vụ liên quan!';
            }
            else
                $this->errorMessage = 'Đã xảy ra lỗi khi xóa nhóm dịch vụ. Vui lòng thử lại sau!';
        }
    }

    public function mount() {
        $this->services = Service::with('supplier')->get();
    }
    public function render()
    {
        return view('livewire.service.index-service',[
            'services' => $this->services
        ]);
    }
}
