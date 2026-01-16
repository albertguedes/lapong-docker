<?php declare(strict_types=1);

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use App\Models\Customer;
use App\Models\MedicalCase;

class MedicalCaseSeeder extends Seeder
{
    private const ROLE_PROFESSIONAL = "profissional";

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Customer::each(function ($customer)
        {
            for($i=0; $i < self::numberOfCases(); $i++) {

                $responsible_id = self::getResponsibleId($customer);

                if($responsible_id == 0) {
                    break;
                }

                MedicalCase::factory()->create([
                    "responsible_id" => $responsible_id,
                    "patient_id" => $customer->id
                ]);
            }
        });
    }

    /**
     * Gets the number of cases to create for each customer.
     *
     * @return int A random number between 1 and 10.
     */
    private static function numberOfCases(): int
    {
        return rand(5, 10);
    }

    /**
     * Returns the id of a random contact of the given customer who has a "professional" role.
     *
     * @param Customer $customer
     * @return int
     */
    private static function getResponsibleId(Customer $customer): int
    {
        $contactsWithProfessionalRole = $customer->contacts->filter(function ($contact) {
            return $contact->roles->contains(function ($role) {
                return $role->title === self::ROLE_PROFESSIONAL;
            });
        });

        if ($contactsWithProfessionalRole->isEmpty()) {
            return 0;
        }

        return $contactsWithProfessionalRole->random()->id;
    }
}
