<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Customer;
use App\Models\Schedule;
use App\Models\CustomerSchedule;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class CustomerScheduleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $created_at = $this->faker->dateTimeBetween('-1 year', '+1 year');
        $customer_id = Customer::inRandomOrder()->first()->id;
        $schedule_id = $this->uniqueCustomerSchedule($customer_id);

        return compact(
            'created_at',
            'customer_id',
            'schedule_id'
        );
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
