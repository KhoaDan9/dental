<?php

namespace Database\Factories;

use App\Models\Employee;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Appointment>
 */
class AppointmentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {

        return [
            'patient_id' => fake()->randomElement([1,2,3,4]),
            'detail' => fake()->text(10),
            'clinic_id' => 'DK1',
            'employee_id' => fake()->randomElement([1,2,3,4]),
            'date' => fake()->dateTimeBetween('now', '+1 weeks', 'Asia/Ho_Chi_Minh'),
        ];
    }
}
