<?php

namespace App\View\Components\Layouts\Main\Partials\Nav;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use App\Models\Customer;

class NotificationsAlert extends Component
{
    public $notifications;
    public $count;

    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        $this->notifications = auth()->user()
                                     ->notifications()
                                     ->Active()
                                     ->Unread()
                                     ->orderBy('created_at', 'desc')
                                     ->take(5)
                                     ->get();

        $this->count = auth()->user()
                             ->notifications()
                             ->Active()
                             ->Unread()
                             ->count();
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.layouts.main.partials.nav.notifications-alert');
    }
}
