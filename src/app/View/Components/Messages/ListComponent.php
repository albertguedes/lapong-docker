<?php declare(strict_types=1);

namespace App\View\Components\Messages;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\View\Component;

class ListComponent extends Component
{
    public Collection $messages;

    /**
     * Create a new component instance.
     */
    public function __construct(Collection $messages)
    {
        $this->messages = $messages;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.messages.list-component');
    }
}
