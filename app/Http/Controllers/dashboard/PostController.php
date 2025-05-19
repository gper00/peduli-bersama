<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\PostCategory;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    public function index()
    {
        if(Auth::user()->role == 'super-admin'){
            return view('dashboard.post.index', [
                'posts' => Post::latest('created_at')->get(),
                'postPage' => true,
            ]);
        } else {
            return view('dashboard.post.index', [
                'posts' => Post::where('user_id', Auth::user()->id)->latest('created_at')->get(),
                'postPage' => true,
            ]);
        }
    }


    public function create()
    {
        return view('dashboard.post.create', [
            'postPage' => true,
            'postCategories' => PostCategory::all(),
        ]);
    }


    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|min:10|max:150|unique:posts',
            'image' => 'file|image|max:3072',
            'tags' => 'max:200',
            'content' => 'required|min:100'
        ]);
        $validatedData['slug'] = Str::of($request->title)->slug('-');
        if($request->file('image')){
            $validatedData['image'] = $request->file('image')->store('/uploads/posts');
        }
        $validatedData['category_id'] = $request->category;
        $validatedData['user_id'] = Auth::user()->id;

        Post::create($validatedData);
        return redirect('/dashboard/posts')->with('success', 'New post created successfully!');
    }


    public function edit(Post $post)
    {
        return view('dashboard.post.edit', [
            'post' => $post,
            'postPage' => true,
            'postCategories' => PostCategory::all(),
        ]);
    }


    public function update(Request $request, Post $post)
    {
        $rules = [
            'image' => 'file|image|max:3072',
            'tags' => 'max:200',
            'content' => 'required|min:100'
        ];
        if($request->title == $post->title){
            $rules['title'] = 'required|min:10|max:150';
        } else {
            $rules['title'] = 'required|min:10|max:150|unique:posts';
        }
        $validatedData = $request->validate($rules);
        $validatedData['slug'] = Str::of($validatedData['title'])->slug('-');
        $validatedData['category_id'] = $request->category;
        if($request->file('image')){
            $validatedData['image'] = $request->file('image')->store('/uploads/posts');
            if($post->image){
                Storage::delete($post->image);
            }
        }

        Post::where('id', $post->id)->update($validatedData);
        return redirect('/dashboard/posts')->with('success', 'Post updated successfully!');
    }


    public function show(Post $post)
    {
        return view('dashboard.post.show', [
            'post' => $post,
            'postPage' => true
        ]);
    }


    public function destroy(Post $post){
        if($post->image){
            Storage::delete($post->image);
        }
        Post::destroy($post->id);

        return redirect('/dashboard/posts')->with('success', 'Post has been deleted!');
    }


    public function deleteImage(Post $post)
    {
        Storage::delete($post->image);

        Post::where('id', $post->id)->update(['image' => NULL]);

        return redirect('/dashboard/posts/'.$post->id.'/edit');
    }
}
