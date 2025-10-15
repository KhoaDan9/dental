<?php

namespace App\Livewire\Security;

use App\Models\DataLog;
use Livewire\Component;

class IndexDataLogs extends Component
{
    public $dataLogs = [];

    public function mount(){
        $this->dataLogs = DataLog::orderBy('created_at', 'desc')->get();
    }

    public function render()
    {
        return view('livewire.security.index-data-logs');
    }
}
