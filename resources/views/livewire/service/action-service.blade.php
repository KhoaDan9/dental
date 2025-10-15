<div>
    <div class="pb-2 flex justify-between border-b-1 border-gray-300">
        <div>
            <span>Dữ liệu >> <a href="/service-groups">Danh sách dịch vụ/thủ thuật</a>
            </span>
        </div>
        <div class="flex space-x-1">
            <a href="/services/create"
               @can('create', \App\Models\Service::class)
                   class="a-button"
               @else
                   class="cannot-a-button"
                @endcan
            >Thêm</a>
            <a href="/services" class="a-button">Thoát</a>
        </div>
    </div>

    @cannot('viewAny', \App\Models\Service::class)
        <x-cannot-permission/>
    @else
        @if(count($this->service_groups) != 0)
            <form wire:submit='actionService'>
                <div class="flex flex-wrap pt-2 space-y-2 max-w-250">
                    <div class="flex w-full">
                        <p for="" class="w-40">Tên thủ thuật:<span class="text-red-600">*</span></p>
                        <div class="flex flex-grow flex-col">
                            <input type="text" class="px-1 border-gray-500 border-1 " wire:model='form.name' autofocus>
                            @error('form.name')
                            <x-error-message>{{ $message }}</x-error-message>
                            @enderror
                        </div>
                    </div>
                    <div class="flex w-full">
                        <p for="" class="w-40">Đơn vị tính:</p>
                        <input type="text" class="px-1 border-gray-500 border-1 flex-grow"
                               wire:model='form.caculation_unit'>
                    </div>
                    <div class="w-full flex">
                        <p class="w-40">Phòng khám:</p>
                        <select name="" id="" class="px-1 border-gray-500 border-1 flex-grow"
                                wire:model='form.clinic_id'>
                            @foreach ($clinics as $clinic)
                                <option value="{{ $clinic->id }}">{{ $clinic->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="flex w-full">
                        <p for="" class="w-40">Nhóm thủ thuật:</p>
                        <select name="" id="" class="px-1 border-gray-500 border-1 flex-grow"
                                wire:model="form.service_group_id">
                            @foreach ($service_groups as $service_group)
                                <option value="{{ $service_group->id }}">
                                    {{ $service_group->name }}</option>
                            @endforeach
                        </select>

                    </div>
                    <div class="flex w-full">
                        <p for="" class="w-40">Đơn vị tiền tệ:</p>
                        <select name="" id="" class="px-1 border-gray-500 border-1 w-20"
                                wire:model='form.monetary_unit'>
                            <option value="VNĐ">VNĐ</option>
                            <option value="USD">USD</option>
                        </select>
                        <p for="" class="pl-5 pr-1 text-right">Đơn giá:</p>
                        <input type="text" class="px-1 border-gray-500 border-1 w-30 number-input"
                               wire:model='form.price'>
                    </div>
                    <div class="flex w-full">
                        <p for="" class="w-40">Bảo hành:</p>
                        <div class="flex flex-col">
                            <label for="warranty_able1" class="flex items-center">
                                <input type="radio" id="warranty_able1" value=1 wire:model='form.warranty_able'>
                                Có
                            </label>
                            <label for="warranty_able2" class="flex items-center">
                                <input type="radio" id="warranty_able2" value=0 wire:model='form.warranty_able'>
                                Không
                            </label>
                        </div>
                    </div>
                    <div class="flex w-full">
                        <p for="" class="w-40">Thời gian bảo hành:</p>
                        <div class="flex-grow flex flex-col">
                            <input type="text" class="px-1 border-gray-500 border-1" wire:model='form.warranty'>
                        </div>
                    </div>

                    <div class="flex w-full">
                        <p for="" class="w-40">Ghi chú:</p>
                        <textarea type="text" class="px-1 border-gray-500 border-1 flex-grow h-20"
                                  wire:model='form.note'></textarea>
                    </div>
                    <div class="flex w-full">
                        <p for="" class="w-40">Nhà cung cấp:</p>
                        <select name="" id="" class="px-1 border-gray-500 border-1 flex-grow"
                                wire:model="form.supplier_id">
                            <option value="">-</option>
                            @foreach ($suppliers as $supplier)
                                <option value="{{ $supplier->id }}">{{ $supplier->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="flex w-full">
                        <p for="" class="w-40">Trạng thái:</p>
                        <div class="flex space-x-2 flex-1">
                            <label for="status1" class="flex items-center">
                                <input type="radio" id="status1" value=1 wire:model='form.active'>
                                Bật
                            </label>
                            <label for="status2" class="flex items-center">
                                <input type="radio" id="status2" value=0 wire:model='form.active'>
                                Tắt
                            </label>
                        </div>
                    </div>
                    @if ($service)
                        <div class="flex w-full">
                            <p for="" class="w-40">Người cập nhật:</p>
                            <x-last-update-name
                                :name="$service->last_update_name">{{ $service->updated_at }}</x-last-update-name>
                        </div>
                    @endif

                    <div class="flex w-full">
                        <p for="" class="w-40"></p>
                        @if ($successMessage != '')
                            <x-success-message>{{ $successMessage }}</x-success-message>
                        @endif
                    </div>

                    <div class="flex w-full">
                        <p for="" class="w-40"></p>
                        @if ($errorMessage != '')
                            <x-error-message>{{ $errorMessage }}</x-error-message>
                        @endif
                    </div>

                    <div class="flex w-full">
                        <p for="" class="w-40"></p>
                        @if ($is_create == 'create')
                            <button type="submit"
                                    @can('create', \App\Models\Service::class)
                                        class="main-button"
                                    @else
                                        class="cannot-main-button"
                                @endcan
                            >Thêm
                            </button>
                        @else
                            <button type="submit" wire:dirty.remove.attr="disabled" disabled
                                    @can('update', \App\Models\Service::class)
                                        class="main-button"
                                    @else
                                        class="cannot-main-button"
                                @endcan
                            >Sửa
                            </button>
                        @endif

                        <a href="/services" class="a-button ml-2">Thoát</a>
                    </div>
                </div>
            </form>
        @else
            <x-error-message>{{ $errorMessage }}</x-error-message>
        @endif
    @endcannot
</div>
