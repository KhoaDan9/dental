@props(['model', 'title', 'w_title' => 'w-35', 'is_required' => false])


<div class="flex w-full">
    <p for="" class="{{ $w_title }}">{{ $title }}@if($is_required)<span class="text-red-600">*</span>@endif
    </p>
    <div class="flex flex-grow flex-col">
        <textarea type="text"
                  {{ $attributes->merge(['class' => 'px-1 border-gray-400 border-[0.5px] rounded h-20'])}}
                  wire:model='{{ $model }}'></textarea>

    </div>

</div>
