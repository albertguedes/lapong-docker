<?php declare(strict_types=1);

namespace App\Http\Controllers\Company;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\View\View;

class EmployersController extends Controller
{
    const PROFESSIONAL = 'profissional';

    public function index(Request $request)
    {
        $customer = auth()->user();
        $company = $customer->company->toArray();
        $employers = $customer->company->employers;

        $current_employer_id = $request->get('employer_id') ?? $employers->first()->id;

        $current = $employers->where('id', $current_employer_id);

        return view('company.employers.index', compact('company','employers', 'current'));
    }

    public function store()
    {
        return redirect()->route('company.employers.index');
    }

    public function destroy()
    {
        return redirect()->route('company.employers.index');
    }

    public function search(Request $request): View
    {
        if($request->get('professional')){
            $result = CompanyEmployer::query()->whereHas('employer.roles', fn($q) => $q->where('title', self::PROFESSIONAL))
                                            ->whereHas('company', fn($q) => $q->active())
                                            ->active()
                                            ->join('profiles', 'profiles.customer_id', '=', 'company_employers.employer_id')
                                            ->orderBy('profiles.first_name', 'asc')
                                            ->select('company_employers.*') // importante manter modelo correto
                                            ->paginate(10);

            return view('company.employers.search', compact('result'));
        }

        if($company_id = $request->get('company_id')){
            $result = CompanyEmployer::query()->where('company_id', $request->get('company_id'))
                                            ->whereHas('company', fn($q) => $q->active())
                                            ->active()
                                            ->join('profiles', 'profiles.customer_id', '=', 'company_employers.employer_id')
                                            ->orderBy('profiles.first_name', 'asc')
                                            ->select('company_employers.*') // importante manter modelo correto
                                            ->paginate(10);

            return view('company.employers.search', compact('result'));
        }

        return view('company.employers.search');
    }
}

