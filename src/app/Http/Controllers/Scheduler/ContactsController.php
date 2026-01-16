<?php declare(strict_types=1);

namespace App\Http\Controllers\Scheduler;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use App\Models\Contact;

class ContactsController extends Controller
{
    public function index(Request $request): View
    {
        $contacts = auth()->user()
                          ->contacts()
                          ->Active()
                          ->join('customer_profiles', 'customer_profiles.customer_id', '=', 'customers.id')
                          ->orderBy('customer_profiles.first_name', 'asc')
                          ->select('customers.*') // essencial para evitar conflitos se houver colunas duplicadas
                          ->get();

        $current = auth()->user()
                         ->contacts()
                         ->Active()
                         ->find($request->get('contact_id'))
                         ?? ($contacts->count() ? $contacts->first() : null);

        return view('scheduler.contacts.index', compact('contacts', 'current'));
    }

    public function create(): View
    {
        // Show the form for creating a new schedule
        return view('contacts.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $request->all();

        $contact = auth()->user()->contacts()->create($data);

        return redirect()->route('contact', compact('contact'));
    }

    public function edit(Contact $contact): View
    {
        return view('contacts.edit', compact('contact'));
    }

    public function update(Request $request, Contact $contact): RedirectResponse
    {
        $data  = $request->all();

        $contact->update($data);

        return redirect()->route('contact', compact('contact'));
    }

    public function destroy(Request $request, Contact $contact): RedirectResponse
    {
        $confirm = (int) $request->get('confirm');

        if(is_null($confirm) || empty($confirm) || $confirm !== 1){
            return redirect()->route('contact', compact('contact'));
        }

        $contact->delete();

        if($contact->exists()){
            return redirect()->route('contact',compact('contact'));
        }

        return redirect()->route('contacts');
    }
}
