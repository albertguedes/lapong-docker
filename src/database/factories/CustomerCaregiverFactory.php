<?php declare(strict_types=1);

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

use App\Models\Customer;
use App\Models\CustomerCaregiver;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\CustomerCaregiver>
 */
class CustomerCaregiverFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $created_at = $this->faker->dateTimeBetween('-1 year', '+1 year');

        // Get a customer that dont has a caregiver
        do {
            $customer_id = Customer::inRandomOrder()->first()->id;
        } while (CustomerCaregiver::where('customer_id', $customer_id)->exists());

        // Get a caregiver that dont has a customer and aren't a caregiver.
        do {
            $caregiver_id = Customer::inRandomOrder()->first();
        } while (CustomerCaregiver::where('customer_id', $caregiver_id)->exists() ||
                CustomerCaregiver::where('caregiver_id', $caregiver_id)->exists() ||
        $caregiver_id === $customer_id);

        return compact(
            'created_at',
            'customer_id',
            'caregiver_id'
        );
    }
}
