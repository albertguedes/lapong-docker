<?php declare(strict_types=1);

namespace App\Http\Controllers\Company;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class InfoController extends Controller
{
    public function index()
    {
        $company = auth()->user()->company;
        return view('company.info.index', compact('company'));
    }

    public function edit(){
        return view('company.info.edit');
    }

    public function update(){
        return redirect()->route('company.info.index');
    }

    public function delete(){
        return view('company.info.delete');
    }

    public function destroy(){
        return view('company.info.destroy');
    }
}
