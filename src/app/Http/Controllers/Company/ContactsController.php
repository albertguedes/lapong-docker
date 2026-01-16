<?php

namespace App\Http\Controllers\Company;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ContactsController extends Controller
{
    public function index(){
        return view('company.contacts.index');
    }

    public function create(){
        return view('company.contacts.create');
    }

    public function show(){
        return view('company.contacts.show');
    }

    public function edit(){
        return view('company.contacts.edit');
    }

    public function update(){
        return view('company.contacts.update');
    }

    public function delete(){
        return view('company.contacts.delete');
    }

    public function destroy(){
        return redirect()->route('company.contacts.index');
    }
}
