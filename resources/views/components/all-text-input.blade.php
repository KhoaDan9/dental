@props(['model', 'type' => 'text', 'title', 'w_title' => 'w-35', 'is_required' => false])

<div class="flex w-full">
    <p for="" class="{{ $w_title }}">{{ $title }}@if($is_required)<span class="text-red-600">*</span>@endif
    </p>
    <div class="flex flex-grow flex-col">
        <input type="{{ $type }}"
               {{ $attributes->merge(['class' => 'p-1 border-gray-400 border-[0.5px] rounded outline-none'])}}
               wire:model='{{ $model }}'>
        @error($model)
        <x-error-message>{{ $message }}</x-error-message>
        @enderror
    </div>

</div>
