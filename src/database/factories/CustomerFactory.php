<?php declare(strict_types=1);

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Customer>
 */
class CustomerFactory extends Factory
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
        $email = $this->faker->unique()->safeEmail();
        $password = bcrypt($email);
        $remember_token = Str::random(10);
        $is_active = $this->faker->boolean();

        $email_verified_at = null;
        if ($is_active) {
            $email_verified_at = now();
        }

        return compact(
            'created_at',
            'updated_at',
            'email',
            'password',
            'email_verified_at',
            'remember_token',
            'is_active'
        );
    }
}
