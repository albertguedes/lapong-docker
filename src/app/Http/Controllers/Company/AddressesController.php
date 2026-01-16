<?php

namespace App\Http\Controllers\Company;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AddressesController extends Controller
{
    public function index(){
        return view('company.addresses.index');
    }

    public function create(){
        return view('company.addresses.create');
    }

    public function store(Request $request){
        return redirect()->route('company.addresses.index');
    }

    public function show($id){
        return view('company.addresses.show', compact('address'));
    }

    public function edit($id){
        return view('company.addresses.edit', compact('address'));
    }

    public function update(Request $request, $id){
        return redirect()->route('company.addresses.index');
    }

    public function destroy($id){
        return redirect()->route('company.addresses.index');
    }
}
