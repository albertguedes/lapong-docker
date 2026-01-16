<?php declare(strict_types=1);

namespace App\View\Components\Messages;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use App\Models\Message;

class MessageComponent extends Component
{
    public Message $message;

    /**
     * Create a new component instance.
     */
    public function __construct(Message $message)
    {
        $this->message = $message;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.messages.message-component');
    }
}
