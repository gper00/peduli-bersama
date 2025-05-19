<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use App\Models\GalleryCategory;
use App\Models\gallery;
use Illuminate\Http\Request;

class GalleryCategoryController extends Controller
{
    public function index()
    {
        return view('dashboard.gallery-category.index', [
            'galleryCategories' => GalleryCategory::latest()->get(),
            'galleryPage' => true,
            'galleryCategoryPage' => true
        ]);
    }

    public function create()
    {
        return view('dashboard.gallery-category.create', [
            'galleryPage' => true,
            'galleryCategoryPage' => true
        ]);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|min:4|max:24|unique:gallery_categories'
        ]);
        GalleryCategory::create($validatedData);

        return redirect('/dashboard/gallery-categories')->with('success', 'New gallery category has created!');
    }

    public function edit(GalleryCategory $galleryCategory)
    {
        return view('dashboard.gallery-category.edit', [
            'galleryCategory' => $galleryCategory,
            'galleryPage' => true,
            'galleryCategoryPage' => true,
        ]);
    }

    public function update(Request $request, GalleryCategory $galleryCategory)
    {
        if($request->name === $galleryCategory->name)
        {
            $validatedData = $request->validate([
                'name' => 'required|min:4|max:24'
            ]);
        } else
        {
            $validatedData = $request->validate([
                'name' => 'required|min:4|max:24|unique:gallery_categories'
            ]);
        }
        GalleryCategory::where('id', $galleryCategory->id)->update($validatedData);

        return redirect('/dashboard/gallery-categories')->with('success', 'Gallery category has been updated!');
    }

    public function destroy(GalleryCategory $galleryCategory)
    {
        Gallery::where('category_id', $galleryCategory->id)->update(['category_id' => NULL]);
        GalleryCategory::destroy($galleryCategory->id);

        return redirect('/dashboard/gallery-categories')->with('success', 'Gallery category has been deleted!');
    }
}
