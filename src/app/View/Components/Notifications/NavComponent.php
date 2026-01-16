<?php

namespace App\View\Components\Notifications;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use Illuminate\Support\Facades\Route;

class NavComponent extends Component
{
    public array $items = [];

    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        $this->items = [
            [
                'label' => 'All',
                'href' => route('notifications'),
                'class' => $this->isFilterActive('') ? 'active border-bottom border-3 border-primary' : 'text-secondary'
            ],
            [
                'label' => 'Unread',
                'href' => route('notifications', ['filter' => 'unread']),
                'class' => $this->isFilterActive('unread') ? 'active border-bottom border-3 border-primary' : 'text-secondary'
            ],
            [
                'label' => 'Read',
                'href' => route('notifications', ['filter' => 'read']),
                'class' => $this->isFilterActive('read') ? 'active border-bottom border-3 border-primary' : 'text-secondary'
            ],
        ];
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components..notifications.nav-component');
    }

    function isFilterActive(string $filter = ''): bool
    {
        if (Route::currentRouteName() !== 'notifications') {
            return false;
        }

        return $filter ? request('filter') === $filter : request('filter') === null;
    }

}
