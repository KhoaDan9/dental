<?php

namespace App\Livewire\Patient;

use App\Models\Patient;
use App\Models\PatientService;
use Carbon\Carbon;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\On;
use Livewire\Attributes\Session;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Component;


#[Title('Hồ sơ bệnh nhân')]
class IndexPatient extends Component
{
    public $patients = [];

//    #[Url(as: 'd',except: '')]
    public $search_date = '';

//    #[Url(as: 'q',except: '')]
    public $search_string = '';
    public $successMessage = '';
    public $errorMessage = '';

    public function mount()
    {
        $this->search_date = Carbon::now('Asia/Ho_Chi_Minh')->format('Y-m-d');
        $this->updateData2();
    }

    public function searchSubmit()
    {
        if ($this->search_string != '') {
            return $this->updateData();
        } else {
            return $this->updateData2();
        }
    }

    public function updateData()
    {
        $this->patients = $this->search_string === ''
            ? Patient::all()
            : Patient::where('name', 'LIKE', '%' . $this->search_string . '%')->get();

        $this->search_string = '';
    }

    public function updateData2()
    {
        $this->patients = [];
        $this->search_string = '';

        try{
            $patient_services = PatientService::whereDate('date', $this->search_date)->get('patient_id')->groupBy('patient_id')->keys()->toArray();
        }
        catch (QueryException $e){
            $patient_services = [];
        }

        $patients = Patient::whereDate('created_at', $this->search_date)->get('id')->groupBy('id')->keys()->toArray();

        $patient_list = array_unique(array_merge($patients, $patient_services));

        if ($patient_list != null)
            $this->patients = Patient::whereIn('id', $patient_list)->orderBy('updated_at', 'desc')->get();
    }

    public function deletePatient(Patient $patient)
    {
        try {
            $patient->delete();
            if ($this->last_query == 'q') {
                $this->updateData($this->search_string);
            } else {
                $this->updateData2($this->search_date);
            }
            $this->successMessage = 'Xóa bệnh nhân thành công!';
        } catch (QueryException $e) {
            $this->errorMessage = 'Đã xảy ra lỗi khi xóa bệnh nhân. Xin vui lòng liên hệ với chúng tôi!';
        }
    }

    public function render()
    {
        return view('livewire.patient.index-patient');
    }
}
