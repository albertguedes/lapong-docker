<?php declare(strict_types=1);

namespace App\Http\Controllers\Medical;

use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use App\Http\Controllers\Controller;
use App\Models\Customer;

class ProfessionalsController extends Controller
{
    const ROLE = 'profissional';

    public function index()
    {
        $professionals = Customer::whereHas('roles', function ($q) {
            $q->where('title', self::ROLE);
        })
        ->Active()
        ->paginate(10);

        return view('medical.professionals.index', compact('professionals'));
    }

    public function search(Request $request)
    {
        $term = $request->get('q');
        $medical_field = $request->get('medical_field');
        $professional_name = $request->get('professional_name');
        $results = new Collection();

        return view('medical.professionals.index',compact('results'));
    }

    public function show(Customer $professional)
    {
        return view('medical.professionals.show', compact('professional'));
    }
}
