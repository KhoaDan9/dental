@props(['action_model', 'head_title', 'title_1', 'title_2' => null, 'title_3' => null, 'title_4' => null, 'url_1' => '#', 'url_2' => '#', 'url_3' => '#', 'url_4' => '#', 'create_url'=>null , 'exit_url'=>null ])

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
        <a href="{{ $create_url }}"
           @can('create', $action_model)
               class="a-button"
           @else
               class="cannot-a-button"
            @endcan
        >Thêm</a>
        @if($exit_url)
            <a href="{{ $exit_url }}" class="a-button">Thoát</a>
        @endif
    </div>
</div>
