<?php declare(strict_types=1);

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Customer;
use App\Models\ContactCustomer;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Contact>
 */
class ContactCustomerFactory extends Factory
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
        $contact_id = $this->uniqueContact($customer_id);

        return compact(
            'created_at',
            'customer_id',
            'contact_id'
        );
    }

    /**
     * Gets a random contact ID that is not the customer ID and doesn't already exist in the Contact table for the given customer ID.
     *
     * @param int $customer_id The ID of the customer.
     * @return int A random contact ID that is not the customer ID and doesn't already exist in the Contact table.
     */
    private function uniqueContact(int $customer_id): int
    {
        $existing_contact_ids = ContactCustomer::where("customer_id", $customer_id)
            ->pluck("contact_id")
            ->toArray();

        do {
            $contact_id = Customer::inRandomOrder()->first()->id;
        } while (in_array([$customer_id, $contact_id], ContactCustomer::pluck('customer_id', 'contact_id')->toArray()) || $contact_id === $customer_id || in_array($contact_id, $existing_contact_ids));

        return $contact_id;
    }
}