<?php declare(strict_types=1);

namespace App\Http\Controllers\Medical;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use App\Http\Controllers\Controller;
use App\Models\MedicalCase;
use App\Models\MedicalCaseRecord;

class RecordsController extends Controller
{
    public function create(MedicalCase $medicalCase): View
    {
        return view('medical.case.records.create', compact('medicalCase'));
    }

    public function store(Request $request, MedicalCase $medicalCase): RedirectResponse
    {
        $data = $request->get('record');

        $medicalCaseRecord = MedicalCaseRecord::create($data);

        return redirect()->route('medical.case',[ 'medical_case_id' => $medicalCase->id ])
                         ->with('success', 'Record created');
    }

    public function show(MedicalCase $medicalCase, MedicalCaseRecord $medicalCaseRecord): View
    {
        $previous_id = $medicalCase->records()
                                    ->where('created_at', '<', $medicalCaseRecord->created_at)
                                    ->Active()
                                    ->orderBy('created_at', 'desc')
                                    ->first()
                                    ?->id;

        $next_id = $medicalCase->records()
                                ->where('created_at', '>', $medicalCaseRecord->created_at)
                                ->Active()
                                ->orderBy('created_at', 'asc')
                                ->first()
                                ?->id;
        return view('medical.cases.record.show',compact('medicalCaseRecord','previous_id','next_id'));
    }

    public function edit(MedicalCaseRecord $record): View
    {
        return view('medical.cases.records.edit', compact('record'));
    }

    public function update(Request $request, MedicalCaseRecord $record): RedirectResponse
    {
        return redirect()->route('medical.case.record',compact('record'))
                         ->with('success', 'Record updated');
    }

    public function destroy(Request $request, MedicalCaseRecord $record): RedirectResponse
    {
        $confirm = $request->get('confirm');

        if(is_null($confirm) || empty($confirm) || $confirm != '1'){
            return redirect()->route('medical.case.record',compact('record'));
        }

        $case = $record->case;
        $record->delete();

        if($record->exists()){
            return redirect()->route('medical.case.record',compact('record'));
        }

        return redirect()->route('medical.case',compact('case'))
                         ->with('success', 'Record deleted');
    }
}
