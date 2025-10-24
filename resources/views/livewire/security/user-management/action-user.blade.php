<div>
    <div class="pb-2 flex justify-between border-b-1 border-gray-300">
        <div>
            <span>Bảo mật >> <a href="/users">Danh sách tài khoản</a>
            </span>
        </div>
        <div class="flex space-x-1">
            <a href="users/create" class="a-button">Thêm</a>
            <a href="/users" class="a-button">Thoát</a>
        </div>
    </div>
    @cannot('view', $user)
        <x-cannot-permission/>
    @else
        <form wire:submit="actionUser">
            <div class="flex flex-wrap pt-2 space-y-2 px-2 max-w-250">
                <div class="flex w-full">
                    <p for="" class="w-45">Tên đăng nhập:<span class="text-red-600">*</span></p>
                    <div class="flex-grow">
                        <input type="text" class="px-1 border-gray-500 border-1 w-full" wire:model="form.username"
                               autofocus>
                        @error('form.username')
                        <x-error-message>{{ $message }}</x-error-message>
                        @enderror
                    </div>
                </div>

                <div class="flex w-full">
                    <p for="" class="w-45">Mật khẩu:<span class="text-red-600">*</span></p>
                    <div class="flex-grow">
                        <input type="password" class="px-1 border-gray-500 border-1 w-full" wire:model="form.password">
                        @error('form.password')
                        <x-error-message>{{ $message }}</x-error-message>
                        @enderror
                    </div>
                </div>
                <div class="w-full flex">
                    <p class="w-45">Phòng khám:</p>
                    <select name="" id="" class="px-1 border-gray-500 border-1 flex-grow"
                            wire:model='form.clinic_id'>
                        @foreach ($clinics as $clinic)
                            <option value="{{ $clinic->id }}">{{ $clinic->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="flex w-full">
                    <p for="" class="w-45">Nhân viên:</p>
                    <select name="" id="" class="px-1 border-gray-500 border-1 flex-grow"
                            wire:model="form.employee_id">
                        @foreach ($employees as $employee)
                            <option value="{{ $employee->id }}">
                                {{ $employee->name }}</option>
                        @endforeach
                    </select>

                </div>
                <div class="flex w-full">
                    <p for="" class="w-45">Quyền đọc, xem dữ liệu:</p>
                    <input type="date" class="px-1 border-gray-500 border-1 flex-grow"
                           wire:model="form.date_permission">
                </div>

                <div class="flex w-full">
                    <p for="" class="w-45">Ghi chú:</p>
                    <textarea type="text" class="px-1 border-gray-500 border-1 flex-grow h-20"
                              wire:model="form.note"></textarea>
                </div>

                <div class="flex w-full">
                    <p for="" class="w-45">Trạng thái:</p>
                    <div class="flex space-x-2 flex-1">
                        <label for="status1" class="flex items-center">
                            <input type="radio" id="status1" value=1 wire:model="form.active">
                            Bật
                        </label>
                        <label for="status2" class="flex items-center">
                            <input type="radio" id="status2" value=0 wire:model="form.active">
                            Tắt
                        </label>
                    </div>
                </div>
{{--                @if ($user)--}}
{{--                    <div class="flex w-full">--}}
{{--                        <p class="w-45">Người cập nhật</p>--}}
{{--                        <x-last-update-name :name="$user->last_update_name">{{ $user->updated_at }}</x-last-update-name>--}}
{{--                    </div>--}}
{{--                @endif--}}
                @if ($successMessage != '')
                    <x-success-message>{{ $successMessage }}</x-success-message>
                @endif

                @if ($errorMessage !== '')
                    <x-error-message>{{ $errorMessage }}</x-error-message>
                @endif


                <div class="flex w-full">
                    <p for="" class="w-45"></p>
                    @if ($is_create == 'create')
                        <button type="submit" class="main-button mr-2">Thêm</button>
                    @else
                        <button type="submit"
                                @can('update', $user)
                                    class="main-button"
                                @else
                                    class="cannot-main-button"
                            @endcan
                        >Sửa
                        </button>
                    @endif
                    <a href="/users" class="a-button ml-2">Thoát</a>
                </div>
            </div>
        </form>
    @endcannot
</div>
