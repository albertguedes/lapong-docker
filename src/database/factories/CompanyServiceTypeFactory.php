<?php declare(strict_types=1);

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\CompanyServiceType>
 */
class CompanyServiceTypeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $title = $this->faker->unique()->sentence();
        $description = $this->faker->paragraph();
        $is_active = $this->faker->boolean();

        return compact(
            'title',
            'description',
            'is_active'
        );
    }
}
