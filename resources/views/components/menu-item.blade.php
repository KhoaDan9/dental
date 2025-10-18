<div class="relative group"
     x-data="{ open: false }"
     @mouseenter="open = true"
     @mouseleave="open = false">
    <span class="cursor-pointer px-3 select-none" @click="open = !open">{{ $title }}</span>
    <ul class="ul-menu"
        x-show="open"
        @click.outside="open = false">
        {{ $slot }}
    </ul>
</div>
