@props(['title_1', 'url_1' => '', 'search_from_date'=>null, 'search_to_date'=>null,
          'w_search_date'=>'w-50', 'employee_id' =>null,
          'service_group_id'=>null, 'service_id'=>null, 'patient_from'=>null,
          'service_group', '$services', 'employee_value'
          ])

<div class="pb-2 flex justify-between border-b-1 border-gray-300 mb-2">
    <div>
        <span>Báo cáo >> <a href="{{ $url_1 }}">{{ $title_1 }}</a>

        </span>
    </div>
    <div class="flex space-x-1">
        @if ($search_from_date)
            <x-text-input id="datepicker-actions" type="date" class="{{ $w_search_date }}"
                          model="{{ $search_from_date }}"/>
        @endif
        @if ($search_to_date)
            <x-text-input id="datepicker-actions" type="date" class="{{ $w_search_date }}"
                          model="{{ $search_to_date }}"/>
        @endif

        @if($service_group_id)
            <div>
                <label>

                </label>
                <x-all-select-input w_title="w-0" model="{{$service_group}}"
                                    :values="$service_groups"/>
            </div>
        @endif
        @if($service_id)
            <div>
                <label>

                </label>
                <x-all-select-input w_title="w-0" model="{{$service_id}}"
                                    :values="$services"/>
            </div>
        @endif
        @if($patient_from)
            <div>
                <label></label>
                <select class="border-gray-400 border-[0.5px] rounded" wire:model='patient_from'>
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
