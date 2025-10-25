@props(['action_model', 'w_title'=>'w-35', 'title', 'is_create', 'exit_url'])

<div class="w-full flex space-x-1">
    <p class="{{$w_title}}"></p>

    @if ($is_create == 'create')
        @can('create', $action_model)
            <button type="button" wire:click="saveAndExit" class="main-button2">Lưu và thoát</button>
            <button type="button" wire:click="save" class="main-button">Lưu</button>
        @else 
            <button type="button" wire:click="saveAndExit" class="cannot-main-button2">Lưu và thoát</button>
            <button type="button" wire:click="save" class="cannot-main-button">Lưu</button>
        @endcan
    @else
        @can('update', $action_model)
            <button type="button" wire:click="saveAndExit" class="main-button2">Lưu và thoát</button>
            <button type="button" wire:click="save" class="main-button">Lưu</button>
        @else 
            <button type="button" wire:click="saveAndExit" class="cannot-main-button2">Lưu và thoát</button>
            <button type="button" wire:click="save" class="cannot-main-button">Lưu</button>
        @endcan
    @endif
    @if($exit_url) <a href="{{ $exit_url }}" class="a-button">Thoát</a> @endif
</div>
