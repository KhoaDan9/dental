<div class="flex-col">
    @cannot('viewAny', \App\Models\Patient::class)
        <x-cannot-permission/>
    @else
        <div class="pb-2 flex justify-between border-b-1 border-gray-300 mb-2">
            <div>
                <span>Dữ liệu >> <a href="/patients">Hồ sơ bệnh nhân</a></span>
            </div>
            <div class="flex space-x-1">
                <x-text-input class="w-60" model="search_string" placeholder="Tìm kiếm"/>
                <x-text-input id="datepicker-actions" type="date" class="w-35" model="search_date"/>

                <button wire:click="searchSubmit" class="main-button" wire:navigate.hover>Tìm</button>
                <a href="/patients/create"
                   @can('create', \App\Models\Patient::class)
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

        <table class="table-custom table-auto w-full border-collapse border">
            <tr>
                <th class="whitespace-nowrap w-0">TT</th>
                <th class="whitespace-nowrap w-0">Giờ đến</th>
                <th class="whitespace-nowrap w-0">Mã số</th>
                <th class="whitespace-nowrap text-left">Họ và tên</th>
                <th class="whitespace-nowrap w-0">NS</th>
                <th class="whitespace-nowrap w-0">GT</th>
                <th class="whitespace-nowrap w-0 sm:w-1/6 text-left">Địa chỉ</th>
                <th class="whitespace-nowrap text-left">Điện thoại</th>
                <th class="whitespace-nowrap w-0 sm:w-1/6 text-left">Nguồn</th>
                <th class="whitespace-nowrap text-left">Nội dung khám</th>
                <th class="whitespace-nowrap w-0">PK</th>
                <th class="whitespace-nowrap w-0">Cập nhật</th>
                <th class="whitespace-nowrap w-0 mx-4">Trạng thái</th>
                <th class="whitespace-nowrap w-0 mx-4">Chức năng</th>
            </tr>
            @foreach ($patients as $patient)
                <tr>
                    <td class=" text-center">{{ $loop->iteration }}</td>
                    <td class="">{{ \Carbon\Carbon::parse($patient->created_at)->format('H:i:s') }}</td>
                    <td class=" text-center"><a href="/patients/{{ $patient->id }}">{{ $patient->id }}</a></td>
                    <td class="">{{ $patient->name }}</td>
                    <td>{{ \Carbon\Carbon::parse($patient->birth)->year }}</td>
                    <td class=" text-center">{{ $patient->gender }}</td>
                    <td class="">{{ $patient->address }}</td>
                    <td class=" ">{{ $patient->phone }}</td>
                    <td class="">{{ $patient->from }}
                        @if ($patient->from_note)
                            | {{ $patient->from_note }}
                        @endif
                    </td>
                    <td class="">{{ $patient->medical_examination }}</td>
                    <td class=" text-center">{{ $patient->clinic_id }}</td>
                    <td class=" text-center">{{ $patient->last_update_name }}</td>
                    <td class=" text-center"><a
                            href="/edit-status/{{ $patient->id }}">{{ $patient->patient_status }}</a>
                    </td>
                    <td class=" text-center">
                        <a href="/patients/{{ $patient->id }}" wire:navigate
                           @cannot('update', \App\Models\Patient::class)
                               class="cannot-a"
                            @endcannot
                        >sửa</a> |
                        <button
                            @cannot('delete', \App\Models\Patient::class)
                                class="button-a"
                            @else
                                class="cannot-button-a"
                            @endcannot
                            wire:click.prevent="deletePatient({{ $patient->id }})">xóa
                        </button>
                    </td>
                </tr>
            @endforeach
        </table>
    @endcannot

</div>
