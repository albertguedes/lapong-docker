<?php declare(strict_types=1);

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Customer;

class CustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Customer::factory()->create([
            "email" => "admin@fakemail.com",
            "password" => bcrypt('admin@fakemail.com'),
            "is_active" => true
        ]);

        Customer::factory()->count(self::numberOfCustomers())->create();
    }

    /**
     * Gets a random number between 1 and 5.
     * @return int
     */
    private static function numberOfCustomers(): int
    {
        return rand(10, 99);
    }
}
