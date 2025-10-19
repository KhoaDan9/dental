<div class="fixed inset-0 flex items-center justify-center z-50 bg-gray-500">
    <div class="flex flex-col">
        <form wire:submit='login'>
            <div class="bg-white rounded-lg shadow-lg w-full flex flex-col h-80 px-15 py-10">
                <div class="flex justify-center pb-5">
                    <img src="{{Storage::url('/photos/Logo-black.png')}}" class="w-40" alt="">
                </div>
                <div>
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
                    <input class="px-1 border-gray-500 border-1 py-1  w-100" type="password" wire:model='password'>
                    <div>
                        @error('password')
                        <x-error-message>{{ $message }}</x-error-message>
                        @enderror
                    </div>
                    <button type="submit" class="!w-full main-button my-2 py-1" >Đăng nhập</button>
                </div>

            </div>
        </form>
    </div>

</div>
