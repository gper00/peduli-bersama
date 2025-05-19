<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use App\Models\PostCategory;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
// use Illuminate\Support\Facades\Redis;
// use App\Http\Controllers\dashboard\PostController;

class PostCategoryController extends Controller
{
    public function index()
    {
        return view('dashboard.post-category.index', [
            'postCategories' => PostCategory::latest()->get(),
            'postPage' => true,
            'postCategoryPage' => true
        ]);
    }

    public function create()
    {
        return view('dashboard.post-category.create', [
            'postPage' => true,
            'postCategoryPage' => true
        ]);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|min:4|max:24|unique:post_categories'
        ]);

        $validatedData['slug'] = Str::of($request->name)->slug('-');
        
        PostCategory::create($validatedData);

        return redirect('/dashboard/post-categories')->with('success', 'New post category has created!');
    }

    public function edit(PostCategory $postCategory)
    {
        return view('dashboard.post-category.edit', [
            'postCategory' => $postCategory,
            'postPage' => true,
            'postCategoryPage' => true,
        ]);
    }

    public function update(Request $request, PostCategory $postCategory)
    {
        if($request->name === $postCategory->name)
        {
            $validatedData = $request->validate([
                'name' => 'required|min:4|max:24'
            ]);
        } else
        {
            $validatedData = $request->validate([
                'name' => 'required|min:4|max:24|unique:post_categories'
            ]);
        }

        $validatedData['slug'] = Str::of($request->name)->slug('-');
        
        PostCategory::where('id', $postCategory->id)->update($validatedData);

        return redirect('/dashboard/post-categories')->with('success', 'Post category has been updated!');
    }

    public function destroy(PostCategory $postCategory)
    {
        Post::where('category_id', $postCategory->id)->update(['category_id' => NULL]);
        PostCategory::destroy($postCategory->id);

        return redirect('/dashboard/post-categories')->with('success', 'Post category has been deleted!');
    }
}
