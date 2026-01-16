<?php

namespace App\Http\Controllers\Company;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ClientsController extends Controller
{
    public function index()
    {
        $company = auth()->user()->company->toArray();
        $patients = auth()->user()->company->clients;

        return view('company.clients.index',compact('company', 'patients'));
    }
}
