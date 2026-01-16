<?php declare(strict_types=1);

namespace App\View\Components\Medical\Cases\Records;

use Carbon\Carbon;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use App\Models\MedicalCase;

class ListComponent extends Component
{
    public array $records = [];

    public array $current = [];

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

    private array $statuses = [
        'paused',
        'closed',
        'finished'
    ];

    /**
     * Create a new component instance.
     */
    public function __construct(MedicalCase $current)
    {
        $records = $current->records()
                           ->Active()
                           ->orderBy('created_at', 'desc')
                           ->get();

        foreach ($records as $record) {
            $this->records[] = [
                'id' => $record->id,
                'title' => $record->title,
                'description' => $record->description,
                'created_at' => Carbon::parse($record->created_at)->format('d/m/Y'),
                'updated_at' => Carbon::parse($record->updated_at)->format('d/m/Y'),
                'type' => $record->type->title,
                'type_color' => $this->type_colors[$record->type->title],
            ];
        }

        $this->current = [
            'id' => $current->id,
            'title' => $current->title,
            'description' => $current->description,
            'created_at' => Carbon::parse($current->created_at)->format('d/m/Y'),
            'updated_at' => Carbon::parse($current->updated_at)->format('d/m/Y'),
            'status' => $current->status->title,
            'responsible' => [
                'id' => $current->responsible->id,
                'name' => $current->responsible->profile->name()
            ],
            'disabled' => in_array($current->status->title,$this->statuses),
        ];
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.medical.cases.records.list-component');
    }
}
