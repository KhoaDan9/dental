<?php

namespace App\Livewire\Service;

use Livewire\Component;

class SearchService extends Component
{
    public $searchString = '';
    public function updatedSearchString()
    {
        $this->dispatch('searchServiceUpdate', searchString: $this->searchString);
    }

    public function render()
    {
        return view('livewire.service.search-service');
    }
}
