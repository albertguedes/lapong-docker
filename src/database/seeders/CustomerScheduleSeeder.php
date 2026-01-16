<?php declare(strict_types=1);

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Customer;
use App\Models\CustomerSchedule;
use App\Models\Schedule;

class CustomerScheduleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Customer::each(function ($customer) {
            $number_of_schedules = rand(1, 50);
            for($i = 0; $i < $number_of_schedules; $i++) {
                $schedule_id = $this->uniqueCustomerSchedule($customer->id);
                CustomerSchedule::factory()->create([
                    "customer_id" => $customer->id,
                    "schedule_id" => $schedule_id,
                ]);
            }
        });
    }

    /**
     * Gets a random schedule ID that has not yet been associated with the
     * given customer ID.
     *
     * @param int $customer_id
     * @return int
     */
    private function uniqueCustomerSchedule(int $customer_id): int
    {
        $schedule_ids = CustomerSchedule::where('customer_id', $customer_id)->pluck('schedule_id')->toArray();
        do {
            $schedule_id = Schedule::inRandomOrder()->first()->id;
        } while (in_array($schedule_id, $schedule_ids));
        return $schedule_id;
    }
}
