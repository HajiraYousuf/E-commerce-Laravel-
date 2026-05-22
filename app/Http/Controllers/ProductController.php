<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\User;
use App\Notifications\ProductNotification;
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

        // upload image
        $imagePath = null;

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('products', 'public');
        }

        // create product
        $product = Product::create([
            'name'        => $request->name,
            'sku'         => $request->sku,
            'category'    => $request->category,
            'price'       => $request->price,
            'stock'       => $request->stock,
            'sold'        => 0, // make sure DB column is "sold"
            'description' => $request->description ?? '',
            'image'       => $imagePath,
        ]);

        // send notification to all admins
        $admins = User::where('role', 'admin')->get();

        foreach ($admins as $admin) {
            $admin->notify(new ProductNotification($product));
        }

        return redirect()
            ->route('products.index')
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

        // update image
        if ($request->hasFile('image')) {

            if ($product->image) {
                Storage::disk('public')->delete($product->image);
            }

            $data['image'] = $request->file('image')->store('products', 'public');
        }

        $product->update($data);

        return redirect()
            ->route('products.index')
            ->with('success', 'Product updated successfully');
    }

    // DELETE
    public function destroy(Product $product)
    {
        if ($product->image) {
            Storage::disk('public')->delete($product->image);
        }

        $product->delete();

        return redirect()
            ->route('products.index')
            ->with('success', 'Product deleted successfully');
    }
}