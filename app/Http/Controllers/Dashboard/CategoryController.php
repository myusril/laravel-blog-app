<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CategoryController extends Controller
{
    public function indexCategory()
    {
        $categories = Category::getAllRecordByCurrentUser();

        return view('dashboards.categories.index-categories', [
            'title' => 'Dashboard - Category',
            'categories' => $categories,
        ]);
    }

    public function showAddCategoryForm()
    {
        return view('dashboards.categories.add-categories', [
            'title' => 'Dashboard - Add Category',
        ]);
    }

    public function actionAddCategory(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'slug' => 'required|string',
        ]);

        $slug = $request->slug . '-' . Str::random(10);

        while (Category::where('slug', $slug)->exists()) {
            $slug = Str::slug($request->slug) . '-' . Str::random(10);
        }

        Category::addCategory([
            'name' => trim($request->name),
            'slug' => trim($slug)
        ]);

        return redirect('/dashboard/categories');
    }

    public function showEditCategoryForm(Request $request, $id)
    {
        $category = Category::getSingleRecordByCurrentUser($id);

        return view('dashboards.categories.edit-categories', [
            'title' => 'Dashboard - Edit Category',
            'category' => $category,
        ]);
    }

    public function actionEditCategory(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string',
            'slug' => 'required|string',
        ]);

        $slug = $request->slug . '-' . Str::random(10);

        while (Category::where('slug', $slug)->exists()) {
            $slug = Str::slug($request->slug) . '-' . Str::random(10);
        }

        Category::editCategory($id, [
            'name' => trim($request->name),
            'slug' => trim($slug)
        ]);

        return redirect('/dashboard/categories');
    }

    public function actionDeleteCategory(Request $request, $id)
    {
        Category::deleteCategory($id);

        return redirect('/dashboard/categories');
    }
}
