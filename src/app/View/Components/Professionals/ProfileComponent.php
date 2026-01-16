<?php

namespace App\View\Components\Professionals;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use App\Models\Customer;

class ProfileComponent extends Component
{
    public array $professional = [];

    /**
     * Create a new component instance.
     */
    public function __construct(Customer $professional)
    {
        $this->professional = [
            'id' => $professional->id,
            'name' => $professional->profile->name(),
            'company' => $professional->company->trade_name,
            'is_contact' => $this->isContact($professional->id, auth()->id()),
        ];
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.professionals.profile-component');
    }

    private function isContact(int $professional_id, int $customer_id): bool
    {
        return Customer::find($customer_id)?->contacts()
                                            ->where('contact_id', $professional_id)
                                            ->exists() ?? false;
    }
}
