<div class="flex-col">
    <div class="pb-2 flex justify-between border-b-1 border-gray-300">
        <div>
            <span>Dữ liệu >> <a href="/warranty-cards">Thẻ bảo hành</a>
            </span>
        </div>
    </div>

    @if ($successMessage != '')
        <x-success-message>{{ $successMessage }}</x-success-message>
    @endif

    @if ($errorMessage !== '')
        <x-error-message>{{ $errorMessage }}</x-error-message>
    @endif

    <table class="table-custom table-auto w-full border-collapse border">
        <tr>
            <th class="whitespace-nowrap w-0">TT</th>
            <th class="whitespace-nowrap w-0">Mã thẻ bảo hành</th>
            <th class="whitespace-nowrap w-1/5 text-left">Thủ thuật/dịch vụ</th>
            <th class="whitespace-nowrap w-0">Ngày thực hiện</th>
            <th class="whitespace-nowrap w-0">Hết hạn</th>
            <th class="whitespace-nowrap w-0">Mã khách hàng</th>
            <th class="whitespace-nowrap w-0">Tên khách hàng</th>
            <th class="whitespace-nowrap w-0">Ghi chú</th>
            <th class="whitespace-nowrap w-0">Trạng thái</th>
            <th class="whitespace-nowrap w-0">Cập nhật</th>
            <th class="whitespace-nowrap w-0">Chức năng</th>
        </tr>
        @foreach ($warranty_cards as $warranty_card)
            @php
                $patient_id = $warranty_card->patientService->patient->id;
            @endphp
            <tr>
                <td class=" text-center">{{ $loop->iteration }}</td>
                <td class="text-center">{{ $warranty_card->card_id }}</td>
                <td class="">{{ $warranty_card->service_name }}</td>
                <td class="">{{ $warranty_card->patientService->created_at }}</td>
                <td class="text-center">{{ $warranty_card->expiration_date }}</td>
                <td class="text-center">
                    <a href="/patients/{{ $warranty_card->patientService->patient->id }}">
                        {{ $warranty_card->patientService->patient->clinic_id }}
                        .{{ $warranty_card->patientService->patient->id }}
                    </a>
                </td>
                <td class="">{{ $warranty_card->patientService->patient->name }}</td>
                <td class="text-center">{{ $warranty_card->note }}</td>
                <td class="text-center">{{ $warranty_card->warranty_status }}</td>
                <td class="text-center">{{ $warranty_card->last_update_name }}</td>
                <td class=" text-center"><a
                        href="/patients/{{ $warranty_card->patientService->patient->id }}/{{ $warranty_card->id }}/warranty-card">sửa</a>
                    |
                    <button
                        class="button-a" wire:confirm="Bạn có thực sự muốn xóa không?"
                        wire:click='deleteWarrantyCard({{ $warranty_card->id }})'>xóa
                    </button>
                </td>
            </tr>
        @endforeach

    </table>
</div>
