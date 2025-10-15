<div class="flex-col">
    <div class="pb-2 flex justify-between border-b-1 border-gray-300">
        <div>
            <span>Bảo mật>> <a href="/users">Danh sách tài khoản</a>
            </span>
        </div>
        <div class="flex space-x-1">
            <a href="users/create"
               @can('create', \App\Models\User::class)
                   class="a-button"
               @else
                   class="cannot-a-button"
                @endcan
            >Thêm</a>
        </div>
    </div>


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
                    <td class="text-center">{{ $user->id }}</td>
                    <td class="">{{ $user->username }}</td>
                    <td class=" text-center">{{ $user->clinic_id }}</td>
                    <td class="">{{ $user->note }}</td>
                    <td class="text-center">
                        @if ($user->active)
                            Bật
                        @else
                            Tắt
                        @endif
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
