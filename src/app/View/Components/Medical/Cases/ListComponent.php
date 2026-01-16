<?php declare(strict_types=1);

namespace App\View\Components\Medical\Cases;

use App\Models\MedicalCase;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\View\Component;
use Carbon\Carbon;
use Faker\Provider\Medical;

class ListComponent extends Component
{
    public array $cases;

    private $status_color = [
        'active' => 'success',
        'closed' => 'danger',
        'expired' => 'danger',
        'finished' => 'success',
        'open' => 'warning',
        'paused' => 'info',
    ];

    /**
     * Create a new component instance.
     */
    public function __construct(Collection $cases, MedicalCase $current)
    {
        foreach ($cases as $case) {

            $responsible = [
                'id' => $case->responsible->id,
                'name' => $case->responsible->profile->name()
            ];

            $this->cases[] = [
                'id' => $case->id,
                'title' => $case->title,
                'description' => $case->description,
                'status' => $case->status->title,
                'status_color' => $this->status_color[$case->status->title],
                'created_at' => Carbon::parse($case->created_at)->format('d/m/Y'),
                'updated_at' => Carbon::parse($case->updated_at)->format('d/m/Y'),
                'finished_at' => Carbon::parse($case->finished_at)->format('d/m/Y'),
                'responsible' => $responsible,
                'current' => $case->id == $current->id
            ];
        }
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.medical.cases.list-component');
    }
}
