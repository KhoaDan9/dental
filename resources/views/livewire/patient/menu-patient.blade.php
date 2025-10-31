<div class="page-header">
    <div>
        <span>Dữ liệu >> <a href="/patients">Hồ sơ bệnh nhân</a>
            @if ($patient->id)
                >>
                <a href="/patients/{{ $patient->id }}">{{ $patient->clinic_id }}.{{ $patient->id }}</a>
            @endif

            @if ($is_patient_service != '')
                >>
                <a href="">Thủ thuật điều trị</a>
            @elseif($is_patient_prescription != '')
                >>
                <a href="">Đơn thuốc</a>
            @elseif($is_patient_appointment != '')
                >>
                <a href="">Lịch hẹn</a>
            @elseif($is_patient_payment != '')
                >>
                <a href="">Thanh toán</a>
            @elseif($is_patient_reminder != '')
                >>
                <a href="">Lời dặn</a>
            @elseif($is_patient_warranty != '')
                >>
                <a href="">Thẻ bảo hành</a>
            @endif
        </span>
    </div>
    <div class="flex space-x-1">
        @if ($show_search != '')
            <input class="border-gray-400 border-1 pl-1 w-60 " type="text" placeholder="Tìm kiếm"
                   wire:model="search_string">

            <input id="datepicker-actions" type="date" wire:model="search_date" type="text"
                   class="w-35 text-center border-gray-400 border-1 px-1">

            <button wire:click="searchSubmit" class="main-button" wire:navigate.hover>Tìm</button>
        @endif


        @if ($create_url != '')
            <a href="{{ $create_url }}" class="a-button">Thêm</a>
        @endif
        @if ($exit_url != '')
            <a href="{{ $exit_url }}" class="a-button">Thoát</a>
        @endif
    </div>

</div>
