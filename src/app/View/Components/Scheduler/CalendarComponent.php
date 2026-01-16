<?php declare(strict_types=1);

namespace App\View\Components\Scheduler;

use Carbon\Carbon;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use Illuminate\Support\Collection;

class CalendarComponent extends Component
{
    public array $events_for_day = [];
    public int $last_month_day;
    public int $max_weeks;
    public int $first_day_week;
    public int $last_day_previous_month;

    /**
     * Create a new component instance.
     */
    public function __construct(Collection $events, Carbon $current)
    {
        $this->last_month_day = $current->copy()->endOfMonth()->day;
        $this->last_day_previous_month = $current->copy()->subMonth()->endOfMonth()->day;

        $this->max_weeks = 5;
        $this->first_day_week = (int) $current->copy()->startOfMonth()->format('w');

        for ($day = 0; $day < $this->last_month_day; $day++) {
            $dayStart = $current->copy()->startOfMonth()->addDays($day)->startOfDay();
            $dayEnd = $dayStart->copy()->endOfDay();

            $this->events_for_day[$day] = $events
                ->filter(function ($event) use ($dayStart, $dayEnd) {
                    return $event->begin >= $dayStart && $event->begin <= $dayEnd;
                })
                ->map(function ($event) {
                    $begin = Carbon::parse($event->begin);
                    return [
                        'id'    => $event->id,
                        'begin' => $begin->format('H:i'),
                        'title' => $event->title,
                        'route' => route('scheduler.events', [
                            'current_event_id' => $event['id'],
                            'year' => $begin->format('Y'),
                            'month' => $begin->format('m'),
                            'day' => $begin->format('d'),
                        ]),
                    ];
                })
                ->values()
                ->toArray(); // Reindexa os arrays
        }
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View
    {
        return view('components.scheduler.calendar-component');
    }
}
