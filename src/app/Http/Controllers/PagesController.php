<?php declare(strict_types=1);

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PagesController extends Controller
{
    public function privacy(){
        return view('pages.privacy');
    }

    public function terms(){
        return view('pages.terms');
    }

    public function about(){
        return view('pages.about');
    }

    public function help(){
        return view('pages.help');
    }
}
