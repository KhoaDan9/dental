<div class="flex-col">
    <div class="pb-2 flex justify-between border-b-1 border-gray-300">
        <div>
            <span>Dữ liệu >> <a href="/services">Danh sách dịch vụ/thủ thuật</a></span>
        </div>
        <div class="flex space-x-1">
            <a href="/services/create"
               @can('create', \App\Models\Service::class)
                   class="a-button"
               @else
                   class="cannot-a-button"
                @endcan
            >Thêm</a>
        </div>
    </div>

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
                    <td class=" text-center"><a href="/services/{{ $service->id }}" wire:navigate.hover
                            @can('update', \App\Models\Service::class)
                                class="button-a"
                            @else
                                class="cannot-button-a"
                            @endcan
                        >sửa</a> |
                        <button wire:confirm="Bạn có thực sự muốn xóa không?"
                                wire:click='deleteService({{ $service->id }})'
                                @can('delete', \App\Models\Service::class)
                                    class="button-a"
                                @else
                                    class="cannot-button-a"
                            @endcan
                        >xóa
                        </button>
                    </td>
                </tr>
            @endforeach
        </table>
    @endcannot
</div>
