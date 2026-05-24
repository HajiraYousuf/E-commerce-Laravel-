<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use App\Notifications\ProductNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function export(Request $request)
{
    $query = Product::with('category');

    if ($request->filled('search')) {
        $query->where('name', 'like', '%' . $request->search . '%');
    }

    if ($request->filled('category')) {
        $query->whereHas('category', fn($q) =>
            $q->where('name', $request->category)
        );
    }

    if ($request->filled('status')) {

        if ($request->status === 'active') {
            $query->where('stock', '>', 10);
        }

        if ($request->status === 'low') {
            $query->whereBetween('stock', [1, 9]);
        }

        if ($request->status === 'out') {
            $query->where('stock', 0);
        }
    }

    $products = $query->get();

    return response()->streamDownload(function () use ($products) {
        $file = fopen('php://output', 'w');

        fputcsv($file, ['Name', 'SKU', 'Price', 'Stock']);

        foreach ($products as $p) {
            fputcsv($file, [
                $p->name,
                $p->sku,
                $p->price,
                $p->stock,
            ]);
        }

        fclose($file);
    }, 'products.csv');
}
    // INDEX
    public function index(Request $request)
    {
        $products = Product::latest()->get();
        $categories = Category::all();

        $query = Product::with('category');

        // 🔍 SEARCH
        if ($request->filled('search')) {
            $query->where(function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->search . '%')
                  ->orWhere('sku', 'like', '%' . $request->search . '%');
            });
        }

        // 📦 CATEGORY FILTER
        if ($request->filled('category')) {
            $query->where('category_id', $request->category);
        }

        // 📊 STATUS FILTER
        if ($request->filled('status')) {

            switch ($request->status) {
                case 'active':
                    $query->where('stock', '>', 10);
                    break;

                case 'low':
                    $query->whereBetween('stock', [1, 10]);
                    break;

                case 'out':
                    $query->where('stock', 0);
                    break;
            }
        }

        $products = $query->latest()->paginate(10);

        return view('admin.products.index', compact('products', 'categories'));
    }

    // CREATE
    public function create()
    {    
        $categories = Category::all();

        return view('admin.products.create', compact('categories'));
    }

    // STORE
    public function store(Request $request)
    {
        $request->validate([
            'name'        => 'required|string|max:255',
            'sku'         => 'required|string|unique:products,sku',
            'category_id' => 'required|exists:categories,id',            'price'       => 'required|numeric',
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
            'category_id' => $request->category_id, // ✅ FIXED
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
        $categories = Category::all();

        return view('admin.products.edit', compact('product', 'categories'));
    }

    // UPDATE
   public function update(Request $request, Product $product)
    {
        $request->validate([
            'name'        => 'required|string|max:255',
            'sku'         => 'required|string|unique:products,sku,' . $product->id,
            'category_id' => 'required|exists:categories,id',
            'price'       => 'required|numeric',
            'stock'       => 'required|integer',
            'description' => 'nullable|string',
            'image'       => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $data = [
            'name'        => $request->name,
            'sku'         => $request->sku,
            'category_id' => $request->category_id,
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