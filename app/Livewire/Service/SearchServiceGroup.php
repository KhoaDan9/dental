<?php

namespace App\Livewire\Service;

use Livewire\Component;

class SearchServiceGroup extends Component
{
    public $searchString = '';
    public function updatedSearchString()
    {
        $this->dispatch('searchServiceGroupUpdate', searchString: $this->searchString);
    }

    public function render()
    {
        return view('livewire.service.search-service-group');
    }
}
