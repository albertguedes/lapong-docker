<?php declare(strict_types=1);

namespace App\Http\Controllers\Medical;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ExamsController extends Controller
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

        return view('medical.exams.index', compact('professionals'));
    }

    public function store(Request $request)
    {
        return redirect()->route('scheduler');
    }
}
