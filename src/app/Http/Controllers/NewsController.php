<?php declare(strict_types=1);

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Models\Post;
use App\Models\Customer;

class NewsController extends Controller
{
    public function index(Request $request): View
    {
        $page = $request->get('page', 1);
        $author_id = $request->get('author_id', null);

        $author='';
        if(is_null($author_id)){
            $news = Post::published()
                        ->active()
                        ->orderByDesc('posts.created_at')
                        ->select('posts.*')
                        ->get();
        }
        else{
            $author = Customer::find($author_id)->profile->name();
            $news = Post::published()
                        ->active()
                        ->where('posts.customer_id', $author_id)
                        ->orderByDesc('posts.created_at')
                        ->select('posts.*')
                        ->get();
        }

        return view('news.index', compact('news', 'author'));
    }

    public function show(Post $new): View
    {
        return view('news.show', compact('new'));
    }

    public function search(Request $request): View
    {
        $query = strtolower($request->get('query'));

        $result = Post::search($query);

        return view('news.search', compact('result'));
    }
}
