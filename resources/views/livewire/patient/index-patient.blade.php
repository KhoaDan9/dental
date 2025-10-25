<div>
    <x-all-heading head_title="Dữ liệu" title_1="Hồ sơ bệnh nhân" url_1="/patients" create_url="/employees/create"
                   :action_model="\App\Models\Employee::class" search_model="search_string" search_date="search_date"/>
        @cannot('viewAny', \App\Models\Patient::class)
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
                    <td
                        @if($patient->medical_history != null || $patient->medical_history != null)
                            class="text-red-500"
                        @endif>
                        {{ $patient->name }}</td>
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
