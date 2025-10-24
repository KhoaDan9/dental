@props(['action_model', 'w_title' => 'w-35', 'create_url', 'exit_url'])

<div class="w-full flex space-x-1">
    <p class="{{$w_title}}"></p>

    @if ($is_create == 'create')
        <button type="submit"
                @can('create', $action_model)
                    class="main-button"
                @else
                    class="cannot-main-button"
            @endcan
        >Thêm
        </button>
    @else
        <button type="submit"
                wire:dirty.remove.attr='disabled' disabled
                @can('update', $action_model)
                    class="main-button"
                @else
                    class="cannot-main-button"
            @endcan
        >Sửa
        </button>
    @endif
    @if($exit_url)
        <a href="{{ $exit_url }}" class="a-button">Thoát</a>
    @endif
</div>

