<?php declare(strict_types=1);

namespace App\View\Components\Medical\Cases\Records;

use Carbon\Carbon;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use App\Models\MedicalCaseRecord;

class RecordCardComponent extends Component
{
    public array $record = [];

    public array $type_colors = [
        'conclusão' => 'info',
        'consulta' => 'primary',
        'diagnóstico' => 'warning',
        'exame' => 'success',
        'medicação' => 'danger',
        'outro' => 'danger',
        'procedimento' => 'danger',
        'prognóstico' => 'info',
        'retorno' => 'danger',
        'tratamento' => 'danger',
    ];

    /**
     * Create a new component instance.
     */
    public function __construct(MedicalCaseRecord $record)
    {
        $medicalCase = $record->case;

        $participants = [];
        if($record->participants->count() > 0) {
            foreach ($record->participants()->Active()->get() as $participant) {
                $participants[] = [
                    'id' => $participant->id,
                    'name' => $participant->profile->name()
                ];
            }
        }

        $this->record = [
            'id' => $record->id,
            'case_id' => $medicalCase->id,
            'title' => $record->title,
            'description' => $record->description,
            'medical_case_id' => $record->medical_case_id,
            'type' => $record->type->title,
            'type_id' => $record->type_id,
            'type_color' => $this->type_colors[$record->type->title],
            'created_at' => Carbon::parse($record->created_at)->format('d/m/Y'),
            'updated_at' => Carbon::parse($record->updated_at)->format('d/m/Y'),
            'responsible' => [
                'id' => $medicalCase->responsible->id,
                'name' => $medicalCase->responsible->profile->name(),
            ],
            'participants' => $participants
        ];
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components..medical.cases.records.record-card-component');
    }
}
