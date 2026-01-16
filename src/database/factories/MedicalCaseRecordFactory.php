<?php declare(strict_types=1);

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\MedicalCase;
use App\Models\MedicalCaseRecordType;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\MedicalRecord>
 */
class MedicalCaseRecordFactory extends Factory
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
        $medical_case_id = MedicalCase::inRandomOrder()->first()->id;
        $medical_case_record_type_id = MedicalCaseRecordType::inRandomOrder()->first()->id;
        $title = $this->faker->sentence();
        $description = $this->faker->paragraph(10);
        $is_active = $this->faker->boolean();

        return compact(
            'created_at',
            'updated_at',
            'medical_case_id',
            'medical_case_record_type_id',
            'title',
            'description',
            'is_active'
        );
    }
}
