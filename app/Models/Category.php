<?php

namespace App\Models;

use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Category extends Model
{
    use HasFactory;

    protected $table = "categories";

    protected $fillable = ['name', 'slug', 'author_id'];

    static public function getSingleRecordByCurrentUser($id)
    {
        return self::where('id', $id)->first();
    }

    static public function getAllRecordByCurrentUser()
    {
        return self::where('author_id', Auth::id())->get();
    }

    static public function addCategory($data)
    {
        return self::create([
            'name'      => $data['name'],
            'slug'      => $data['slug'],
            'author_id' => Auth::id(),
        ]);
    }

    static public function editCategory($id, $data)
    {
        return self::where('id', $id)->update([
            'name'      => $data['name'],
            'slug'      => $data['slug'],
            'author_id' => Auth::id(),
        ]);
    }

    static public function deleteCategory($id)
    {
        $category = self::where('id', $id)
            ->where('author_id', Auth::id())
            ->firstOrFail();

        return $category->delete();
    }

    public function posts()
    {
        return $this->hasMany(Post::class, 'category_id');
    }

    public function authors()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
