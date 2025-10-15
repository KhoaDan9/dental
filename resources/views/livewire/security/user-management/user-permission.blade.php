<div>
    <div class="pb-2 flex justify-between border-b-1 border-gray-300">
        <span>Bảo mật >> <a href="/clinics">Phân quyền người dùng</a>
        >> <a href="/users/{{ $user->id }}">{{ $user->username }}</a>
        </span>

        <div class="flex flex-row space-x-1">
            <button wire:click="updateUserPermissions"
                    @can('update', \App\Models\User::class)
                        class="main-button"
                    @else
                        class="cannot-main-button"
                @endcan
            >Lưu
            </button>
            <a class="a-button" href="/users">Thoát</a>
        </div>
    </div>

    @cannot('viewAny', \App\Models\User::class)
        <x-cannot-permission/>
    @else
        @if ($errorMessage)
            <x-error-message>{{ $errorMessage }}</x-error-message>
        @endif
        @if ($successMessage)
            <x-success-message>{{ $successMessage }}</x-success-message>
        @endif

        <div>
            <table class="table-custom table-auto w-full border-collapse border">
                @foreach ($user_permissions as $key => $feature_list)
                    <tr>
                        <th class="whitespace-nowrap w-0">TT</th>
                        <th class="whitespace-nowrap w-0">ID</th>
                        <th class="whitespace-nowrap text-left">{{ $key }}</th>
                        <th class="whitespace-nowrap px-10!">Xem</th>
                        <th class="whitespace-nowrap px-10!">Thêm</th>
                        <th class="whitespace-nowrap px-10!">Sửa</th>
                        <th class="whitespace-nowrap px-10!">Xóa</th>
                        <th class="whitespace-nowrap px-10!">Export</th>
                        <th class="whitespace-nowrap px-10!">In</th>
                    </tr>
                    @foreach ($feature_list as $access_controls)
                        <tr>
                            <td class="whitespace-nowrap w-0 text-center">{{ $loop->iteration }}</td>
                            <td class="whitespace-nowrap w-0 text-center">{{ $access_controls[0]->feature->id }}</td>
                            <td class="whitespace-nowrap  text-left">{{ $access_controls[0]->feature->name }}</td>

                            @foreach($access_controls as $access_control)
                                <td class="whitespace-nowrap w-0 text-center">
                                    @if ($access_control->user_permission == 0 )
                                        <input type="checkbox" id="" name="" value=""
                                               wire:change='updateAccess({{ $access_control->id }})'>
                                    @elseif($access_control->user_permission == 1)
                                        <input type="checkbox" id="" name="" value="" checked
                                               wire:change='updateAccess({{ $access_control->id }})'>
                                    @else
                                        -
                                    @endif
                                </td>
                            @endforeach
                        </tr>
                    @endforeach
                @endforeach

            </table>
        </div>
    @endcannot
</div>
