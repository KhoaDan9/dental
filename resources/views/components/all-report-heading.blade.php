@props(['title_1', 'url_1' => '', 'search_from_date'=>null, 'search_to_date'=>null,
          'w_search_date'=>'w-50', 'employee_id' =>null,
          'service_group_id'=>null, 'service_id'=>null, 'patient_from'=>null,
          'service_groups', 'services', 'employees'
          ])

<div class="pb-2 flex justify-between border-b-1 border-gray-300 mb-2">
    <div>
        <span>Báo cáo >> <a href="{{ $url_1 }}">{{ $title_1 }}</a>

        </span>
    </div>
    <div class="flex space-x-1">
        <div class="flex flex-col">
            <label for="">Từ ngày:</label>
            @if ($search_from_date)
            <x-text-input type="date" class="{{ $w_search_date }}"
                          model="{{ $search_from_date }}"/>
            @endif
        </div>
        <div class="flex flex-col">
            <label for="">Đến ngày:</label>
           @if ($search_to_date)
            <x-text-input type="date" class="{{ $w_search_date }}"
                          model="{{ $search_to_date }}"/>
            @endif
        </div>
 
        @if($employee_id)
            <div class="flex flex-col">
                <label>Nhân viên:</label>
                <div class="flex flex-grow flex-col">
                    <select class='pl-1 border-gray-400 border-[0.5px] rounded outline-none'
                            wire:model='{{ $employee_id }}'>
                            <option value="">-</option>
                        @foreach ($employees as $employee)
                            <option value="{{ $employee->id }}">{{ $employee->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        @endif
        @if($service_group_id)
            <div class="flex flex-col">
                <label>Nhóm:</label>
                <div class="flex flex-grow flex-col">
                    <select class='pl-1 border-gray-400 border-[0.5px] rounded outline-none'
                            wire:model='{{ $service_group_id }}'>
                            <option value="">-</option>
                        @foreach ($service_groups as $service_group)
                            <option value="{{ $service_group->id }}">{{ $service_group->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        @endif
        @if($service_id)
            <div class="flex flex-col">
                <label>Thủ thuật/dịch vụ:</label>
                <div class="flex flex-grow flex-col">
                    <select class='pl-1 border-gray-400 border-[0.5px] rounded outline-none'
                            wire:model='{{ $service_id }}'>
                            <option value="">-</option>
                        @foreach ($services as $service)
                            <option value="{{ $service->id }}">{{ $service->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        @endif
        @if($patient_from)
            <div class="flex flex-col">
                <label>Nguồn:</label>
                <select class="border-gray-400 border-[0.5px] rounded" wire:model='{{ $patient_from }}'>
                    <option value="">-</option>
                    <option value="Khác">Khác</option>
                    <option value="Facebook">Facebook</option>
                    <option value="Google">Google</option>
                    <option value="Tiktok">Tiktok</option>
                    <option value="Youtube">Youtube</option>
                </select>
            </div>
        @endif

        <button wire:click="searchSubmit" class="main-button" wire:navigate.hover>Tìm</button>
    </div>
</div>
