<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    // INDEX
    public function index()
    {
        $products = Product::latest()->get();
        return view('admin.products.index', compact('products'));
    }

    // CREATE
    public function create()
    {
        return view('admin.products.create');
    }

    // STORE
    public function store(Request $request)
    {
        $request->validate([
            'name'        => 'required|string|max:255',
            'sku'         => 'required|string|unique:products,sku',
            'category'    => 'required|string',
            'price'       => 'required|numeric',
            'stock'       => 'required|integer',
            'description' => 'nullable|string',
            'image'       => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $imagePath = null;

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('products', 'public');
        }

        Product::create([
            'name'        => $request->name,
            'sku'         => $request->sku,
            'category'    => $request->category,
            'price'       => $request->price,
            'stock'       => $request->stock,
            'sales'       => 0,
            'description' => $request->description ?? '',
            'image'       => $imagePath,
        ]);

        return redirect()->route('products.index')
            ->with('success', 'Product created successfully');
    }

    // SHOW
    public function show(Product $product)
    {
        return view('admin.products.show', compact('product'));
    }

    // EDIT
    public function edit(Product $product)
    {
        return view('admin.products.edit', compact('product'));
    }

    // UPDATE
    public function update(Request $request, Product $product)
    {
        $request->validate([
            'name'        => 'required|string|max:255',
            'sku'         => 'required|string',
            'category'    => 'required|string',
            'price'       => 'required|numeric',
            'stock'       => 'required|integer',
            'description' => 'nullable|string',
            'image'       => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $data = [
            'name'        => $request->name,
            'sku'         => $request->sku,
            'category'    => $request->category,
            'price'       => $request->price,
            'stock'       => $request->stock,
            'description' => $request->description,
        ];

        if ($request->hasFile('image')) {

            // delete old image
            if ($product->image) {
                Storage::disk('public')->delete($product->image);
            }

            // upload new image
            $data['image'] = $request->file('image')->store('products', 'public');
        }

        $product->update($data);

        return redirect()->route('products.index')
            ->with('success', 'Product updated successfully');
    }

    // DELETE
    public function destroy(Product $product)
    {
        if ($product->image) {
            Storage::disk('public')->delete($product->image);
        }

        $product->delete();

        return redirect()->route('products.index')
            ->with('success', 'Product deleted successfully');
    }
}