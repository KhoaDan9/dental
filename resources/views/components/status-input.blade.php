@props(['model', 'type' => 'radio', 'title' => 'Trạng thái:', 'w_title' => 'w-35'])


<div class="flex w-full">
    <p for="" class="{{ $w_title }}">{{ $title }}</p>
    <div class="flex space-x-2 flex-1">
        <label for="status1" class="flex items-center">
            <input type="{{ $type }}" id="status1" name="active" value=1 wire:model='{{ $model }}'>
            Bật
        </label>
        <label for="status2" class="flex items-center">
            <input type="{{ $type }}" id="status2" name="active" value=0 wire:model='{{ $model }}'>
            Tắt
        </label>
    </div>
</div>
