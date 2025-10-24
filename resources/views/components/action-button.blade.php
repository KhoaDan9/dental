@props(['model','action-model', 'type' => 'text', 'title', 'is_required'])

<div class="w-full flex">
    <p class="w-35"></p>

    @if ($is_create == 'create')
        <button type="submit" form="patient-form"
                @can('create', \App\Models\Patient::class)
                    class="main-button"
                @else
                    class="cannot-main-button"
            @endcan
        >Thêm
        </button>
    @else
        <button type="submit" form="patient-form"
                wire:dirty.remove.attr='disabled' disabled
                @can('update', \App\Models\Patient::class)
                    class="main-button"
                @else
                    class="cannot-main-button"
            @endcan
        >Sửa
        </button>
    @endif
</div>

<div class="flex w-full">
    <p for="" class="{{ $w_title }}">{{ $title }}@if($is_required)<span class="text-red-600">*</span>@endif
    </p>
    <div class="flex flex-grow flex-col">
        <input type="{{ $type }}"
               {{ $attributes->merge(['class' => 'p-1 border-gray-500 border-[0.5px] w-30 rounded outline-none'])}}
               wire:model='{{ $model }}'>
        @error('clinic_id')
        <x-error-message>{{ $message }}</x-error-message>
        @enderror
    </div>

</div>
