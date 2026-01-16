<?php declare(strict_types=1);

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Customer;
use App\Models\Company;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Document>
 */
class DocumentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $created_at = $this->faker->dateTimeBetween('-1 year', '+1 year');
        $updated_at = $this->faker->dateTimeBetween($created_at, '+1 year');

        $documentableModels = collect([
            Customer::class,
            Company::class,
        ]);
        $documentableClass = $documentableModels->random();
        $documentable = $documentableClass::inRandomOrder()->first();
        $documentable_type = $documentableClass;
        $documentable_id = $documentable->id;

        $type = $this->faker->randomElement(['rg', 'cpf', 'cnpj', 'ie', 'cnh', 'passaporte']);
        $value = $this->faker->randomNumber(9);
        $description = $this->faker->sentence();
        $mask = $this->faker->randomElement(['999.999.999-99', '999.999.999-99', '99.999.999/9999-99']);
        $is_active = $this->faker->boolean();

        return compact(
            'created_at',
            'updated_at',
            'documentable_type',
            'documentable_id',
            'type',
            'value',
            'description',
            'mask',
            'is_active'
        );
    }
}
