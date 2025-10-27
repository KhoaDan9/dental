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
        <form wire:submit="save">
            <div class="action-display">
                <x-all-text-input w_title="w-45" title="Tên đăng nhập:" model="form.username" is_required="true"/>

                <x-all-text-input w_title="w-45" title="Tên đăng nhập:" model="form.password" type="password" is_required="true"/>

                <x-all-select-input w_title="w-45" model="form.clinic_id" title="Phòng khám:" :values="$clinics"/>
                <x-all-select-input w_title="w-45" model="form.employee_id" title="Nhân viên:" :values="$employees"/>
                <x-all-text-input w_title="w-45" title="Quyền đọc, xem dữ liệu:" model="form.date_permission" type="datetime-local"/>
                <x-all-textarea w_title="w-45" title="Ghi chú:" model="form.note"/>
                <x-status-input w_title="w-45" model="form.active"/>
                

              
{{--                @if ($user)--}}
{{--                    <div class="flex w-full">--}}
{{--                        <p class="w-45">Người cập nhật</p>--}}
{{--                        <x-last-update-name :name="$user->last_update_name">{{ $user->updated_at }}</x-last-update-name>--}}
{{--                    </div>--}}
{{--                @endif--}}
                    @if ($successMessage != '')
                        <x-success-message class="pl-45">{{ $successMessage }}</x-success-message>
                    @endif
                    @if ($errorMessage != '')
                        <x-error-message class="pl-45">{{ $errorMessage }}</x-error-message>
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
