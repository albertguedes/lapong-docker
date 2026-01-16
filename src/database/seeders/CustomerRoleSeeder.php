<?php declare(strict_types=1);

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Customer;
use App\Models\CustomerRole;
use App\Models\Role;

class CustomerRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        Customer::each(function ($customer) {
            for($i = 0; $i < self::numberOfRoles(); $i++) {
                CustomerRole::factory()->create([
                    "customer_id" => $customer->id,
                    "role_id" => self::uniqueCustomerRole($customer->id)
                ]);
            }
        });
    }

    /**
     * The number of roles each customer should have.
     *
     * @return int
     */
    private static function numberOfRoles(){
        return rand(1, 2);
    }

    /**
     * Gets a random role ID that has not yet been associated with the
     * given customer ID.
     *
     * @param int $customer_id
     * @return int
     */
    private static function uniqueCustomerRole(int $customer_id): int
    {
        $role_ids = CustomerRole::where('customer_id', $customer_id)->pluck('role_id')->toArray();
        do {
            $role_id = Role::inRandomOrder()->first()->id;
        } while (in_array($role_id, $role_ids));

        return $role_id;
    }
}
