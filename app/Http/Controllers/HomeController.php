<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function home(Request $request)
    {
        $posts = Post::getAllRecord($request);
        $categories = Category::all();

        return view("home", [
            "title" => "Home",
            'posts' => $posts,
            'categories' => $categories
        ]);
    }

    public function showSinglePost($slug)
    {

        $post = Post::getSingleRecord($slug);

        return view("single-post", [
            "title" => "Single Post",
            'post' => $post,
        ]);
    }
}
