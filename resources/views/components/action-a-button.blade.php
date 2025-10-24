@props(['action_model', 'edit_url', 'delete_event'])

<td class="text-center">
    <a href="{{ $edit_url }}"
        @cannot('update', $action_model)
            class="cannot-a"
        @endcannot
    >sửa</a> |
    <button wire:click.prevent="{{ $delete_event }}"
            @can('delete', $action_model)
                class="button-a"
            @else
                class="cannot-button-a"
            @endcan
            wire:confirm="Bạn có thực sự muốn xóa không?">xóa
    </button>
</td>
