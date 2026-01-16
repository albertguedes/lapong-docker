<?php declare(strict_types=1);

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Company;
use App\Models\Customer;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\CompanyEmployer>
 */
class CompanyEmployerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $created_at = $this->faker->dateTimeBetween('-1 year', '+1 year');
        $company_id = Company::inRandomOrder()->first()->id;
        $employer_id = Customer::inRandomOrder()
                                ->whereNotIn('id', function($query) use ($company_id) {
                                    $query->select('company_id')
                                        ->from('company_employers')
                                        ->where('company_id', $company_id);
                                })
                                ->first()->id;

        return compact(
            'created_at',
            'company_id',
            'employer_id'
        );
    }
}
