<?php declare(strict_types=1);

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Customer;
use App\Models\Message;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Message>
 */
class MessageFactory extends Factory
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
        $parent_id = $this->getExistingMessage();
        $sender_id = Customer::inRandomOrder()->first()->id;
        $receiver_id = Customer::inRandomOrder()->first()->id;
        $subject = $this->faker->sentence();
        $message = $this->faker->sentence();
        $is_read = $this->faker->boolean();
        $is_deleted = $this->faker->boolean();
        $is_active = $this->faker->boolean();

        return compact(
            'created_at',
            'updated_at',
            'parent_id',
            'sender_id',
            'receiver_id',
            'subject',
            'message',
            'is_read',
            'is_deleted'
            , 'is_active'
        );
    }

    private function getExistingMessage()
    {
        return Message::select('id')->first()->id ?? null;
    }
}
