<?php declare(strict_types=1);

namespace App\Http\Controllers\Medical;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ConsultsController extends Controller
{
    const ROLE = 'profissional';

    public function index()
    {
        $professionals = auth()->user()
                                ->contacts()
                                ->Active()
                                ->whereHas('roles', function ($q) {
                                    $q->where('title', self::ROLE);
                                })
                                ->get();

        return view('medical.consults.index', compact('professionals'));
    }

    public function store(Request $request)
    {
        return redirect()->route('scheduler');
    }
}
