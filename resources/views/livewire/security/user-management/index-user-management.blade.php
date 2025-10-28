<div class="">
    <x-all-heading head_title="Bảo mật" title_1="Danh sách tài khoản" url_1="/users"
                   create_url="/users/create"
                   :action_model="\App\Models\User::class"/>

    @cannot('viewAny', \App\Models\User::class)
        <x-cannot-permission/>
    @else
        @if ($successMessage != '')
            <x-success-message>{{ $successMessage }}</x-success-message>
        @endif
        @if ($errorMessage !== '')
            <x-error-message>{{ $errorMessage }}</x-error-message>
        @endif

        <table class="table-custom table-auto w-full border-collapse border">
            <tr>
                <th class="whitespace-nowrap w-0">TT</th>
                <th class="whitespace-nowrap w-0">Mã số</th>
                <th class="whitespace-nowrap w-1/5 text-left">Tên đăng nhập</th>
                <th class="whitespace-nowrap w-0">PK</th>
                <th class="whitespace-nowrap w-1/7">Ghi chú</th>
                <th class="whitespace-nowrap w-0">Trạng thái</th>
                <th class="whitespace-nowrap w-0">Cập nhật</th>
                <th class="whitespace-nowrap w-0">Chức năng</th>
            </tr>
            @foreach ($users as $user)
                <tr>
                    <td class=" text-center">{{ $loop->iteration }}</td>
                    <td class="text-center"><a href="/users/{{ $user->id }}">{{ $user->id }}</a></td>
                    <td class="">{{ $user->username }}</td>
                    <td class=" text-center">{{ $user->clinic_id }}</td>
                    <td class="">{{ $user->note }}</td>
                    <td class="text-center">
                        <x-p-active :is_active="$user->active"/>
                    </td>
                    <td class=" text-center">{{ $user->last_update_name }}</td>
                    <td class=" text-center">
                        <a href="/users/{{ $user->id }}"
                           @can('update', \App\Models\User::class)
                               class="button-a"
                           @else
                               class="cannot-button-a"
                            @endcan
                        >sửa</a> |
                        <a href="/user-permission/{{ $user->id }}"
                           @can('update', \App\Models\User::class)
                               class="button-a"
                           @else
                               class="cannot-button-a"
                            @endcan
                        >quyền</a> |
                        <button wire:confirm="Bạn có thực sự muốn xóa không?"
                                wire:click='deleteUser({{ $user->id }})'
                                @can('delete', \App\Models\User::class)
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
