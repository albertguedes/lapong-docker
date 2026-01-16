<?php declare(strict_types=1);

namespace App\Http\Controllers\Medical;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\MedicalCase;

class CasesController extends Controller
{
    public function index(Request $request)
    {
        $cases = auth()->user()
                       ->medicalCasesAsPatient()
                       ->Active()
                       ->orderBy('created_at', 'desc')
                       ->get();

        $current_case_id = $request->get('medical_case_id');
        if(isset($current_case_id) && $current_case_id > 0) {
            $current_case = auth()->user()
                                  ->medicalCasesAsPatient()
                                  ->Active()
                                  ->orderBy('created_at', 'desc')
                                  ->find($current_case_id);
        }
        else{
            $current_case = $cases->first();
        }

        return view('medical.cases.index',compact('cases', 'current_case'));
    }

    public function create()
    {
        $contacts = auth()->user()
                          ->contacts()
                          ->Active()
                          ->join('customer_profiles', 'customer_profiles.customer_id', '=', 'customers.id')
                          ->orderBy('customer_profiles.first_name', 'asc')
                          ->get();

        return view('medical.cases.create', compact('contacts'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
        ]);

        //TODO: Implementar o armazenamento dos dados
        return redirect()->route('medical.case', ['id' => 1])->with('message', 'Cadastro realizado com sucesso!');
    }

    public function show(MedicalCase $case)
    {
        $case_id = $case->id;
        $records = $case->records()
                        ->orderBy('created_at', 'desc')
                        ->get();

        return view('medical.cases.show', compact('case_id','records'));
    }

    public function edit(Request $request, MedicalCase $case)
    {
        return view('medical.cases.edit', compact('case'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'id' => 'required',
            'name' => 'required',
            'description' => 'required',
        ]);

        //TODO: Implementar o armazenamento dos dados
        return redirect()->with('success', 'Cadastro atualizado com sucesso!')->route('medical.case', compact('case'));
    }

    public function destroy(MedicalCase $case)
    {
        $case->delete();
        return redirect()->route('medical.cases')->with('message', 'Cadastro removido com sucesso!');
    }
}