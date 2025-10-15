<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Clinic>
 */
class ClinicFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'id' => 'DK1',
            'name' => 'Nha khoa Dang Khoa',
            // 'short_name' => 'Nha khoa Dang Khoa',
            'address' => 'Phung Xa, Thach That',
            'phone' => '0348372344',
            'bank_account_number' => '123123123123123 BIDV',
            'active' => true
        ];
    }
}
