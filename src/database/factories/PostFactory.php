<?php declare(strict_types=1);

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Customer;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
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
        $customer_id = Customer::inRandomOrder()->first()->id;
        $title = $this->faker->sentence();
        $content = $this->faker->text(1000);
        $is_published = $this->faker->boolean();
        $is_active = $this->faker->boolean();

        return compact(
            'created_at',
            'updated_at',
            'customer_id',
            'title',
            'content',
            'is_published',
            'is_active'
        );
    }
}
