<?php declare(strict_types=1);

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AddressesController extends Controller
{
    public function index(){
        return view('customer.address.index');
    }

    public function show(){
        return view('customer.address.show');
    }

    public function create(){
        return view('customer.address.create');
    }

    public function store(){
        return redirect()->route('customer.address.show');
    }

    public function edit(){
        return view('customer.address.edit');
    }

    public function update(){
        return redirect()->route('customer.address.show');
    }

    public function destroy(){
        return redirect()->route('customer.address.index');
    }
}
