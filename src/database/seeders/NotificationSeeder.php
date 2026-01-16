<?php declare(strict_types=1);

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Customer;
use App\Models\Notification;

class NotificationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Customer::each(function ($customer) {
            Notification::factory(self::numberOfNotifications())
                        ->create([ "customer_id" => $customer->id ]);
        });
    }

    /**
     * Gets the number of notifications to create for each customer.
     *
     * @return int A random number between 1 and 50.
     */
    private static function numberOfNotifications(): int
    {
        return rand(1, 50);
    }
}
