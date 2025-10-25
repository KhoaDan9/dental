<div class="flex-col">
    <x-all-heading head_title="Dữ liệu" title_1="Danh sách dịch vụ/thủ thuật" url_1="/services" create_url="/services/create"
                   :action_model="\App\Models\Service::class"/>

    @if ($successMessage != '')
        <x-success-message>{{ $successMessage }}</x-success-message>
    @endif

    @if ($errorMessage !== '')
        <x-error-message>{{ $errorMessage }}</x-error-message>
    @endif
    @cannot('viewAny', \App\Models\Service::class)
        <x-cannot-permission/>
    @else
        <table class="table-custom table-auto w-full border-collapse border">
            <tr>
                <th class="whitespace-nowrap w-0">TT</th>
                <th class="whitespace-nowrap w-0">Mã số</th>
                <th class="whitespace-nowrap w-1/5 text-left">Tên thủ thuật/dịch vụ</th>
                <th class="whitespace-nowrap w-0">ĐVT</th>
                <th class="whitespace-nowrap w-0">Đơn giá</th>
                <th class="whitespace-nowrap w-0">Tiền tệ</th>
                <th class="whitespace-nowrap w-0">Bảo hành</th>
                <th class="whitespace-nowrap w-0">Nhà cung cấp</th>
                <th class="whitespace-nowrap w-0">Nhóm thủ thuật</th>
                <th class="whitespace-nowrap w-0">PK</th>
                <th class="whitespace-nowrap w-0">Trạng thái</th>
                <th class="whitespace-nowrap w-0">Cập nhật</th>
                <th class="whitespace-nowrap w-0">Chức năng</th>
            </tr>
            @foreach ($services as $service)
                <tr>
                    <td class=" text-center">{{ $loop->iteration }}</td>
                    <td class="text-center">{{ $service->id }}</td>
                    <td class="">{{ $service->name }}</td>
                    <td class="text-center">{{ $service->caculation_unit }}</td>
                    <td class="text-right number">{{ number_format($service->price , 0, ',', '.') }}</td>
                    <td class="text-center">{{ $service->monetary_unit }}</td>
                    <td class="text-center">
                        @if ($service->warranty_able == 0)
                            -
                        @else
                            {{ $service->warranty }}
                        @endif
                    </td>
                    <td class="">
                        @if($service->supplier)
                            {{ $service->supplier->name }}
                        @else
                            -
                        @endif
                    </td>
                    <td class="">{{ $service->serviceGroup->name }}</td>
                    <td class=" text-center">{{ $service->clinic_id }}</td>
                    <td class="text-center">
                        @if ($service->active)
                            Bật
                        @else
                            Tắt
                        @endif
                    </td>
                    <td class=" text-center">{{ $service->last_update_name }}</td>
                    <x-action-a-button :action_model="\App\Models\Service::class"
                                       edit_url="/services/{{ $service->id  }}"
                                       delete_event="deleteService({{ $service->id  }})"/>
                </tr>
            @endforeach
        </table>
    @endcannot
</div>
