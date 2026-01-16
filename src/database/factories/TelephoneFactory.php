<?php declare(strict_types=1);

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Telephone;
use App\Models\Customer;
use App\Models\Company;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class TelephoneFactory extends Factory
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
        $telephonedModels = collect([
            Customer::class,
            Company::class,
        ]);
        $telephonedClass = $telephonedModels->random();
        $telephoned = $telephonedClass::inRandomOrder()->first();

        $telephoned_type = $telephonedClass;
        $telephoned_id = $telephoned->id;

        $label = $this->faker->randomElement(['personal', 'work']);

        $telephoned_array = $this->uniquePhone();
        $ddi = $telephoned_array['ddi'];
        $ddd = $telephoned_array['ddd'];
        $number = $telephoned_array['number'];

        $is_active = $this->faker->boolean();

        return compact(
            'created_at',
            'updated_at',
            'telephoned_type',
            'telephoned_id',
            'label',
            'ddi',
            'ddd',
            'number',
            'is_active'
        );
    }

    /**
     * Generate a unique phone number.
     *
     * This method generates a random phone number (DDI, DDD and number) and
     * checks if it already exists in the telephones table. If it does, it
     * generates a new one and repeats the check until a unique one is found.
     *
     * @return array<string, string> An array containing the DDI, DDD and
     * number of the unique phone number.
     */
    private function uniquePhone(): array
    {
        do {
            $ddi = str_pad((string) $this->faker->numberBetween(1, 99), 2, '0', STR_PAD_LEFT);
            $ddd = str_pad((string) $this->faker->numberBetween(11, 99), 2, '0', STR_PAD_LEFT);
            $number = str_pad((string) $this->faker->numberBetween(10000000, 99999999), 8, '0', STR_PAD_LEFT);
        } while (
            Telephone::where('ddi', $ddi)
                     ->where('ddd', $ddd)
                     ->where('number', $number)
                     ->exists()
        );

        return compact('ddi', 'ddd', 'number');
    }
}
