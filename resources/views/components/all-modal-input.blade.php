@props(['model', 'title', 'w_title' => 'w-35', 'is_required' => false, 'modal_show_id'])

<div class="w-full flex">
    <p for="" class="{{ $w_title }}">{{ $title }}@if($is_required)<span class="text-red-600">*</span>@endif
    </p>
    <div class="flex flex-grow flex-col">
        <div class="flex flex-grow">
            <input type="text" class="px-1  border-gray-400 border-[0.5px] rounded flex-grow"
                   wire:model='{{ $model }}' readonly>
            <button class="main-button mx-1" type="button" modal-show-id="{{ $modal_show_id }}">Chọn</button>
        </div>
        @error($model)
        <x-error-message>{{ $message }}</x-error-message>
        @enderror
    </div>
</div>
