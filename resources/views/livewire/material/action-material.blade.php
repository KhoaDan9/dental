<div>
    <div class="pb-2 flex justify-between border-b-1 border-gray-300">
        <div>
            <span>Danh mục >> <a href="/materials">Danh mục vật tư</a>
            </span>
        </div>
        <div class="flex space-x-1">
            <a href="/materials/create"
               @can('create', \App\Models\Material::class)
                   class="a-button"
               @else
                   class="cannot-a-button"
                @endcan>Thêm</a>
            <a href="/materials" class="a-button">Thoát</a>
        </div>
    </div>
    @if (count($material_groups) != 0)
        <form wire:submit='actionMaterial'>
            <div class="flex flex-wrap pt-2 space-y-2 px-2 max-w-250">
                <div class="flex w-full">
                    <p class="w-35">Tên vật tư:<span class="text-red-600">*</span></p>
                    <div class="flex flex-grow flex-col">
                        <input type="text" class="px-1 border-gray-500 border-1 flex-grow" wire:model='form.name'
                               autofocus>
                        @error('form.name')
                        <x-error-message>{{ $message }}</x-error-message>
                        @enderror
                    </div>
                </div>
                <div class="flex w-full">
                    <p class="w-35">Đơn vị tính:</p>
                    <input type="text" class="px-1 border-gray-500 border-1 flex-grow"
                           wire:model='form.caculation_unit'>
                </div>
                <div class="w-full flex">
                    <p class="w-35">Phòng khám:</p>
                    <select name="" id="" class="px-1 border-gray-500 border-1 flex-grow"
                            wire:model='form.clinic_id'>
                        @foreach ($clinics as $clinic)
                            <option value="{{ $clinic->id }}">{{ $clinic->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="flex w-full">
                    <p class="w-35">Nhóm vật tư:</p>
                    <select name="" id="" class="px-1 border-gray-500 border-1 flex-grow"
                            wire:model="form.monetary_unit">
                        @foreach ($material_groups as $material_group)
                            <option value="{{ $material_group->id }}">
                                {{ $material_group->name }}</option>
                        @endforeach
                    </select>

                </div>
                <div class="flex w-full">
                    <p class="w-35">Đơn vị tiền tệ:</p>
                    <select name="" id="" class="px-1 border-gray-500 border-1 w-20"
                            wire:model='form.monetary_unit'>
                        <option value="VNĐ">VNĐ</option>
                        <option value="USD">USD</option>
                    </select>
                    <p class="pl-5 pr-1 text-right">Đơn giá:</p>
                    <div class="flex flex-grow  w-30">
                        <input type="text" class="mr-2 px-1 border-gray-500 border-1 w-30 number-input"
                               wire:model='form.price'>
                        @error('form.price')
                        <x-error-message>{{ $message }}</x-error-message>
                        @enderror
                    </div>

                </div>

                <div class="flex w-full">
                    <p class="w-35">Mô tả:</p>
                    <div class="flex-grow flex flex-col">
                        <input type="text" class="px-1 border-gray-500 border-1" wire:model='form.describe'>
                    </div>
                </div>

                <div class="flex w-full">
                    <p class="w-35">Ghi chú:</p>
                    <textarea type="text" class="px-1 border-gray-500 border-1 flex-grow h-20"
                              wire:model='form.note'></textarea>
                </div>
                <div class="flex w-full">
                    <p class="w-35">Trạng thái:</p>
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
                @if ($is_create !== 'create')
                    <div class="flex w-full">
                        <p class="w-35">Người cập nhật:</p>
                        <x-last-update-name
                            :name="$material->last_update_name">{{ $material->updated_at }}</x-last-update-name>
                    </div>
                @endif

                @if ($successMessage != '')
                    <div class="flex w-full">
                        <p class="w-35"></p>
                        <x-success-message>{{ $successMessage }}</x-success-message>
                    </div>
                @endif

                @if ($errorMessage != '')
                    <div class="flex w-full">
                        <p class="w-35"></p>
                        <x-error-message>{{ $errorMessage }}</x-error-message>
                    </div>
                @endif

                <div class="flex w-full">
                    <p class="w-35"></p>
                    @if ($is_create == 'create')
                        <button type="submit"
                                @can('create', \App\Models\Material::class)
                                    class="main-button"
                                @else
                                    class="cannot-main-button"
                            @endcan

                        >Thêm
                        </button>
                    @else
                        <button type="submit" wire:dirty.remove.attr="disabled" disabled
                                @can('update', \App\Models\Material::class)
                                    class="main-button"
                                @else
                                    class="cannot-main-button"
                            @endcan

                        >Sửa
                        </button>
                    @endif
                    <a href="/materials" class="a-button ml-2">Thoát</a>
                </div>
            </div>
        </form>
    @else
        <x-error-message>{{ $errorMessage }}</x-error-message>
    @endif
</div>
