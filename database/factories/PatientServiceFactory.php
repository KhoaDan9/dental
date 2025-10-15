<?php

namespace Database\Factories;

use App\Models\Employee;
use App\Models\Service;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Log;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\PatientService>
 */
class PatientServiceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $services = Service::select('name', 'price')->get()->toArray();
        $service = $this->faker->randomElement($services);
        
        $employees = Employee::select('name')->get()->toArray();
        $employee = $this->faker->randomElement($employees);

        $quantity = $this->faker->randomElement([1,2,3]);
        return [
            'employee_name'=>$employee['name'],
            'supporter_name'=>fake()->randomElement(["sp1", "sp2", "sp3", '']), 
            'patient_id'=>fake()->randomElement([1,2,3,4]),
            'service_name'=>$service['name'],
            'teeth'=>fake()->randomElement([1,2,3,4,5,6,7,8]),
            'price'=>$service['price'],
            'quantity'=> $quantity,
            'total_price'=>$service['price'] * $quantity,
            'date'=>fake()->dateTimeBetween('-1 weeks', 'now'),
        ];
    }
}
