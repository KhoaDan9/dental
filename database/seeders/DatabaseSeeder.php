<?php

namespace Database\Seeders;

use App\Models\AccessControl;
use App\Models\Appointment;
use App\Models\Clinic;
use App\Models\Diagnosis;
use App\Models\DiagnosisGroup;
use App\Models\Employee;
use App\Models\Feature;
use App\Models\Finance;
use App\Models\FundingSource;
use App\Models\Material;
use App\Models\MaterialGroup;
use App\Models\Patient;
use App\Models\PatientService;
use App\Models\Permission;
use App\Models\Prescription;
use App\Models\Reminder;
use App\Models\Service;
use App\Models\ServiceGroup;
use App\Models\Supplier;
use App\Models\TransactionVoucher;
use App\Models\User;
use App\Models\WarrantyCard;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        Permission::create([
            'name' => 'Xem'
        ]);

        Permission::create([
            'name' => 'Thêm'
        ]);

        Permission::create([
            'name' => 'Sửa'
        ]);

        Permission::create([
            'name' => 'Xóa'
        ]);

        Permission::create([
            'name' => 'Xuất file'
        ]);

        Permission::create([
            'name' => 'In'
        ]);


        //He thong

        Feature::create([
            'name' => 'Thông tin phòng khám',
            'category' => 'Hệ thống'
        ]);

        Feature::create([
            'name' => 'Thông tin tài khoản',
            'category' => 'Hệ thống'
        ]);

        // Du lieu

        Feature::create([
            'name' => 'Danh sách nhân viên',
            'category' => 'Dữ liệu'
        ]);

        Feature::create([
            'name' => 'Bảng lương nhân viên',
            'category' => 'Dữ liệu'
        ]);

        Feature::create([
            'name' => 'Nhóm dịch vụ/thủ thuật',
            'category' => 'Dữ liệu'
        ]);

        Feature::create([
            'name' => 'Danh sách dịch vụ/thủ thuật',
            'category' => 'Dữ liệu'
        ]);

        Feature::create([
            'name' => 'Hồ sơ bệnh nhân',
            'category' => 'Dữ liệu'
        ]);

        Feature::create([
            'name' => 'Quản lý đặt xưởng',
            'category' => 'Dữ liệu'
        ]);

        Feature::create([
            'name' => 'Nhà cung cấp, xưởng',
            'category' => 'Dữ liệu'
        ]);

        //Bệnh án
        Feature::create([
            'name' => 'Thủ thuật bệnh nhân',
            'category' => 'Bệnh án'
        ]);
        Feature::create([
            'name' => 'Lịch hẹn',
            'category' => 'Bệnh án'
        ]);
        Feature::create([
            'name' => 'Lời dặn',
            'category' => 'Bệnh án'
        ]);
        Feature::create([
            'name' => 'Đơn thuốc',
            'category' => 'Bệnh án'
        ]);
        Feature::create([
            'name' => 'Thanh toán',
            'category' => 'Bệnh án'
        ]);
        Feature::create([
            'name' => 'Thẻ bảo hành',
            'category' => 'Bệnh án'
        ]);
        Feature::create([
            'name' => 'In bệnh án',
            'category' => 'Bệnh án'
        ]);

        //Thu chi
        Feature::create([
            'name' => 'Nguồn quỹ',
            'category' => 'Thu chi'
        ]);

        Feature::create([
            'name' => 'Nhóm thu chi',
            'category' => 'Thu chi'
        ]);
        Feature::create([
            'name' => 'Quản lý thu chi',
            'category' => 'Thu chi'
        ]);

        //Danh mục
        Feature::create([
            'name' => 'Mẫu lời dặn',
            'category' => 'Danh mục'
        ]);

        Feature::create([
            'name' => 'Mẫu đơn thuốc',
            'category' => 'Danh mục'
        ]);

        Feature::create([
            'name' => 'Nhóm chẩn đoán',
            'category' => 'Danh mục'
        ]);
        Feature::create([
            'name' => 'Mẫu chẩn đoán',
            'category' => 'Danh mục'
        ]);
        Feature::create([
            'name' => 'Nhóm vật tư',
            'category' => 'Danh mục'
        ]);
        Feature::create([
            'name' => 'Danh sách vật tư',
            'category' => 'Danh mục'
        ]);

        //Báo cáo
        Feature::create([
            'name' => 'Chi tiết bệnh nhân',
            'category' => 'Báo cáo'
        ]);
        Feature::create([
            'name' => 'Bệnh nhân nợ tiền',
            'category' => 'Báo cáo'
        ]);
        Feature::create([
            'name' => 'Khách hàng tiềm năng',
            'category' => 'Báo cáo'
        ]);
        Feature::create([
            'name' => 'Tổng hợp thủ thuật đã thực hiện',
            'category' => 'Báo cáo'
        ]);
        Feature::create([
            'name' => 'Chi tiết thủ thuật theo nhân viên',
            'category' => 'Báo cáo'
        ]);
        Feature::create([
            'name' => 'Tổng hợp thủ thuật theo nhân viên',
            'category' => 'Báo cáo'
        ]);
        Feature::create([
            'name' => 'Tổng hợp doanh thu theo nhân viên',
            'category' => 'Báo cáo'
        ]);
        Feature::create([
            'name' => 'Bảng lương',
            'category' => 'Báo cáo'
        ]);
        Feature::create([
            'name' => 'Báo cáo chi tiết thu, chi',
            'category' => 'Báo cáo'
        ]);
        Feature::create([
            'name' => 'Tổng hợp theo nhóm thu, chi',
            'category' => 'Báo cáo'
        ]);
        Feature::create([
            'name' => 'Tổng hợp thu, chi, tồn quỹ',
            'category' => 'Báo cáo'
        ]);

        //Bảo mật
        Feature::create([
            'name' => 'Quản lý tài khoản',
            'category' => 'Bảo mật'
        ]);
        Feature::create([
            'name' => 'Log hành động',
            'category' => 'Bảo mật'
        ]);


        Clinic::factory()->count(1)->create();

        Clinic::create(
            [
                'id' => 'DK2',
                'name' => 'Nha khoa Happy',
                // 'short_name' => 'Hapy Dental',
                'address' => 'Phung Xa, Thach That',
                'phone' => '135486765423',
                'bank_account_number' => '11534543211534534 BIDV',
                'active' => false
            ]
        );

        Clinic::create(
            [
                'id' => 'DK3',
                'name' => 'Nha Happy',
                // 'short_name' => 'Hapy Dental 2',
                'address' => 'Phung Xa, Thach That',
                'phone' => '1892189712789',
                'bank_account_number' => '122131236128671 BIDV',
                'active' => true
            ]
        );

        Employee::create([
            'clinic_id' => 'DK2',
            'name' => 'Nhan vien phong 2',
            'birth' => fake()->date(),
            'doctor' => true,
            'active' => true
        ]);

        Employee::factory()->count(5)->create();

        User::factory()->create([
            'username' => 'admin',
            'email' => 'adminzzz@example.com',
            'employee_id' => '1',
            'admin' => 1
        ]);

        User::factory()->create([
            'username' => 'asd',
            'password' => '123123',
            'clinic_id' => 'DK2',
            'employee_id' => '1',
            'email' => 'user@example.com',
        ]);

        User::factory()->create([
            'username' => 'asdzxc',
            'email' => 'ovanke@example.com',
        ]);

        User::create([
            'username' => 'ac',
            'email' => 'test@example.com',
            'clinic_id' => 'DK1',
            'employee_id' => '1',
            'password' => '123123',
            'admin' => 1,
            'active' => true,
            'last_update_name' => 'admin',
        ]);

        User::factory()->create();



        Supplier::factory()->create([
            'name' => "Khác",
            'clinic_id' => 'DK1',
            'active' => true
        ]);

        Supplier::factory()->create([
            'name' => "Khánh Hằng",
            'clinic_id' => 'DK1',
            'active' => true
        ]);

        Supplier::factory()->create([
            'name' => "Tây Phương",
            'clinic_id' => 'DK1',
            'active' => true
        ]);

        Supplier::factory()->create([
            'name' => "Vĩnh Phú",
            'clinic_id' => 'DK1',
            'active' => true
        ]);

        Patient::factory()->count(80)->create();


        Appointment::factory()->count(20)->create();


        ServiceGroup::factory()->create([
            'name' => "Khác",
            'clinic_id' => 'DK1',
            'last_update_name' => 'admin',
            'active' => true
        ]);

        ServiceGroup::factory()->create([
            'name' => "Khám",
            'clinic_id' => 'DK1',
            'last_update_name' => 'admin',
            'active' => true
        ]);

        ServiceGroup::factory()->create([
            'name' => "Chụp phim",
            'clinic_id' => 'DK1',
            'note' => 'Chụp rất đẹp',
            'last_update_name' => 'admin',
            'active' => true
        ]);

        ServiceGroup::factory()->create([
            'name' => "Nha Khoa tổng quát",
            'clinic_id' => 'DK1',
            'last_update_name' => 'admin',
            'active' => true
        ]);

        Service::factory()->create([
            'name' => "Albutmen Hàn ( khách ngoài )",
            'clinic_id' => 'DK1',
            'supplier_id' => fake()->randomElement([1, 2, 3, 4]),
            'service_group_id' => fake()->randomElement([1, 2, 3, 4]),
            'caculation_unit' => 'cái',
            'monetary_unit' => "VND",
            'price' => '2000000',
            'warranty_able' => true,
            'warranty' => '10 năm',
            'active' => true
        ]);

        Service::factory()->create([
            'name' => "Bàn chải máy B02 New",
            'clinic_id' => 'DK1',
            'supplier_id' => fake()->randomElement([1, 2, 3, 4]),
            'service_group_id' => fake()->randomElement([1, 2, 3, 4]),
            'caculation_unit' => 'cái',
            'monetary_unit' => "VND",
            'price' => '1050000',
            'warranty_able' => true,
            'warranty' => '10 năm',
            'active' => true
        ]);

        Service::factory()->create([
            'name' => "Bôi Vecni Flour ( NT Clear Varnish ) phòng ngừa sâu răng",
            'clinic_id' => 'DK1',
            'supplier_id' => fake()->randomElement([1, 2, 3, 4]),
            'service_group_id' => fake()->randomElement([1, 2, 3, 4]),
            'caculation_unit' => 'cái',
            'monetary_unit' => "VND",
            'price' => '500000',
            'warranty_able' => true,
            'warranty' => '10 năm',
            'active' => true
        ]);

        Service::factory()->create([
            'name' => "Cao răng cấp độ 3",
            'clinic_id' => 'DK1',
            'supplier_id' => fake()->randomElement([1, 2, 3, 4]),
            'service_group_id' => fake()->randomElement([1, 2, 3, 4]),
            'caculation_unit' => 'cái',
            'monetary_unit' => "VND",
            'price' => '150000',
            'warranty_able' => true,
            'warranty' => '10 năm',
            'active' => true
        ]);

        DiagnosisGroup::create([
            'name' => "Sâu răng",
            'clinic_id' => 'DK1',
            'last_update_name' => 'admin',
            'active' => true
        ]);

        DiagnosisGroup::create([
            'name' => "Tiểu phẫu",
            'clinic_id' => 'DK1',
            'last_update_name' => 'admin',
            'active' => true
        ]);

        DiagnosisGroup::create([
            'name' => "Chỉnh nha",
            'clinic_id' => 'DK1',
            'last_update_name' => 'admin',
            'active' => true
        ]);

        DiagnosisGroup::create([
            'name' => "Cao răng",
            'clinic_id' => 'DK1',
            'last_update_name' => 'admin',
            'active' => true
        ]);

        DiagnosisGroup::create([
            'name' => "Nha chu",
            'clinic_id' => 'DK1',
            'last_update_name' => 'admin',
            'active' => true
        ]);

        Diagnosis::create([
            'name' => "Xoang sâu loại III",
            'diagnosis_group_id' => 1,
            'clinic_id' => 'DK1',
            'last_update_name' => 'admin',
            'active' => true
        ]);

        Diagnosis::create([
            'name' => "Xoang sâu loại I",
            'diagnosis_group_id' => 1,
            'clinic_id' => 'DK1',
            'last_update_name' => 'admin',
            'active' => true
        ]);


        Diagnosis::create([
            'name' => "Xoang sâu loại II",
            'diagnosis_group_id' => 1,
            'clinic_id' => 'DK1',
            'last_update_name' => 'admin',
            'active' => true
        ]);

        Diagnosis::create([
            'name' => "Răng sữa lung lay",
            'diagnosis_group_id' => fake()->randomElement([2, 3, 4, 5]),
            'clinic_id' => 'DK1',
            'last_update_name' => 'admin',
            'active' => true
        ]);

        Diagnosis::create([
            'name' => "Viêm quanh răng + lung lay",
            'diagnosis_group_id' => fake()->randomElement([2, 3, 4, 5]),
            'clinic_id' => 'DK1',
            'last_update_name' => 'admin',
            'active' => true
        ]);

        Diagnosis::create([
            'name' => "Viêm quanh răng + lung lay",
            'diagnosis_group_id' => fake()->randomElement([2, 3, 4, 5]),
            'clinic_id' => 'DK1',
            'last_update_name' => 'admin',
            'active' => true
        ]);

        Diagnosis::create([
            'name' => "Viêm quanh răng + lung lay",
            'diagnosis_group_id' => fake()->randomElement([2, 3, 4, 5]),
            'clinic_id' => 'DK1',
            'last_update_name' => 'admin',
            'active' => true,
            'note' => 'viem quanh rang, lung lay',
        ]);

        Diagnosis::create([
            'name' => "Cao răng viêm lợi độ III",
            'diagnosis_group_id' => fake()->randomElement([2, 3, 4, 5]),
            'clinic_id' => 'DK1',
            'last_update_name' => 'admin',
            'active' => true,
            'note' => 'Cao răng trên và dưới lợi,có túi quanh răng, dễ chảy máu',
        ]);

        Diagnosis::create([
            'name' => "Viêm tủy mạn",
            'diagnosis_group_id' => fake()->randomElement([2, 3, 4, 5]),
            'clinic_id' => 'DK1',
            'last_update_name' => 'admin',
            'active' => true,
            'note' => 'Là tình trạng viêm tủy không hồi phục có lỗ dò',
        ]);

        PatientService::factory()->count(30)->create();

        Prescription::create([
            'name' => "Amo, Para",
            'clinic_id' => 'DK1',
            'last_update_name' => 'admin',
            'detail' => '1. Amoxycillin 0.5g  x  15 viên
                            Ngày uống 3 lần , mỗi lần 1 viên sau khi ăn no.
                            2. Paracetamol x 8 viên
                            Ngày uống 2 viên chia 2 lần',
            'active' => true,
            'note' => '',
        ]);

        Prescription::create([
            'name' => "Aug + Alpha+Effe",
            'clinic_id' => 'DK1',
            'last_update_name' => 'admin',
            'detail' => '1-  Augmentin  625mg x 10 viên
                Ngày uông 2 viên,chia 2 lần
                2. Alphachoay 5mg x 20 viên
                Ngày uống 4 viên chia 02 lần
                3. Efferalgan 500mg x 6 viên
                Uống mỗi lần 1 viên khi đau , mỗi lần uống cách nhau 4-6 tiếng
                ( Cho viên thuốc vào 1/2 cốc nước cho sủi hết rồi uống)
                4. Kin x 1chai
                Pha loãng Xúc miệng ngày 3 lần ',
            'active' => true,
            'note' => '',
        ]);

        Prescription::create([
            'name' => "Bôi viêm lợi Syndent",
            'clinic_id' => 'DK1',
            'last_update_name' => 'admin',
            'detail' => '1.Rodogyl 750000UI x 20 viên
                Ngày uống 4 viên chia 2 lần
                2. Alphachoay 5mg x 20 viên
                Ngày uống 4 viên chia 2 lần
                2.Syndent Plus Dental Gel
                Bôi lên vùng nướu răng ngày 3 lần sau khi vệ sinh răng miệng
                2. Nước xúc miệng Kin x 01 lọ
                Pha loãng xúc miệng ngày 3 lần ( mỗi lần ngậm 1-2 phút )',
            'active' => true,
            'note' => '',
        ]);

        Prescription::create([
            'name' => "Đơn Viêm Nha Chu 1",
            'clinic_id' => 'DK1',
            'last_update_name' => 'admin',
            'detail' => '1. Metronidazole 500mg x 24 viên
                Ngày uống 3 viên chia 3 lần
                2. Gel Kin x 1tuýp
                Bôi ngày 3 lần vùng lợi viêm sau khi vệ sinh răng miệng
                3. Eludril x 2 lọ
                Pha loãng xúc miệng ngày 3 lần',
            'active' => true,
            'note' => '',
        ]);



        Reminder::create([
            'name' => "Đeo khay Invisalign",
            'clinic_id' => 'DK1',
            'last_update_name' => 'admin',
            'detail' => '
                - Đeo khay tối thiểu 22 giờ trong ngày,
                - 2 tuần thay khay 1 lần,
                - Có thể đeo khay khi ăn đồ mềm,
                - Vệ sinh khay sau mỗi bữa ăn.

                *** Không ngâm rửa khay bằng nước sôi.',
            'active' => true,
            'note' => '',
        ]);

        Reminder::create([
            'name' => "Lời dặn hàn theo dõi",
            'clinic_id' => 'DK1',
            'last_update_name' => 'admin',
            'detail' => '
            -  Sau khi hàn 2 tiếng mới ăn
            -  Nếu không đau sau 2-4 tuần đến hàn cố định.
            -  Trường hợp đau nhiều đến khám lại ngay',
            'active' => true,
            'note' => '',
        ]);

        Reminder::create([
            'name' => "Lời dặn sau tẩy trắng răng tại nhà",
            'clinic_id' => 'DK1',
            'last_update_name' => 'admin',
            'detail' => '
                -  Kiêng ăn uống đồ dễ gây nhiễm màu như chè, cà phê, thuốc lá, rượu vang đỏ .. và hạn chế dùng đồ quá cứng, quá nóng, quá lạnh trong và sau thời gian tẩy trắng răng ít nhất 2 tuần.
                -  Trường hợp ê buốt nhiều nên dừng thuốc tẩy trắng, chuyển sang ngậm thuốc chống ê buốt 1 vài ngày sau đó tiếp tục ngậm thuốc tẩy trắng.
                ',
            'active' => true,
            'note' => '',
        ]);

        Reminder::create([
            'name' => "Răng sát tủy, hàn che lót theo dõi cơn đau tủy",
            'clinic_id' => 'DK1',
            'last_update_name' => 'admin',
            'detail' => '1. Răng bị đau từng cơn hoặc đau liên tục, có thể đau âm ỉ hoặc đau nhói, đau buốt
                2. Đau tự phát kéo dài, đặc biệt là khi về đêm
                3. Cơn đau do viêm tủy răng cấp tính có thể khu trú hoặc lan tỏa
                4. Thời gian đau có thể kéo dài trong vài phút nhưng cũng có những trường hợp cơn đau kéo dài đến hàng giờ liền
                5. Cơn đau bùng phát mạnh khi thức ăn lọt vào lỗ sâu, thay đổi tư thế, nhiệt độ quá nóng hoặc quá lạnh
                ',
            'active' => true,
            'note' => '',
        ]);

        WarrantyCard::create([
            'service_name' => "Thủ thuật 1",
            'patient_service_id' => 1,
            'card_id' => "123123",
            'warranty_status' => 'Không phát hành',
            'note' => "ghi chu",
            'clinic_id' => "DK1"
        ]);

        WarrantyCard::create([
            'service_name' => "Thủ thuật 2",
            'patient_service_id' => 2,
            'card_id' => "111111",
            'warranty_status' => 'Chưa có thẻ',
            'note' => "ghi chu",
            'clinic_id' => "DK1"
        ]);

        WarrantyCard::create([
            'service_name' => "Thủ thuật 3",
            'patient_service_id' => 3,

            'card_id' => "22222",
            'warranty_status' => 'Đã trả thẻ',
            'note' => "ghi chu",
            'clinic_id' => "DK1"
        ]);

        WarrantyCard::create([
            'patient_service_id' => 4,
            'service_name' => "Thủ thuật 4",
            'card_id' => "44444",
            'warranty_status' => 'Không phát hành',
            'note' => "ghi chu",
            'clinic_id' => "DK1"
        ]);

        MaterialGroup::create([
            'clinic_id' => 'DK1',
            'name' => 'Thuốc',
            'note' => 'ghi chu'
        ]);

        MaterialGroup::create([
            'clinic_id' => 'DK1',
            'name' => 'Vật tư tiêu hao',
            'note' => 'ghi chu 2'
        ]);

        MaterialGroup::create([
            'clinic_id' => 'DK1',
            'name' => 'Nhóm vật tư z',
            'note' => 'ghi chu'
        ]);

        MaterialGroup::create([
            'clinic_id' => 'DK1',
            'name' => 'Siêu nhóm vật tư',
            'note' => 'ghi chu'
        ]);

        Material::create([
            'clinic_id' => 'DK1',
            'material_group_id' => '1',
            'name' => 'Bẩy Osung',
            'describe' => '',
            'price' => '100000',
            'note' => 'ghi chu'
        ]);

        Material::create([
            'clinic_id' => 'DK1',
            'material_group_id' => '1',
            'name' => 'Bóc tách lợi',
            'describe' => '',
            'price' => '200000',
            'note' => 'ghi chu z'
        ]);

        Material::create([
            'clinic_id' => 'DK1',
            'material_group_id' => '1',
            'name' => 'Bông y tế Bạch Tuyết',
            'describe' => '',
            'price' => '500000',
            'note' => 'Bông y tế '
        ]);

        Material::create([
            'clinic_id' => 'DK1',
            'material_group_id' => '1',
            'name' => 'Bù chênh lệch khi chia đơn giá',
            'describe' => 'Bù chênh lệch',
            'price' => '50000',
            'note' => 'ghi chu'
        ]);

        Material::create([
            'clinic_id' => 'DK1',
            'material_group_id' => '1',
            'name' => 'Bẩy Osung',
            'describe' => '',
            'price' => '100000',
            'note' => 'ghi chu'
        ]);

        Material::create([
            'clinic_id' => 'DK1',
            'material_group_id' => '1',
            'name' => 'Chỉnh nha tháo lắp có ốc nong',
            'describe' => '',
            'price' => '160000',
            'note' => 'ghi chu'
        ]);

        Material::create([
            'clinic_id' => 'DK1',
            'material_group_id' => '2',
            'name' => 'Chun chuỗi mắt mau',
            'describe' => '',
            'price' => '100000',
            'note' => 'ghi chu'
        ]);

        Material::create([
            'clinic_id' => 'DK1',
            'material_group_id' => '2',
            'name' => 'Chun kéo liên hàm',
            'describe' => 'khong',
            'price' => '100000',
            'note' => 'ghi chu'
        ]);

        Material::create([
            'clinic_id' => 'DK1',
            'material_group_id' => '2',
            'name' => 'Bẩy Osung',
            'describe' => '',
            'price' => '100000',
            'note' => 'ghi chu'
        ]);

        Material::create([
            'clinic_id' => 'DK1',
            'material_group_id' => '1',
            'name' => 'Composite A35 lỏng',
            'describe' => '',
            'price' => '400000',
            'note' => ''
        ]);

        Material::create([
            'clinic_id' => 'DK1',
            'material_group_id' => '1',
            'name' => 'Dầu xịt tay khoan',
            'describe' => 'Dầu',
            'price' => '40000',
            'note' => 'ghi chu'
        ]);

        FundingSource::create([
            'clinic_id' => 'DK1',
            'name' => 'Quỹ phòng khám',
            'type_of_transaction' => ['Tiền mặt'],
            'note' => 'ghi chu',
            'active' => true
        ]);

        FundingSource::create([
            'clinic_id' => 'DK1',
            'name' => 'Quỹ phòng khám',
            'type_of_transaction' => ['Tiền mặt'],
            'note' => 'ghi chu',
            'active' => true
        ]);

        FundingSource::create([
            'clinic_id' => 'DK1',
            'name' => 'Quỹ tiền mặt (lễ tân)',
            'type_of_transaction' => ['Tiền mặt'],
            'note' => 'ghi chu',
            'active' => true
        ]);

        FundingSource::create([
            'clinic_id' => 'DK1',
            'name' => 'BIDV',
            'type_of_transaction' => ['Quét thẻ', 'Chuyển khoản'],
            'note' => 'ghi chu',
            'active' => false
        ]);

        FundingSource::create([
            'clinic_id' => 'DK1',
            'name' => '001002003004567',
            'type_of_transaction' => ['Chuyển khoản'],
            'note' => 'ghi chu zxczcxzx',
            'active' => true
        ]);

        FundingSource::create([
            'clinic_id' => 'DK2',
            'name' => 'Quỹ tiền mặt (lễ tân)',
            'type_of_transaction' => ['Tiền mặt'],
            'note' => 'ghi chu dk2',
            'active' => true
        ]);


        Finance::create([
            'clinic_id' => 'DK1',
            'name' => 'Tiền mua đồ',
            'group' => 'Bệnh nhân',
            'payment' => true,
            'active' => true,
        ]);

        Finance::create([
            'clinic_id' => 'DK1',
            'name' => 'Tiền vật liệu',
            'group' => 'Nội bộ',
            'payment' => true,
            'active' => true,
        ]);

        Finance::create([
            'clinic_id' => 'DK1',
            'name' => 'Lương',
            'group' => 'Bệnh nhân',
            'payment' => true,
            'active' => true,
        ]);

        Finance::create([
            'clinic_id' => 'DK1',
            'name' => 'Vật tư',
            'group' => 'Nhà cung cấp',
            'payment' => true,
            'active' => true,
        ]);

        Finance::create([
            'clinic_id' => 'DK1',
            'name' => 'Khác',
            'group' => 'Khác',
            'payment' => true,
            'active' => true,
        ]);

        Finance::create([
            'clinic_id' => 'DK2',
            'name' => 'Nội bộ bệnh nhân Nhà cung cấp Nhân viên',
            'group' => 'Nội bộ',
            'payment' => true,
            'receipt' => true,
            'active' => true,
        ]);

        TransactionVoucher::create([
            'clinic_id' => 'DK1',
            'funding_source_id' => 2,
            'finance_id' => 3,
            'recipient' => 'Khoa Dang',
            'phone' => '0123123123',
            'address' => 'Ha Noi',
            'money' => '10000000',
            'detail' => 'Tiền mua dụng cụ sửa chữa',
            'date' => fake()->dateTimeBetween('-1 weeks', 'now')
        ]);

        TransactionVoucher::create([
            'clinic_id' => 'DK1',
            'funding_source_id' => 3,
            'finance_id' => 3,
            'money' => '50000000',
            'detail' => 'Thiết bị thứ 2',
            'date' => fake()->dateTimeBetween('-1 weeks', 'now')
        ]);

        TransactionVoucher::create([
            'clinic_id' => 'DK1',
            'funding_source_id' => 4,
            'finance_id' => 4,
            'money' => '45021500',
            'detail' => 'Tiền',
            'date' => fake()->dateTimeBetween('-1 weeks', 'now')
        ]);

        TransactionVoucher::create([
            'clinic_id' => 'DK1',
            'funding_source_id' => 1,
            'finance_id' => 3,
            'money' => '10000000',
            'detail' => 'Tiền mặt đây',
            'date' => fake()->dateTimeBetween('-1 weeks', 'now')
        ]);

        TransactionVoucher::create([
            'clinic_id' => 'DK1',
            'funding_source_id' => 2,
            'finance_id' => 3,
            'recipient' => 'Dang khoa dang',
            'money' => '20000000',
            'detail' => 'Chịu',
            'date' => fake()->dateTimeBetween('-1 weeks', 'now')
        ]);


        TransactionVoucher::create([
            'clinic_id' => 'DK1',
            'funding_source_id' => 2,
            'finance_id' => 3,
            'money' => '451320000',
            'detail' => 'Thiết bị',
            'date' => fake()->dateTimeBetween('-1 weeks', 'now')
        ]);

        TransactionVoucher::create([
            'clinic_id' => 'DK1',
            'funding_source_id' => 2,
            'finance_id' => 3,
            'money' => '10000000',
            'detail' => 'Tăm nước',
            'date' => fake()->dateTimeBetween('-1 weeks', 'now')
        ]);
    }
}
