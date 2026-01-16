<?php declare(strict_types=1);

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ContactsController extends Controller
{
    public function index() {
        return view('customer.contacts.index');
    }

    public function show(){
        return view('customer.contacts.show');
    }

    public function create(){
        return view('customer.contacts.create');
    }

    public function store(){
        return redirect()->route('customer.contacts.show');
    }

    public function edit(){
        return view('customer.contacts.edit');
    }

    public function update(){
        return redirect()->route('customer.contacts.show');
    }

    public function delete(){
        return view('customer.contact.delete');
    }

    public function destroy(){
        return redirect()->route('customer.contacts.index');
    }
}
