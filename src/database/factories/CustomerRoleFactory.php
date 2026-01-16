<?php declare(strict_types=1);

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Customer;
use App\Models\CustomerRole;
use App\Models\Role;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class CustomerRoleFactory extends Factory
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
        $role_id = $this->uniqueCustomerRole($customer_id);

        return compact(
            'created_at',
            'customer_id',
            'role_id'
        );
    }

    private function uniqueCustomerRole(int $customer_id): int
    {
        $role_ids = CustomerRole::where('customer_id', $customer_id)->pluck('role_id')->toArray();
        do {
            $role_id = Role::inRandomOrder()->first()->id;
        } while (in_array($role_id, $role_ids));
        return $role_id;
    }
}
