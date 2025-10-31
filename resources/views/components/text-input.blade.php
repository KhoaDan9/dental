@props(['model', 'type' => 'text'])

<input type="{{ $type }}"
       {{ $attributes->merge(['class' => 'p-1 border-gray-400 border-[0.5px] w-30 rounded outline-none'])}}
       wire:model='{{ $model }}'>
