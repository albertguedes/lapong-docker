<?php declare(strict_types=1);

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Customer;

class ProfileController extends Controller
{
    private $customer;

    public function __construct(){
        $this->customer = auth()->user();
    }

    public function index()
    {
        return view('customer.profile.index',[
            'customer' => $this->customer
        ]);
    }

    public function edit(){
        return view('customer.profile.edit');
    }

    public function update(){
        return redirect()->route('customer.profile');
    }

    public function delete(){
        return view('customer.profile.delete');
    }

    public function destroy(){
        return redirect()->route('auth.logout');
    }
}
