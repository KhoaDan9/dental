@props(['is_active'])
@if ($is_active)
    <p>Bật</p>
@else
    <p class="text-red-500">Tắt</p>
@endif
