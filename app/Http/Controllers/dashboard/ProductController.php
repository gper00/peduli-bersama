<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function index()
    {
        return view('dashboard.product.index', [
            'products' => Product::latest('created_at')->get(),
            'productPage' => true
        ]);
    }


    public function create()
    {
        return view('dashboard.product.create', [
            'productPage' => true
        ]);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|min:4|max:75',
            'image' => 'required|file|image|max:3072',
            'price' => 'required|min:4|max:9',
            'seller_wa' => 'required|min:10|max:14',
            'description' => 'required'
        ]);
        $validatedData['image'] = $request->file('image')->store('/uploads/products');
        Product::create($validatedData);

        return redirect('/dashboard/products')->with('success', 'New product created successfully');
    }


    public function edit(Product $product)
    {
        return view('dashboard.product.edit', [
            'product' => $product,
            'productPage' => true
        ]);
    }


    public function update(Request $request, Product $product)
    {
        $rules = [
            'name' => 'required|min:4|max:75',
            'image' => 'file|image|max:3072',
            'price' => 'required|min:4|max:9',
            'seller_wa' => 'required|min:10|max:14',
            'description' => 'required'
        ];
        $validatedData = $request->validate($rules);
        if($request->file('image')) {
            Storage::delete($product->image);
            $validatedData['image'] = $request->file('image')->store('/uploads/products');
        }
        Product::where('id', $product->id)->update($validatedData);

        return redirect('/dashboard/products')->with('success', 'Product updated successfully!');
    }


    public function show(Product $product)
    {
        return view('dashboard.product.show', [
            'product' => $product,
            'productPage' => true
        ]);
    }


    public function destroy(Product $product)
    {
        Storage::delete($product->image);
        Product::destroy($product->id);

        return redirect('/dashboard/products')->with('success', 'Product has been deleted');
    }
}
