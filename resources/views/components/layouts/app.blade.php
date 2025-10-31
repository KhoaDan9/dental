<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
{{--    <script src="//unpkg.com/alpinejs" defer></script>--}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <title>{{ $title ?? 'Page Title' }}</title>

</head>

<body>
    <nav class="flex justify-between px-3 py-2.5 bg-blue nav-layout bg-nav-bg w-full">
        <div class="text-white pl-2">
            <a href="/patients">
                <img src="{{Storage::url('/photos/Logo.png')}}" class="w-20" alt="">
            </a>
        </div>
        <div class="text-white space-x-2">
            <a href="/patients" class="text-nav-title!">Bệnh nhân</a>
            <a href="/appointments" class="text-nav-title!">Lịch hẹn</a>
            <a href="/transaction-vouchers" class="text-nav-title!">Thu/Chi</a>
            <a href="/users/{{ Auth::user()->id }}" class="text-nav-title!">Xin chào: {{ Auth::user()->username }}</a>
            <a href="/logout" class="text-nav-title!">Đăng xuất</a>
        </div>
    </nav>
    <div class="flex py-1 bg-menu-title border-b border-solid border-gray-300 menu-layout w-full">
        <x-menu-item title="Hệ thống">
            <li class="li-menu"><a href="/clinics" class="a-menu ">Thông tin phòng khám</a></li>
            <li class="li-menu"><a href="/change-password" class="a-menu ">Đổi mật khẩu</a></li>
        </x-menu-item>

        <x-menu-item title="Dữ liệu">
            <li class="li-menu"><a href="/employees" class="a-menu">Danh sách nhân viên</a></li>
            {{-- <li class="li-menu"><a href="" class="a-menu">Bảng lương nhân viên</a></li> --}}
            <li class="li-menu"><a href="/service-groups" class="a-menu">Nhóm dịch vụ/thủ thuật</a></li>
            <li class="li-menu"><a href="/services" class="a-menu">Danh sách dịch vụ/thủ thuật</a></li>
            <li class="li-menu"><a href="/" class="a-menu">Hồ sơ bệnh nhân</a></li>
            <li class="li-menu"><a href="/appointments" class="a-menu">Lịch hẹn</a></li>
{{--            <li class="li-menu"><a href="/warranty-cards" class="a-menu">Thẻ bảo hành</a></li>--}}
            <li class="li-menu"><a href="/funding-sources" class="a-menu">Nguồn quỹ</a></li>
            <li class="li-menu"><a href="/finances" class="a-menu">Nhóm thu/chi</a></li>
            <li class="li-menu"><a href="/transaction-vouchers" class="a-menu">Quản lý thu/chi</a></li>
{{--            <li class="li-menu"><a href="/suppliers" class="a-menu">Nhà cung cấp/xưởng</a></li>--}}
            {{-- <li class="li-menu"><a href="" class="a-menu">Quản lý đặt xưởng</a></li> --}}
        </x-menu-item>

        <x-menu-item title="Danh mục">
            <li class="li-menu"><a href="/reminders" class="a-menu">Mẫu lời dặn</a></li>
            <li class="li-menu"><a href="/prescriptions" class="a-menu">Mẫu đơn thuốc</a></li>
{{--            <li class="li-menu"><a href="/diagnosis-groups" class="a-menu">Nhóm chẩn đoán</a></li>--}}
{{--            <li class="li-menu"><a href="/diagnoses" class="a-menu">Mẫu chẩn đoán</a></li>--}}
            <li class="li-menu"><a href="/material-groups" class="a-menu">Nhóm vật tư</a></li>
            <li class="li-menu"><a href="/materials" class="a-menu">Danh sách vật tư</a></li>
            {{-- <li class="li-menu"><a href="/address" class="a-menu">Địa chỉ mặc định</a></li> --}}
        </x-menu-item>

        <x-menu-item title="Báo cáo">
            <li class="li-menu"><a href="" class="a-menu">Chi tiết khách hàng</a></li>
            <li class="li-menu"><a href="" class="a-menu">Khách hàng nợ tiền</a></li>
            <li class="li-menu"><a href="" class="a-menu">Khách hàng tiềm năng</a></li>
            <li class="li-menu"><a href="" class="a-menu">Tổng hợp thuật thực hiện</a></li>
            <li class="li-menu"><a href="" class="a-menu">Chi tiết thủ thuật theo nhân viên</a></li>
            <li class="li-menu"><a href="" class="a-menu">Báo cáo chi tiết thu, chi</a></li>
            <li class="li-menu"><a href="" class="a-menu">Tổng hợp theo nhóm thu, chi</a></li>
            <li class="li-menu"><a href="" class="a-menu">Tổng hợp thu, chi, tồn quỹ</a></li>
            {{--                <li class="li-menu"><a href="" class="a-menu">Công nợ nhà cung cấp</a></li>--}}
        </x-menu-item>

        <x-menu-item title="Bảo mật">
            <li class="li-menu"><a href="/users" class="a-menu">Quản lý tài khoản</a></li>
            <li class="li-menu"><a href="/data-logs" class="a-menu">Lịch sử hoạt động</a></li>
        </x-menu-item>

    </div>
    <div class="px-3 py-2 ">
        {{ $slot }}
    </div>
</body>

</html>
