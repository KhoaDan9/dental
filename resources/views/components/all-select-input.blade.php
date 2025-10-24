@props(['model', 'title', 'w_title' => 'w-35', 'values'])

<div class="flex w-full">
    <p for="" class="{{ $w_title }}">{{ $title }}</p>
    <div class="flex flex-grow flex-col">
        <select
            {{ $attributes->merge(['class' => 'pl-1 border-gray-500 border-[0.5px] rounded outline-none'])}}
                wire:model='{{ $model }}'>
            @foreach ($values as $value)
                <option value="{{ $value->id }}">{{ $value->name }}</option>
            @endforeach
        </select>
    </div>
</div>
