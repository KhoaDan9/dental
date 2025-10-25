<div class="flex-col">
    <x-all-heading head_title="Danh mục" title_1="Mẫu đơn thuốc" url_1="/prescriptions"
                   create_url="/prescriptions/create" :action_model="\App\Models\Prescription::class"/>
    @cannot('viewAny', \App\Models\Prescription::class)
        <x-cannot-permission/>
    @else
        @if ($errorMessage !== '')
            <x-error-message>{{ $errorMessage }}</x-error-message>
        @endif

        @if ($successMessage == true)
            <x-success-message>{{ $successMessage }}</x-success-message>
        @endif

        <table class="table-custom table-auto w-full border-collapse border">
            <tr>
                <th class="whitespace-nowrap w-0">TT</th>
                <th class="whitespace-nowrap w-0">Mã số</th>
                <th class="whitespace-nowrap w-1/5 text-left">Tên mẫu</th>
                <th class="whitespace-nowrap w-1/7">Ghi chú</th>
                <th class="whitespace-nowrap w-0">PK</th>
                <th class="whitespace-nowrap w-0">Trạng thái</th>
                <th class="whitespace-nowrap w-0">Cập nhật</th>
                <th class="whitespace-nowrap w-0">Chức năng</th>
            </tr>
            @foreach ($prescriptions as $prescription)
                <tr>
                    <td class=" text-center">{{ $loop->iteration }}</td>
                    <td class="text-center">{{ $prescription->id }}</td>
                    <td class="">{{ $prescription->name }}</td>
                    <td class="">{{ $prescription->note }}</td>
                    <td class=" text-center">{{ $prescription->clinic_id }}</td>
                    <td class="text-center">
                        <x-p-active :is_active="$prescription->active"/>
                    </td>
                    <td class=" text-center">{{ $prescription->last_update_name }}</td>
                    <x-action-a-button :action_model="\App\Models\Prescription::class"
                                       edit_url="/prescriptions/{{ $prescription->id }}"
                                       delete_event="deletePrescription({{ $prescription->id }})"/>
                </tr>
            @endforeach
        </table>
    @endcannot

</div>
