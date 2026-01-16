<?php declare(strict_types=1);

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            RoleSeeder::class,

            CustomerSeeder::class,
            CustomerProfileSeeder::class,
            CustomerRoleSeeder::class,

            CompanySeeder::class,
            CompanyEmployerSeeder::class,
            CompanyServiceTypeSeeder::class,
            CompanyServiceSeeder::class,

            AddressSeeder::class,
            DocumentSeeder::class,
            EmailSeeder::class,
            TelephoneSeeder::class,

            ContactCustomerSeeder::class,
            EventSeeder::class,
            EventParticipantSeeder::class,

            NotificationTypeSeeder::class,
            NotificationSeeder::class,

            MessageSeeder::class,

            MedicalCaseStatusSeeder::class,
            MedicalCaseSeeder::class,
            MedicalCaseRecordTypeSeeder::class,
            MedicalCaseRecordSeeder::class,
            MedicalCaseRecordParticipantSeeder::class,

            PostSeeder::class,

            RequestTypeSeeder::class,
            RequestSeeder::class
        ]);
    }
}
