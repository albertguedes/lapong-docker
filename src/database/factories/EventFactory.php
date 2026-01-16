<?php declare(strict_types=1);

namespace Database\Factories;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Customer;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Event>
 */
class EventFactory extends Factory
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
        $event_creator_id = Customer::inRandomOrder()->first()->id;
        $title = $this->faker->words(3, true);
        $description = $this->faker->paragraphs(3, true);

        $baseDate = Carbon::createFromTimestamp(rand(now()->subDays(15)->timestamp, now()->addDays(15)->timestamp))->startOfDay();
        $begin = $baseDate->copy()->addMinutes(rand(0, 47) * 30);
        $end = $begin->copy()->addMinutes(rand(1, 8) * 15);

        $is_active = $this->faker->boolean();

        return compact(
            'created_at',
            'updated_at',
            'event_creator_id',
            'title',
            'description',
            'begin',
            'end',
            'is_active'
        );
    }
}
