<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    /**
     * Display a listing of the categories.
     */
    public function index()
    {
        $categories = Category::orderBy('sort_order')->paginate(10);
        
        return view('dashboard.category.index', compact('categories'));
    }

    /**
     * Show the form for creating a new category.
     */
    public function create()
    {
        return view('dashboard.category.create');
    }

    /**
     * Store a newly created category in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255|unique:categories',
            'description' => 'nullable|string',
            'icon' => 'nullable|string|max:50',
            'color' => 'nullable|string|max:20',
            'is_active' => 'boolean',
            'sort_order' => 'nullable|integer',
        ]);
        
        // Generate slug from name
        $validatedData['slug'] = Str::slug($request->name);
        
        // Set default values
        $validatedData['is_active'] = $request->has('is_active') ? 1 : 0;
        $validatedData['sort_order'] = $request->sort_order ?? 0;
        
        Category::create($validatedData);
        
        return redirect()->route('dashboard.categories.index')
            ->with('success', 'Kategori berhasil dibuat!');
    }

    /**
     * Display the specified category.
     */
    public function show(Category $category)
    {
        return view('dashboard.category.show', compact('category'));
    }

    /**
     * Show the form for editing the specified category.
     */
    public function edit(Category $category)
    {
        return view('dashboard.category.edit', compact('category'));
    }

    /**
     * Update the specified category in storage.
     */
    public function update(Request $request, Category $category)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255|unique:categories,name,' . $category->id,
            'description' => 'nullable|string',
            'icon' => 'nullable|string|max:50',
            'color' => 'nullable|string|max:20',
            'is_active' => 'boolean',
            'sort_order' => 'nullable|integer',
        ]);
        
        // Update slug only if name has changed
        if ($request->name != $category->name) {
            $validatedData['slug'] = Str::slug($request->name);
        }
        
        // Set default values
        $validatedData['is_active'] = $request->has('is_active') ? 1 : 0;
        $validatedData['sort_order'] = $request->sort_order ?? 0;
        
        $category->update($validatedData);
        
        return redirect()->route('dashboard.categories.index')
            ->with('success', 'Kategori berhasil diperbarui!');
    }

    /**
     * Remove the specified category from storage.
     */
    public function destroy(Category $category)
    {
        // Check if category has campaigns
        $campaignCount = $category->campaigns()->count();
        
        if ($campaignCount > 0) {
            return redirect()->route('dashboard.categories.index')
                ->with('error', 'Kategori tidak dapat dihapus karena masih memiliki ' . $campaignCount . ' campaign terkait.');
        }
        
        $category->delete();
        
        return redirect()->route('dashboard.categories.index')
            ->with('success', 'Kategori berhasil dihapus!');
    }
}
