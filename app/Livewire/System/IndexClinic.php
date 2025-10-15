<?php

namespace App\Livewire\System;

use App\Models\Clinic;
use Livewire\Component;

class IndexClinic extends Component
{
    public function render()
    {
        $clinics = Clinic::all();
        return view('livewire.system.index-clinic', [
            'clinics' => $clinics
        ]);
    }
}
