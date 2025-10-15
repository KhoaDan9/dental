<?php

namespace App\Livewire;

use App\Models\WarrantyCard;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\Attributes\Title;

#[Title('Thẻ bảo hành')]
class IndexWarrantyCard extends Component
{
    public $successMessage = '';
    public $errorMessage = '';

    public function deleteWarrantyCard(WarrantyCard $warranty_card)
    {
        $this->reset(['successMessage', 'errorMessage']);

        try {
            $warranty_card->delete();
            $this->successMessage = 'Xóa thẻ bảo hành thành công!';
        } catch (QueryException $e) {
            $this->errorMessage = 'Đã xảy ra lỗi khi xóa thẻ bảo hành! Vui lòng liên hệ với chúng tôi!';
        }
    }
    public function render()
    {
        $warranty_cards = WarrantyCard::all();
        return view(
            'livewire.index-warranty-card',
            [
                'warranty_cards' => $warranty_cards
            ]
        );
    }
}
