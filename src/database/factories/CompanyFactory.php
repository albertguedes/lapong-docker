<?php declare(strict_types=1);

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Customer;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Company>
 */
class CompanyFactory extends Factory
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
        $legal_name = $this->faker->unique()->company();
        $trade_name = $this->faker->unique()->company();

        return compact(
            'created_at',
            'updated_at',
            'customer_id',
            'legal_name',
            'trade_name'
        );
    }
}
