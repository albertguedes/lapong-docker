<?php declare(strict_types=1);

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Customer;
use App\Models\MedicalCaseRecord;
use App\Models\MedicalCaseRecordParticipant;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\MedicalRecordParticipant>
 */
class MedicalCaseRecordParticipantFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $created_at = $this->faker->dateTimeBetween('-1 year', '+1 year');
        $medical_case_record_id = MedicalCaseRecord::inRandomOrder()->first()->id;
        $participant_id = self::getUniqueParticipant($medical_case_record_id);

        return compact(
            'created_at',
            'participant_id',
            'medical_case_record_id'
        );
    }

    /**
     * Retrieve a unique participant ID for a given medical case record.
     *
     * This method finds a participant who has the role of a professional
     * and is not already associated with the specified medical case record.
     * If no such participant is found, it returns 0.
     *
     * @param int $medical_case_record_id ID of the medical case record.
     * @return int ID of a unique participant or 0 if none is available.
     */
    private static function getUniqueParticipant($medical_case_record_id): int
    {
        $participants = MedicalCaseRecordParticipant::where("medical_case_record_id", $medical_case_record_id)
                                                ->pluck("participant_id")
                                                ->toArray();

        $participant = Customer::whereHas('roles', function($query) {
            $query->where('title', 'profissional');
        })->whereNotIn('id', $participants)
            ->inRandomOrder()
            ->first();

        if($participant == null){
            return 0;
        }

        return $participant->id;
    }
}
