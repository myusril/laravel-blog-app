<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Post;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PostController extends Controller
{
    public function indexPost()
    {
        $posts = Post::getAllRecordByCurrentUser();

        return view('dashboards.posts.index-posts', [
            'title' => 'Dashboard - Post',
            'posts' => $posts,
        ]);
    }

    public function showAddPostForm()
    {
        $categories = Category::all();

        return view('dashboards.posts.add-posts', [
            'title' => 'Dashboard - Add Post',
            'categories' => $categories
        ]);
    }

    public function actionAddPost(Request $request)
    {
        $request->validate([
            'title' => 'required|string',
            'slug' => 'required|string',
            'category_id' => 'required|exists:categories,id',
            'body' => 'required|string'
        ]);

        $slug = $request->slug . '-' . Str::random(10);

        while (Post::where('slug', $slug)->exists()) {
            $slug = Str::slug($request->slug) . '-' . Str::random(10);
        }

        Post::addPost([
            'title'       => $request->title,
            'slug'        => $slug,
            'category_id' => $request->category_id,
            'body'        => $request->body
        ]);

        return redirect('/dashboard/posts');
    }

    public function showEditPostForm(Request $request, $id)
    {
        $post = Post::getSingleRecordByCurrentUser($id);
        $categories = Category::all();

        return view('dashboards.posts.edit-posts', [
            'title' => 'Dashboard - Edit Post',
            'post' => $post,
            'categories' => $categories
        ]);
    }

    public function actionEditPost(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string',
            'slug' => 'required|string',
            'category_id' => 'required|exists:categories,id',
            'body' => 'required|string'
        ]);

        $slug = $request->slug . '-' . Str::random(10);

        while (Post::where('slug', $slug)->exists()) {
            $slug = Str::slug($request->slug) . '-' . Str::random(10);
        }

        Post::editPost($id, [
            'title'       => $request->title,
            'slug'        => $slug,
            'category_id' => $request->category_id,
            'body'        => $request->body
        ]);

        return redirect('/dashboard/posts');
    }

    public function actionDeletePost(Request $request, $id)
    {
        Post::deletePost($id);

        return redirect('/dashboard/posts');
    }
}
