<?php declare(strict_types=1);

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Customer;
use App\Models\Event;
use App\Models\EventParticipant;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class EventParticipantFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $created_at = $this->faker->dateTimeBetween('-1 year', '+1 year');
        $event_id = Event::inRandomOrder()->first()->id;
        $participant_id = self::uniqueParticipant($event_id);

        return compact(
            'created_at',
            'participant_id',
            'event_id'
        );
    }

    private static function uniqueParticipant(int $event_id): int
    {
        $existing_participant_ids = EventParticipant::where("event_id", $event_id)
                                                    ->pluck("participant_id")
                                                    ->toArray();

        return Customer::whereNotIn("id", $existing_participant_ids)
                        ->inRandomOrder()
                        ->first()
                        ->id;
    }
}
