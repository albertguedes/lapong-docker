<?php declare(strict_types=1);

namespace App\View\Components\Layouts\Main\Partials\Nav;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use App\Models\Customer;

class MessagesAlert extends Component
{
    public $messages;
    public $count;

    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        $this->messages = auth()->user()
                                ->receivedMessages()
                                ->Active()
                                ->Unread()
                                ->where('is_deleted', false)
                                ->orderBy('created_at', 'desc')
                                ->take(5)
                                ->get();

        $this->count = auth()->user()
                             ->receivedMessages()
                             ->Active()
                             ->Unread()
                             ->where('is_deleted', false)
                             ->count();
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components..layouts.main.partials.nav.messages-alert');
    }
}
