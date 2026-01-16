<?php declare(strict_types=1);

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Customer;
use App\Models\CustomerProfile;

class CustomerProfileSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Customer::each(function ($customer) {
            CustomerProfile::factory()->create([
                "customer_id" => $customer->id,
            ]);
        });
    }
}
