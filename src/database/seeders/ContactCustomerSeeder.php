<?php declare(strict_types=1);

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Customer;
use App\Models\ContactCustomer;

class ContactCustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Customer::each(function ($customer)
        {
            for ($i = 0; $i < self::numberOfContacts(); $i++) {

                $contact_id = self::uniqueContact($customer->id);

                ContactCustomer::factory()->create([
                    'customer_id' => $customer->id,
                    'contact_id' => $contact_id,
                ]);

                // Customer is the contact of the Contact too.
                // Verify if customer is contact of contact, else, create.
                if (!ContactCustomer::where('customer_id', $contact_id)->where('contact_id', $customer->id)->exists()) {
                    ContactCustomer::factory()->create([
                        'customer_id' => $contact_id,
                        'contact_id' => $customer->id,
                    ]);
                }
            }
        });
    }

    /**
     * Gets the number of contacts to create for each customer.
     *
     * @return int A random number between 1 and 10.
     */
    private static function numberOfContacts(): int
    {
        return rand(1, 10);
    }

    /**
     * Get a contact id that is not a contact of Customer yet.
     *
     * @param [type] $customer_id
     * @return integer
     */
    private function uniqueContact(int $customer_id): int
    {
        do {
            $contact_id = Customer::inRandomOrder()->first()->id;
        } while (ContactCustomer::where('customer_id', $customer_id)->where('contact_id', $contact_id)->exists());

        return $contact_id;
    }
}
