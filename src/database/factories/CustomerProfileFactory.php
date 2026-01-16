<?php declare(strict_types=1);

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Customer;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\CustomerProfile>
 */
class CustomerProfileFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $created_at = $this->faker->dateTimeBetween('-1 year', '+1 year');
        $updated_at = $this->faker->dateTimeBetween($created_at, '+1 year');
        $customer_id = Customer::inRandomOrder()->first()->id;
        $first_name = $this->faker->firstName();
        $middle_name = $this->faker->firstName();
        $last_name = $this->faker->lastName();
        $birthdate = $this->faker->date();
        $gender = $this->faker->boolean();

        return compact(
            'created_at',
            'updated_at',
            'customer_id',
            'first_name',
            'middle_name',
            'last_name',
            'birthdate',
            'gender'
        );
    }
}
