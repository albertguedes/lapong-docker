<?php

namespace App\Http\Controllers\Company;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DocumentsController extends Controller
{
    public function index(){
        return view('company.documents.index');
    }

    public function create(){
        return view('company.documents.create');
    }

    public function store(){
        return redirect()->route('company.documents.show');
    }

    public function show(){
        return view('company.documents.show');
    }

    public function edit(){
        return view('company.documents.edit');
    }

    public function update(){
        return redirect()->route('company.documents.show');
    }

    public function delete(){
        return view('company.documents.delete');
    }

    public function destroy(){
        return redirect()->route('company.documents.index');
    }
}
