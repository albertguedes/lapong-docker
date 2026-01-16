<?php declare(strict_types=1);

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Company;
use App\Models\CompanyServiceType;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\CompanyService>
 */
class CompanyServiceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $company_id = Company::inRandomOrder()->first()->id;
        $company_service_type_id = CompanyServiceType::inRandomOrder()->first()->id;
        $title = $this->faker->sentence();
        $description = $this->faker->paragraph(10);
        $is_active = $this->faker->boolean();

        return compact(
            'company_id',
            'company_service_type_id',
            'title',
            'description',
            'is_active'
        );
    }
}
