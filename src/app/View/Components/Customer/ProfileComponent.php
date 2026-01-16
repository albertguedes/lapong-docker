<?php declare(strict_types=1);

namespace App\View\Components\Customer;

use Carbon\Carbon;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use App\Models\Customer;

class ProfileComponent extends Component
{
    public $customer;

    /**
     * Create a new component instance.
     */
    public function __construct(Customer $customer)
    {
        foreach($customer->emails as $email){
            $emails[] = [
                'label' => $email->label,
                'value' => $email->value()
            ];
        }

        foreach($customer->telephones as $phone){
            $phones[] = [
                'label' => $phone->label,
                'value' => $phone->value()
            ];
        }

        $addresses = $customer->addresses()->get()->toArray();
        $documents = $customer->documents()->get()->toArray();

        $company = [];
        if($customer->company->exists()){
            $company = [
                'trade_name' => $customer->company->trade_name,
                'is_colleague' => $this->isColleague($customer, auth()->user()),
            ];
        }

        $this->customer = [
            'id' => $customer->id,
            'name' => $customer->profile->name(),
            'main_email' => $customer->email,
            'emails' => $emails,
            'phones' => $phones,
            'birthdate' => Carbon::parse($customer->profile->birthdate)->format('d M Y'),
            'age' => $customer->profile->age(),
            'gender_name' => $customer->profile->gender_name(),
            'gender' => $customer->profile->gender,
            'addresses' => $addresses,
            'documents' => $documents,
            'company' => $company
        ];
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.customer.profile-component');
    }

    private function isColleague(Customer $contact, Customer $customer): bool
    {
        return $contact->company->employers()->where('employer_id', $customer->id)->exists();
    }
}
