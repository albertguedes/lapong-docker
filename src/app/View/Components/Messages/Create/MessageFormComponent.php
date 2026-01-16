<?php declare(strict_types=1);

namespace App\View\Components\Messages\Create;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use App\Models\Customer;

class MessageFormComponent extends Component
{
    public array $sender = [];

    /**
     * Create a new component instance.
     */
    public function __construct(Customer $sender, ?Customer $receiver = null)
    {
        $contacts = [];

        if($receiver instanceof Customer) {
            $contacts[] = [
                'id' => $receiver->id,
                'name' => $receiver->profile->name()
            ];
        }
        else {
            $contacts = $sender->contacts()
                               ->Active()
                               ->orderBy('first_name')
                               ->get()
                               ->map(function($contact) {
                                    return [
                                        'id' => $contact->id,
                                        'name' => $contact->profile->name()
                                    ];
                                })
                               ->toArray();
        }

        $this->sender = [
            'id' => $sender->id,
            'name' => $sender->profile->name(),
            'contacts' => $contacts
        ];
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.messages.create.message-form-component');
    }
}
