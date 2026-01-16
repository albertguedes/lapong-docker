<?php declare(strict_types=1);

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use App\Models\Company;
use App\Models\CompanyEmployer;
use App\Models\Customer;

class CompanyEmployerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Company::each(function ($company) {
            for ($i = 0; $i < self::numberOfEmployers(); $i++){
                CompanyEmployer::factory()->create([
                    "company_id" => $company->id,
                    "employer_id" => self::uniqueEmployer($company->id)
                ]);
            }
        });
    }

    /**
     * The number of employers each company should have.
     *
     * @return int
     */
    private static function numberOfEmployers(): int
    {
        return rand(1, 10);
    }

    /**
     * Gets a random employer ID that has not yet been associated with the
     * given company ID, excluding the company's customer ID (company owner).
     *
     * @param int $company_id
     * @return int
     */
    private static function uniqueEmployer(int $company_id): int
    {
        $employers = Customer::whereNotIn('id', function($query) use ($company_id) {
            $query->select('employer_id')
                ->from('company_employers')
                ->where('company_id', $company_id);
        })
        ->where('id', '!=', Company::find($company_id)->customer->id)
        ->get();

        return $employers->random()->id;
    }
}
