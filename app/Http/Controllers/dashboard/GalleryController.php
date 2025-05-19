<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Gallery;
use App\Models\GalleryCategory;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class GalleryController extends Controller
{
    public function index()
    {
        return view('dashboard.gallery.index', [
            'galleries' => Gallery::latest('created_at')->get(),
            'galleryPage' => true
        ]);
    }


    public function create()
    {
        return view('dashboard.gallery.create', [
            'galleryPage' => true,
            'galleryCategories'=> GalleryCategory::all()
        ]);
    }


    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|min:10|max:150',
            'image' => 'required|file|image|max:3072',
            'shoot_on' => 'required|date|before:' . now(),
            'description' => 'max:500'
        ]);
        $validatedData['image'] = $request->file('image')->store('/uploads/galleries');
        $validatedData['category_id'] = $request->category;

        Gallery::create($validatedData);
        return redirect('/dashboard/galleries')->with('success', 'New gallery created successfully!');
    }


    public function edit(Gallery $gallery)
    {
        return view('dashboard.gallery.edit', [
            'gallery' => $gallery,
            'galleryCategories'=> GalleryCategory::all(),
            'galleryPage' => true
        ]);
    }


    public function update(Request $request, Gallery $gallery)
    {
        $rules = [
            'title' => 'required|min:10|max:150',
            'image' => 'file|image|max:3072',
            'shoot_on' => 'required|date|before:' . now(),
            'description' => 'max:500'
        ];

        $validatedData = $request->validate($rules);

        if($request->file('image')) {
            Storage::delete($gallery->image);
            $validatedData['image'] = $request->file('image')->store('/uploads/galleries');
        }
        $validatedData['category_id'] = $request->category;

        Gallery::where('id', $gallery->id)->update($validatedData);
        return redirect('/dashboard/galleries')->with('success', 'Gallery updated successfully!');
    }


    public function show(Gallery $gallery)
    {
        return view('dashboard.gallery.show', [
            'gallery' => $gallery,
            'galleryPage' => true,
        ]);
    }


    public function destroy(Gallery $gallery)
    {
        Storage::delete($gallery->image);
        Gallery::destroy($gallery->id);
        return redirect('/dashboard/galleries')->with('success', 'Gallery has been deleted!');
    }
}
