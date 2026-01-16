<?php declare(strict_types=1);

namespace App\View\Components\Scheduler\Events;

use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\View\Component;
use Carbon\Carbon;
use App\Models\Event;

class ListComponent extends Component
{
    public array $events = [];

    /**
     * Create a new component instance.
     */
    public function __construct(Collection $events, Event $current, string $period = 'day')
    {
        if (!$events instanceof Collection) {
            throw new \InvalidArgumentException('Invalid events collection.');
        }

        if (empty($period) || !is_string($period) || !in_array($period, ['day', 'week', 'month', 'year'])) {
            throw new \InvalidArgumentException('Invalid period. Must be a non-empty string and one of "day", "week", "month", or "year".');
        }
        foreach($events as $event){

            $is_current = ($event->id === $current->id);
            $is_ended = Carbon::parse($event->end)->lte(Carbon::now());

            $this->events[] = [
                'id' => $event->id,
                'title' => $event->title,
                'begin' => self::getFormartedDateTime($event->begin, $period) . " - " . now()->diffForHumans($event->begin),
                'end' => self::getFormartedDateTime($event->end, $period),
                'is_current' => $is_current,
                'is_ended' => $is_ended,
                'route' => route('scheduler.events', [
                    'current_event_id' => $event->id,
                    'year' => Carbon::parse($event->begin)->format('Y'),
                    'month' => Carbon::parse($event->begin)->format('m'),
                    'day' => Carbon::parse($event->begin)->format('d')
                ])
            ];
        }
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View
    {
        return view('components.scheduler.events.list-component');
    }

    /**
     * Returns a formatted date and time string from a given datetime and period.
     *
     * @param string $datetime The datetime string to be formatted.
     * @param string $period The period of the datetime, must be one of 'day', 'week', 'month', 'year'.
     * @return string The formatted datetime string.
     */
    public static function getFormartedDateTime(string $datetime, string $period): string
    {
        if (empty($datetime) || !is_string($datetime)) {
            throw new \InvalidArgumentException('Invalid datetime. Must be a non-empty string.');
        }

        if (empty($period) || !is_string($period) || !in_array($period, ['day', 'week', 'month', 'year'])) {
            throw new \InvalidArgumentException('Invalid period. Must be a non-empty string and one of "day", "week", "month", or "year".');
        }

        $carbonDate = Carbon::parse($datetime)->setTimezone('America/Sao_Paulo');

        return $carbonDate->format('M d H:i');
    }
}
