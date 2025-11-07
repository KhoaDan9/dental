@props(['action_model' => null, 'head_title', 'title_1', 'title_2' => null, 'title_3' => null, 'title_4' => null, 'url_1' => '', 'url_2' => '', 'url_3' => '', 'url_4' => ''
        , 'create_url'=>null , 'exit_url'=>null, 'search_model'=>null, 'search_date'=>null, 'w_search'=>'w-60', 'w_search_date'=>'w-50' ])

<div class="pb-2 flex justify-between border-b-1 border-gray-300 mb-2">
    <div>
        <span>{{ $head_title }} >> <a href="{{ $url_1 }}">{{ $title_1 }}</a>
            @if($title_2)
                >> <a href="{{ $url_2 }}">{{ $title_2 }}</a>
            @endif
            @if($title_3)
                >> <a href="{{ $url_3 }}">{{ $title_3 }}</a>
            @endif
            @if($title_4)
                >> <a href="{{ $url_4 }}">{{ $title_4 }}</a>
            @endif
        </span>
    </div>
    <div class="flex space-x-1">
        @if ($search_model)
            <x-text-input class="{{ $w_search }}" model="{{ $search_model }}" placeholder="Tìm kiếm"/>
        @endif
        @if ($search_date)
            <x-text-input id="datepicker-actions" type="date" class="{{ $w_search_date }}" model="{{ $search_date }}"/>
        @endif
        @if ($search_model || $search_date)
            <button wire:click="searchSubmit" class="main-button" wire:navigate.hover>Tìm</button>
        @endif
        @if($create_url)
            <a href="{{ $create_url }}"
               @can('create', $action_model)
                   class="a-button"
               @else
                   class="cannot-a-button"
                @endcan
            >Thêm</a>
        @endif

        @if($exit_url)
            <a href="{{ $exit_url }}" class="a-button">Thoát</a>
        @endif
    </div>
</div>
