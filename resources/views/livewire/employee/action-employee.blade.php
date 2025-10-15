<div class="flex-col">
    <div class="pb-2 flex justify-between border-b-1 border-gray-300">
        <div>
            <span>Dữ liệu >> <a href="/employees">Danh sách nhân viên</a>
            </span>
        </div>
        <div class="flex space-x-1">

            <a href="/employees/create"
               @can('create', \App\Models\Employee::class)
                   class="a-button"
               @else
                   class="cannot-a-button"
                @endcan
            >Thêm</a>
            <a href="/employees" class="a-button">Thoát</a>
        </div>
    </div>
    <form wire:submit='actionEmployee'>
        <div class="flex flex-wrap pt-2 space-y-2 max-w-250">
            <div class="flex w-full flex-grow">
                <p for="" class="w-50">Họ và tên:</p>
                <input type="text" class="px-1 border-gray-500 border-1 flex-grow" wire:model='form.full_name'
                       autofocus>
            </div>
            <div class="flex w-full">
                <p for="" class="w-50">Tên thường gọi:<span class="text-red-600">*</span></p>
                <div class="flex flex-grow flex-col">
                    <input type="text" class="px-1 border-gray-500 border-1 flex-grow" wire:model='form.name'>
                    @error('form.name')
                    <x-error-message>{{ $message }}</x-error-message>
                    @enderror
                </div>
                <p for="" class="pl-5 pr-1 text-right ">Ngày sinh:</p>
                <input type="date" class="px-1 border-gray-500 border-1 w-40" wire:model='form.birth'>

            </div>
            <div class="w-full flex">
                <p class="w-50">Phòng khám:</p>
                <select name="" id="" class="px-1 border-gray-500 border-1 flex-grow"
                        wire:model='form.clinic_id'>
                    @foreach ($clinics as $clinic)
                        <option value="{{ $clinic->id }}">{{ $clinic->name }}</option>
                    @endforeach
                </select>
            </div>


            <div class="flex w-full">
                <p for="" class="w-50">Căn cước công dân:</p>
                <input type="text" class="px-1 border-gray-500 border-1 flex-grow" wire:model='form.citizen_id'>
            </div>

            <div class="flex w-full">
                <p for="" class="w-50">Số điện thoại:</p>
                <div class="flex-grow flex flex-col">
                    <input type="text" class="px-1 border-gray-500 border-1" wire:model='form.phone'>
                </div>
            </div>
            <div class="flex w-full">
                <p for="" class="w-50">Email:</p>
                <div class="flex-grow flex flex-col">
                    <input type="text" class="px-1 border-gray-500 border-1" wire:model='form.email'>

                </div>
            </div>
            <div class="flex w-full">
                <p for="" class="w-50">Địa chỉ:</p>
                <div class="flex-grow flex flex-col">
                    <input type="text" class="px-1 border-gray-500 border-1" wire:model='form.address'>

                </div>
            </div>

            <div class="flex w-full">
                <p for="" class="w-50">Ghi chú:</p>
                <textarea type="text" class="px-1 border-gray-500 border-1 flex-grow h-20"
                          wire:model='form.note'></textarea>
            </div>
            <div class="flex w-full">
                <p for="" class="w-50">Bác sĩ thực hiện thủ thuật:</p>
                <div class="flex flex-col">
                    <label for="doctor1" class="flex items-center">
                        <input type="radio" id="doctor1" value=1 wire:model='form.doctor'>
                        Có
                    </label>
                    <label for="doctor2" class="flex items-center">
                        <input type="radio" id="doctor2" value=0 wire:model='form.doctor'>
                        Không
                    </label>
                </div>
            </div>

            <div class="flex w-full">
                <p for="" class="w-50">Trạng thái:</p>
                <div class="flex space-x-2 flex-1">
                    <label for="status1" class="flex items-center">
                        <input type="radio" id="status1" value=1 wire:model='form.active'>
                        Đang làm
                    </label>
                    <label for="status2" class="flex items-center">
                        <input type="radio" id="status2" value=0 wire:model='form.active'>
                        Nghỉ việc
                    </label>
                </div>
            </div>
            @if ($employee)
                <div class="flex w-full">
                    <p for="" class="w-50">Người cập nhật:</p>
                    <x-last-update-name
                        :name="$employee->last_update_name">{{ $employee->updated_at }}</x-last-update-name>
                </div>
            @endif
            @if ($successMessage != '')
                <div class="flex w-full">
                    <p for="" class="w-50"></p>
                    <x-success-message>{{ $successMessage }}</x-success-message>
                </div>
            @endif

            <div class="flex w-full space-x-1">
                <p for="" class="w-50"></p>
                @if ($is_create == 'create')
                    <button type="submit"
                        @can('create', \App\Models\Employee::class)
                            class="main-button"
                        @else
                            class="cannot-main-button"
                        @endcan
                    >Thêm</button>
                @else
                    <button type="submit" wire:dirty.remove.attr='disabled' disabled
                        @can('update', \App\Models\Employee::class)
                            class="main-button"
                        @else
                            class="cannot-main-button"
                        @endcan
                    >Sửa
                    </button>
                @endif
                <a href="/employees" class="a-button">Thoát</a>
            </div>
        </div>

    </form>

</div>
