@props(['action_model', 'w_title'=>'w-35', 'title', 'is_create', 'exit_url'])

<div class="w-full flex space-x-1">
    <p class="{{$w_title}}"></p>

    @if ($is_create == 'create')
        <button type="submit"
                @can('create', $action_model)
                    class="main-button"
                @else
                    class="cannot-main-button"
            @endcan
        >Lưu và thoát
        </button>
    @else
        <button type="submit"
                @can('update', $action_model)
                    class="main-button"
                @else
                    class="cannot-main-button"
            @endcan
        >Lưu và thoát
        </button>
    @endif
    @if($exit_url) <a href="{{ $exit_url }}" class="a-button">Thoát</a> @endif
</div>
