<?php declare(strict_types=1);

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use App\Models\MedicalCase;
use App\Models\MedicalCaseRecord;
use App\Models\MedicalCaseRecordType;

class MedicalCaseRecordSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        MedicalCase::each(function ($case) {

            $created_at = $case->created_at;
            $updated_at = $case->updated_at;

            for($i = 0; $i < self::numberOfRecords(); $i++){

                // The first record must not be "conclusão"
                do {
                    $type = MedicalCaseRecordType::all()->random();
                } while ($i == 0 && ($type->title == "conclusão"));

                if($type->title != "conclusão"){
                    MedicalCaseRecord::factory()
                                    ->create([
                                        'created_at' => $created_at,
                                        'updated_at' => $updated_at,
                                        'medical_case_id' => $case->id,
                                        'medical_case_record_type_id' => $type->id,
                                        'is_active' => true
                                    ]);

                    $created_at = Carbon::parse($updated_at)->addDays(rand(0, 7));
                    $updated_at = Carbon::parse($created_at)->addMinutes(rand(0, 120));
                }

                // If the last register has updated_at greater than the case finished_at, break to
                // avoid creating more records
                if (isset($case->finished_at) && Carbon::parse($case->finished_at)->lte($updated_at)) {
                    break;
                }
            }
        });
    }

    /**
     * Get the number of records to create for each medical case.
     *
     * @return int A random number between 2 and 25.
     */
    private function numberOfRecords(): int
    {
        return rand(2, 25);
    }
}
