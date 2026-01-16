<?php declare(strict_types=1);

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Customer;
use App\Models\NotificationType;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class NotificationFactory extends Factory
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
        $notification_type_id = NotificationType::inRandomOrder()->first()->id;
        $customer_id = Customer::inRandomOrder()->first()->id;
        $content = $this->faker->sentence();
        $is_read = $this->faker->boolean();
        $is_active = $this->faker->boolean();

        return compact(
            'created_at',
            'updated_at',
            'notification_type_id',
            'customer_id',
            'content',
            'is_read',
            'is_active'
        );
    }
}
