@props(['model', 'type' => 'radio', 'title' => 'Trạng thái:', 'w_title' => 'w-35', 'title_1' => 'Bật', 'title_2' => 'Tắt'])


<div class="flex w-full">
    <p for="" class="{{ $w_title }}">{{ $title }}</p>
    <div class="flex space-x-2 flex-1">
        <label for="{{ $title_1 }}" class="flex items-center">
            <input type="{{ $type }}" id="{{ $title_1 }}" name="{{ $title_1 }}" value=1 wire:model='{{ $model }}'>
            {{ $title_1 }}
        </label>
        <label for="{{ $title_2 }}" class="flex items-center">
            <input type="{{ $type }}" id="{{ $title_2 }}" name="{{ $title_1 }}" value=0 wire:model='{{ $model }}'>
            {{ $title_2 }}
        </label>
    </div>
</div>
