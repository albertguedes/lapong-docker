<?php declare(strict_types=1);

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Company;
use App\Models\CompanyService;

class CompanyServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Company::each(function ($company) {
            CompanyService::factory(self::numberOfServices())->create([
                "company_id" => $company->id
            ]);
        });
    }

    private function numberOfServices(): int
    {
        return rand(1, 10);
    }
}
