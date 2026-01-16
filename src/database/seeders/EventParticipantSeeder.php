<?php declare(strict_types=1);

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Customer;
use App\Models\Event;
use App\Models\EventParticipant;

class EventParticipantSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Event::each(function ($event) {
            $used = EventParticipant::where('event_id', $event->id)->pluck('participant_id')->toArray();
            $available = Customer::whereNotIn('id', $used)->inRandomOrder()->pluck('id')->toArray();

            foreach (array_slice($available, 0, self::numberOfParticipants()) as $participant_id) {
                EventParticipant::factory()->create([
                    'event_id' => $event->id,
                    'participant_id' => $participant_id,
                ]);
            }
        });
    }

    private static function numberOfParticipants(): int
    {
        return rand(1, 10);
    }
}
