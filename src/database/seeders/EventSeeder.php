<?php declare(strict_types=1);

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use App\Models\Event;
use App\Models\Customer;

class EventSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Customer::each(function ($customer)
        {
            $begin = Carbon::createFromTimestamp(rand(now()->subDays(15)->timestamp, now()->addDays(15)->timestamp))->startOfDay();
            $end = $begin->copy()->addMinutes(rand(1, 8) * 15);

            for($i=0; $i < self::numberOfEvents(); $i++) {
                Event::factory()->create([
                    "event_creator_id" => $customer->id,
                    "begin" => $begin,
                    "end" => $end,
                ]);

                $begin = $end->copy()->addDays(rand(0, 2))->addMinutes(rand(0, 47) * 30);
                $end = $begin->copy()->addMinutes(rand(1, 8) * 15);
            }
        });
    }

    private static function numberOfEvents(): int
    {
        return rand(3, 15);
    }
}

