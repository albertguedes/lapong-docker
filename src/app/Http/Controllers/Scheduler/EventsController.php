<?php declare(strict_types=1);

namespace App\Http\Controllers\Scheduler;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use App\Http\Controllers\Controller;
use App\Models\Event;

class EventsController extends Controller
{
    public function index(Request $request): View
    {
        $year = $request->get('year', now()->year);
        $month = $request->get('month', now()->month);
        $day = $request->get('day', now()->day);

        $current_date = Carbon::create($year, $month, $day);
        $start_interval = $current_date->copy()->startOfDay()->format('Y-m-d H:i:s');
        $end_interval = $current_date->copy()->endOfDay()->format('Y-m-d H:i:s');

        $customer = auth()->user();
        $events = Event::where('event_creator_id', $customer->id)
                        ->orWhereHas('participants', function ($q) use ($customer) {
                            $q->where('participant_id', $customer->id);
                        })
                        ->distinct()
                        ->Active()
                        ->whereBetween('begin', [$start_interval, $end_interval])
                        ->orderBy('begin','desc')
                        ->get();

        $current_event_id = $request->get('current_event_id',null);
        if(!is_null($current_event_id) && $current_event_id>0){
            $current_event = Event::find($current_event_id);
        }
        else{
            $current_event = $events->first();
        }

        return view('scheduler.events.index', compact('events', 'current_event', 'current_date'));
    }

    public function create(): View
    {
        // Show the form for creating a new schedule
        return view('events.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $request->all();

        $event = auth()->user()
                       ->events()
                       ->create($data);

        return redirect()->route('event', compact('event'));
    }

    public function edit(Event $event): View
    {
        return view('events.edit', compact('event'));
    }

    public function update(Request $request, Event $event): RedirectResponse
    {
        $data  = $request->all();

        $event->update($data);

        return redirect()->route('event', compact('event'));
    }

    public function destroy(Request $request, Event $event): RedirectResponse
    {
        $confirm = $request->get('confirm');

        if(is_null($confirm) || empty($confirm) || $confirm != '1'){
            return redirect()->route('event', compact('event'));
        }

        $event->delete();

        if($event->exists()){
            return redirect()->route('event',compact('event'));
        }

        return redirect()->route('events');
    }
}
