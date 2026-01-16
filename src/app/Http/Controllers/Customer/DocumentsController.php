<?php declare(strict_types=1);

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DocumentsController extends Controller
{
    public function index(){
        return view('customer.documents.index');
    }

    public function show(){
        return view('customer.documents.show');
    }

    public function create(){
        return view('customer.documents.create');
    }

    public function store(){
        return redirect()->route('customer.documents.show');
    }

    public function edit(){
        return view('customer.documents.edit');
    }

    public function update(){
        return redirect()->route('customer.documents.show');
    }

    public function delete(){
        return view('customer.documents.delete');
    }

    public function destroy(){
        return redirect()->route('customer.documents.index');
    }
}
