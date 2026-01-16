<?php declare(strict_types=1);

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Customer;
use App\Models\MedicalCaseStatus;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class MedicalCaseFactory extends Factory
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
        $finished_at = $this->faker->boolean() ? $updated_at : null;

        $medical_case_status_id = MedicalCaseStatus::inRandomOrder()->first()->id;

        $responsible_id = self::getResponsibleId();
        $patient_id = self::uniquePatient($responsible_id);

        $title = $this->faker->sentence();
        $description = $this->faker->sentence();
        $is_active = $this->faker->boolean();

        return compact(
            'created_at',
            'updated_at',
            'finished_at',
            'medical_case_status_id',
            'responsible_id',
            'patient_id',
            'title',
            'description',
            'is_active'
        );
    }

    /**
     * Return the id of a random customer with the role of a professional
     * , to became the responsible of the case.
     * @return int
     */
    private function getResponsibleId(): int
    {
        return Customer::whereHas('roles', function($query) {
            $query->where('title', 'profissional');
        })->inRandomOrder()->first()->id;
    }

    /**
     * Returns the id of a random customer, excluding the given responsible id.
     *
     * @param int $responsible_id
     * @return int
     */
    private function uniquePatient($responsible_id): int
    {
        $patient_id = Customer::where('id', '!=', $responsible_id)->inRandomOrder()->first()->id;
        return $patient_id;
    }
}
