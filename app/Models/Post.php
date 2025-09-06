<?php

namespace App\Models;

use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Post extends Model
{
    use HasFactory;

    protected $table = "posts";

    protected $fillable = ['title', 'slug', 'author_id', 'category_id', 'body'];

    static public function getAllRecord($request)
    {
        $query = self::with(['categories', 'authors']);

        if ($request->has('search') && $request->search != '') {
            $query->where('title', 'like', '%' . $request->search . '%');
        }

        if ($request->has('categories') && is_array($request->categories)) {
            $query->whereHas('categories', function ($q) use ($request) {
                $q->whereIn('id', $request->categories);
            });
        }

        if ($request->has('sort')) {
            switch ($request->sort) {
                case 'latest':
                    $query->orderBy('created_at', 'desc');
                    break;
                case 'oldest':
                    $query->orderBy('created_at', 'asc');
                    break;
            }
        } else {
            $query->orderBy('created_at', 'desc');
        }

        return $query->paginate(10)->appends($request->query());
    }

    static public function getSingleRecord($slug)
    {
        return self::where('slug', $slug)->first();
    }

    static public function getSingleRecordByCurrentUser($id)
    {
        return self::where('id', $id)->first();
    }

    static public function getAllRecordByCurrentUser()
    {
        return self::with('categories')->where('author_id', Auth::id())->get();
    }

    static public function addPost($data)
    {
        return self::create([
            'title' => $data['title'],
            'slug' => $data['slug'],
            'author_id' => Auth::id(),
            'category_id' => $data['category_id'],
            'body' => $data['body'],
        ]);
    }

    static public function editPost($id, $data)
    {
        return self::where('id', $id)->update([
            'title' => $data['title'],
            'slug' => $data['slug'],
            'author_id' => Auth::id(),
            'category_id' => $data['category_id'],
            'body' => $data['body'],
        ]);
    }

    static public function deletePost($id)
    {
        $post = self::where('id', $id)
            ->where('author_id', Auth::id())
            ->firstOrFail();

        return $post->delete();
    }

    public function categories()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function authors()
    {
        return $this->belongsTo(User::class, 'author_id');
    }

    public function comments()
    {
        return $this->hasMany(Comment::class)->whereNull('parent_id');
    }
}
