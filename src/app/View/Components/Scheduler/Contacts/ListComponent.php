<?php declare(strict_types=1);

namespace App\View\Components\Scheduler\Contacts;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\View\Component;
use App\Models\Customer;

class ListComponent extends Component
{
    public array $contacts = [];

    /**
     * Create a new component instance.
     */
    public function __construct(Collection $contacts, Customer $current)
    {
        foreach($contacts as $contact){
            $this->contacts[] = [
                'id' => $contact->id,
                'name' => $contact->profile->name(),
                'roles' => $contact->roles->pluck('title')->toArray(),
                'current' => ($current !== null && $current->id === $contact->id)
            ];
        }
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.scheduler.contacts.list-component');
    }
}
