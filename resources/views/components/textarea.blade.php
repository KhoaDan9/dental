@props(['model', 'type' => 'text'])

<textarea type="text"
          {{ $attributes->merge(['class' => 'px-1 border-gray-500 border-[0.5px] rounded h-20'])}}
          wire:model='{{ $model }}'></textarea>

