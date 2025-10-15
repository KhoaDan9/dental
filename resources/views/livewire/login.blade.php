<div class="fixed inset-0 flex items-center justify-center z-50 bg-gray-500">
    <div class="flex flex-col">
        <form wire:submit='login'>
            <div class="bg-white rounded-lg shadow-lg w-full flex flex-col justify-center h-100 px-20">
                <p>Tên đăng nhập</p>
                <input class="px-1 border-gray-500 border-1 py-1 w-100" type="text" wire:model='username'>
                @if ($errorMessage !== '')
                    <x-error-message>{{ $errorMessage }}</x-error-message>
                @endif
                <div>
                    @error('username')
                        <x-error-message>{{ $message }}</x-error-message>
                    @enderror
                </div>
                <p>Mật khẩu</p>
                <input class="px-1 border-gray-500 border-1 py-1  w-100" type="text" wire:model='password'>
                 <div>
                    @error('password')
                        <x-error-message>{{ $message }}</x-error-message>
                    @enderror
                </div>
                <button type="submit" class="!w-full main-button my-2 py-1">Đăng nhập</button>
            </div>
        </form>
    </div>

</div>
