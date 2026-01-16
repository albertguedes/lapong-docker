<?php

namespace App\View\Components\Company;

use App\Models\Company;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class InfoComponent extends Component
{
    public array $company = [];

    /**
     * Create a new component instance.
     */
    public function __construct(Company $company)
    {
        foreach($company->emails as $email){
            $emails[] = [
                'label' => $email->label,
                'value' => $email->value()
            ];
        }

        foreach($company->telephones as $phone){
            $phones[] = [
                'label' => $phone->label,
                'value' => $phone->value()
            ];
        }

        $addresses = $company->addresses()->get()->toArray();
        $documents = $company->documents()->get()->toArray();

        $this->company = [
            'id' => $company->id,
            'legal_name' => $company->legal_name,
            'trade_name' => $company->trade_name,
            'emails' => $emails,
            'phones' => $phones,
            'addresses' => $addresses,
            'documents' => $documents,
            'contact_id' => $company->customer->id
        ];
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.company.info-component');
    }
}
