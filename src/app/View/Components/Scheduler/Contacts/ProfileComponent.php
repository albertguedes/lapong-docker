<?php

namespace App\View\Components\Scheduler\Contacts;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use App\Models\Customer;

class ProfileComponent extends Component
{
    public $current;

    /**
     * Create a new component instance.
     */
    public function __construct(Customer $current)
    {
        $this->current = $current;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.scheduler.contacts.profile-component');
    }
}
