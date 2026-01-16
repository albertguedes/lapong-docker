<?php declare(strict_types=1);

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Customer;
use App\Models\Message;

class MessageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Customer::each(function ($customer) {
            Message::factory(self::numberOfMessages())->create([
                "sender_id" => $customer->id,
            ]);
        });
    }

    /**
     * Gets the number of messages to create for each customer.
     *
     * @return int A random number between 1 and 50.
     */
    private static function numberOfMessages(): int
    {
        return rand(1, 50);
    }
}
