<?php declare(strict_types=1);

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Email;
use App\Models\Customer;
use App\Models\Company;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class EmailFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $created_at = $this->faker->dateTimeBetween('-1 year', '+1 year');
        $updated_at = $this->faker->dateTimeBetween($created_at, '+1 year');
        $emailableModels = collect([
            Customer::class,
            Company::class,
        ]);
        $emailableClass = $emailableModels->random();
        $emailable = $emailableClass::inRandomOrder()->first();

        $emailable_type = $emailableClass;
        $emailable_id = $emailable->id;

        $label = $this->faker->randomElement(['personal', 'work']);

        // Certificate the uniqueness of the email address.
        do {
            $user = $this->faker->userName();
            $domain = $this->faker->domainName();
        } while (Email::where('user', $user)->where('domain', $domain)->exists());

        $is_active = $this->faker->boolean();

        return compact(
            'created_at',
            'updated_at',
            'emailable_type',
            'emailable_id',
            'label',
            'user',
            'domain',
            'is_active'
        );
    }

}
