<?php declare(strict_types=1);

namespace App\View\Components\Messages;

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
                'href' => route('messages'),
                'class' => $this->isFilterActive('') ? 'active' : 'text-secondary'
            ],
            [
                'label' => 'Unread',
                'href' => route('messages', ['filter' => 'unread']),
                'class' => $this->isFilterActive('unread') ? 'active' : 'text-secondary'
            ],
            [
                'label' => 'Read',
                'href' => route('messages', ['filter' => 'read']),
                'class' => $this->isFilterActive('read') ? 'active' : 'text-secondary'
            ],
        ];
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components..messages.nav-component');
    }

    function isFilterActive(string $filter = ''): bool
    {
        if (Route::currentRouteName() !== 'messages') {
            return false;
        }

        return $filter ? request('filter') === $filter : request('filter') === null;
    }

}
