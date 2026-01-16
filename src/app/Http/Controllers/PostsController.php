<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PostsController extends Controller
{
    public function index() {
        return view('posts.index');
    }

    public function show() {
        return view('posts.show');
    }

    public function create() {
        return view('posts.create');
    }

    public function store() {
        return view('posts.store');
    }

    public function edit() {
        return view('posts.edit');
    }

    public function update() {
        return view('posts.update');
    }

    public function delete() {
        return view('posts.delete');
    }

    public function destroy() {
        return view('posts.destroy');
    }
}
