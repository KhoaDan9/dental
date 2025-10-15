<?php

namespace Database\Factories;

use Faker\Provider\vi_VN\PhoneNumber;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Patient>
 */
class PatientFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name'=>fake()->name(),
            'clinic_id'=>'DK1',
            'birth'=>fake()->dateTimeBetween('-35 years', '-15 years')->format('Y-m-d'),
            'phone'=>fake()->PhoneNumber(),
            'from'=>fake()->randomElement(['Facebook', 'Google', 'Khác']),
            'medical_examination'=>fake()->randomElement(['Đăng ký khám lần đầu', 'Khám răng', 'Khams tong quat']),
            'address'=>'Vinh Loc',
            'commune'=>'Tay Phuong',
            'city'=>'Ha Noi',
            'gender'=>fake()->randomElement(['Nam','Nữ']),
            'patient_status'=>fake()->randomElement(['Đang hẹn', 'Đang chờ', 'Đang làm', 'Đã TT hết']),
            'created_at' => fake()->dateTimeBetween('-1 week', 'now', 'Asia/Ho_Chi_Minh')
        ];
    }
}
