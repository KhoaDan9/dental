@props(['model', 'type' => 'text'])

<input type="{{ $type }}"
       {{ $attributes->merge(['class' => 'p-1 border-gray-400 border-[0.5px] flex-grow rounded outline-none'])}}
       wire:model='{{ $model }}'>
