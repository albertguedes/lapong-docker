<?php

namespace App\View\Components\Medical\Cases\Records;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use Illuminate\Support\Collection;
use App\Models\MedicalCase;
use App\Models\MedicalCaseRecordType;

class RecordFormComponent extends Component
{
    public MedicalCase $medicalCase;
    public Collection $medicalCaseRecordTypes;

    /**
     * Create a new component instance.
     */
    public function __construct(MedicalCase $medicalCase)
    {
        $this->medicalCase = $medicalCase;
        $this->medicalCaseRecordTypes = MedicalCaseRecordType::all();
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.medical.cases.records.record-form-component');
    }
}
