<?php declare(strict_types=1);

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Customer;
use App\Models\Company;


/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Address>
 */
class AddressFactory extends Factory
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
        $addressableModels = collect([
            Customer::class,
            Company::class,
        ]);
        $addressableClass = $addressableModels->random();
        $addressable = $addressableClass::inRandomOrder()->first();

        $addressable_type = $addressableClass;
        $addressable_id = $addressable->id;
        $label = $this->faker->randomElement(['personal', 'work']);
        $postal_code = $this->faker->postcode();
        $address_line_1 = $this->faker->streetAddress();
        $address_line_2 = $this->faker->secondaryAddress();
        $city = $this->faker->city();
        $region = $this->faker->state();
        $state_or_province = $this->faker->state();
        $country = $this->faker->country();
        $is_active = $this->faker->boolean();

        return compact(
            'created_at',
            'updated_at',
            'addressable_type',
            'addressable_id',
            'label',
            'postal_code',
            'address_line_1',
            'address_line_2',
            'city',
            'region',
            'state_or_province',
            'country',
            'is_active'
        );
    }
}
