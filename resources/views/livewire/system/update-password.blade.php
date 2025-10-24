<div>
    <div class="pb-2 flex justify-between border-b-1 border-gray-300">
        <span>Hệ thống >> <a href="#">Đổi mật khẩu</a></span>
    </div>
    <div>
        <form wire:submit="updatePassword" class="space-y-2">
            <div class="flex w-full flex-col">
                <label>Mật khẩu cũ:<span class="text-red-600">*</span></label>
                <x-text-input class="w-70" model="old_password"/>
                @error('old_password')
                <x-error-message>{{ $message }}</x-error-message>
                @enderror
                @if ($errorMessage != '')
                    <x-error-message>{{ $errorMessage }}</x-error-message>
                @endif
            </div>
            <div class="flex w-full flex-col">
                <label>Mật khẩu mới:<span class="text-red-600">*</span></label>
                <x-text-input class="w-70" model="new_password"/>
                @error('new_password')
                <x-error-message>{{ $message }}</x-error-message>
                @enderror
            </div>
            <div class="flex w-full flex-col">
                <label>Xác nhận mật khẩu mới:<span class="text-red-600">*</span></label>
                <x-text-input class="w-70" model="new_password_confirm"/>
                @error('new_password_confirm')
                <x-error-message>{{ $message }}</x-error-message>
                @enderror
            </div>
            <div class="flex space-x-2">
                <button class="main-button2" type="submit">Đổi mật khẩu</button>
            </div>
            @if ($successMessage != '')
                <x-success-message>{{ $successMessage }}</x-success-message>
            @endif
        </form>
    </div>

</div>
