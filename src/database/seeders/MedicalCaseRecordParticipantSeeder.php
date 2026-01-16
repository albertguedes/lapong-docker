<?php declare(strict_types=1);

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Customer;
use App\Models\MedicalCaseRecord;
use App\Models\MedicalCaseRecordParticipant;

class MedicalCaseRecordParticipantSeeder extends Seeder
{
    private const ROLE_PROFESSIONAL = 'profissional';

    public function run(): void
    {
        MedicalCaseRecord::with('case.responsible.contacts', 'participants') // Eager load
        ->chunk(100, function ($records) {
            foreach ($records as $medicalCaseRecord) {
                for ($i = 0; $i < self::numberOfParticipants(); $i++) {
                    $participant_id = self::findDisponibleParticipant($medicalCaseRecord);

                    if (!$participant_id) {
                        break; // melhor que return (só encerra o for)
                    }

                    MedicalCaseRecordParticipant::firstOrCreate([
                        'medical_case_record_id' => $medicalCaseRecord->id,
                        'participant_id' => $participant_id,
                    ]);
                }
            }
        });
    }

    /**
     * Gets the number of participants to create for each medical case record.
     *
     * @return int A random number between 1 and 5.
     */
    private static function numberOfParticipants(): int
    {
        return rand(1, 5);
    }

    /**
     * Get a participant that is unique to the medical case record, has role
     * type = professional, and is a contact of responsible of the case.
     *
     * @param MedicalCaseRecord $medicalCaseRecord
     * @return int
     */
    private static function findDisponibleParticipant(MedicalCaseRecord $medicalCaseRecord): int
    {
        // IDs dos contatos do responsável
        $contact_ids = $medicalCaseRecord->case->responsible->contacts->pluck('id');

        // Apenas os contatos que são profissionais
        $professional_ids = Customer::whereIn('id', $contact_ids)
            ->whereHas('roles', function ($query) {
                $query->where('title', self::ROLE_PROFESSIONAL);
            })
            ->pluck('id');

        // IDs dos participantes já vinculados ao prontuário
        $existing_participant_ids = $medicalCaseRecord->participants->pluck('id');

        // Diferença entre profissionais e participantes
        $available_ids = $professional_ids->diff($existing_participant_ids);

        // Retorna o primeiro disponível ou 0 se não houver
        return $available_ids->first() ?? 0;
    }

}
