<?php declare(strict_types=1);

namespace App\View\Components\Scheduler\Events;

use Closure;
use Carbon\Carbon;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use App\Models\Event;

class EventComponent extends Component
{
    public array $current_event = [];

    /**
     * Create a new component instance.
     */
    public function __construct(Event $current)
    {
        if (!($current instanceof Event)) {
            throw new \InvalidArgumentException('O argumento precisa ser uma instancia de '.Event::class);
        }

        $participants = [];
        foreach($current->participants as $participant){
            $participants[] = [
                'id' => $participant->id,
                'name' => $participant->profile->name(),
            ];
        }

        $is_ended = Carbon::parse($current->end)->isPast();

        $this->current_event = [
            'event_id' => $current->id,
            'title' => $current->title,
            'begin' => Carbon::parse($current->begin)->format('d/m/Y H:i'),
            'end' => Carbon::parse($current->end)->format('d/m/Y H:i'),
            'description' => $current->description,
            'participants' => $participants,
            'is_ended' => $is_ended
        ];

        //dd(now(), $current->end,$is_ended );
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components..scheduler.events.event-component');
    }
}
