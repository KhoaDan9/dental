@props(['w_title' => 'w-35', 'name', 'updated_at'])

<div class="flex w-full">
    <p class="{{ $w_title }}">Người cập nhật:</p>
    <x-last-update-name :name="$name" :updated_at="$updated_at"/>
</div>


