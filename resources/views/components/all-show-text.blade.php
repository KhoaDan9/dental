@props(['w_title' => 'w-35', 'title', 'text'])

<div class="flex w-full">
    <p class="{{ $w_title }}">{{ $title }}</p>
    <p class="font-bold">{{ $text }}</p>
</div>


