<?php declare(strict_types=1);

namespace App\Http\Controllers\Scheduler;

use App\Models\Event;
use Carbon\Carbon;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CalendarController extends Controller
{
    public function index(Request $request): View
    {
        $year = $request->get('year', now()->year);
        $month = $request->get('month', now()->month);
        $day = $request->get('day', now()->day);

        $current_date = Carbon::create($year, $month, $day);

        $start_interval = $current_date->copy()->startOfMonth()->format('Y-m-d H:i:s');
        $end_interval = $current_date->copy()->endOfMonth()->format('Y-m-d H:i:s');

        $customer = auth()->user();
        $events = Event::where('event_creator_id', $customer->id)
                        ->orWhereHas('participants', function ($q) use ($customer) {
                            $q->where('participant_id', $customer->id);
                        })
                        ->distinct()
                        ->Active()
                        ->get();

        return view('scheduler.calendar.index', compact('events', 'current_date'));
    }
}
