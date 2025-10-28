<div>
    {{--    <div class="pb-2 flex justify-between border-b-1 border-gray-300">--}}
    {{--        <div>--}}
    {{--            <span>Bảo mật >> <a href="/users">Danh sách tài khoản</a>--}}
    {{--            </span>--}}
    {{--        </div>--}}
    {{--        <div class="flex space-x-1">--}}
    {{--            <a href="/users/create" class="a-button">Thêm</a>--}}
    {{--            <a href="/users" class="a-button">Thoát</a>--}}
    {{--        </div>--}}
    {{--    </div>--}}
    <x-all-heading head_title="Bảo mật" title_1="Danh sách tài khoản" url_1="/users"
                   create_url="/users/create"
                   exit_url="/users"
                   :action_model="\App\Models\User::class"/>
    @cannot('viewAny', \App\Models\User::class)
        <x-cannot-permission/>
    @else

        <form wire:submit="save">
            <div class="action-display">
                <x-all-text-input w_title="w-45" title="Tên đăng nhập:" model="form.username" is_required="true"/>

                <x-all-text-input w_title="w-45" title="Tên đăng nhập:" model="form.password" type="password"
                                  is_required="true"/>

                <x-all-select-input w_title="w-45" model="form.clinic_id" title="Phòng khám:" :values="$clinics"/>
                <x-all-select-input w_title="w-45" model="form.employee_id" title="Nhân viên:" :values="$employees"/>
                <x-all-text-input w_title="w-45" title="Quyền đọc, xem dữ liệu:" model="form.date_permission"
                                  type="date"/>
                <x-all-textarea w_title="w-45" title="Ghi chú:" model="form.note"/>
                <x-status-input w_title="w-45" model="form.active"/>


                @if ($user)
                    <x-all-last-update-name w_title="w-45" :name="$user->last_update_name"
                                            :updated_at="$user->updated_at"/>
                @endif
                @if ($successMessage != '')
                    <x-success-message class="pl-45">{{ $successMessage }}</x-success-message>
                @endif
                @if ($errorMessage != '')
                    <x-error-message class="pl-45">{{ $errorMessage }}</x-error-message>
                @endif


                <x-action-button w_title="w-45" :action_model="\App\Models\User::class" exit_url="/users"
                                 :is_create="$is_create"/>

            </div>
        </form>
    @endcannot
</div>
