<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    public function index()
    {
        $pageTitle = 'Product List';
        $products = Product::latest()->get();
        return view('admin.product.index', compact('products', 'pageTitle'));
    }

    public function create()
    {
        $pageTitle = 'Add Product';
        return view('admin.product.create', compact('pageTitle'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'product_name'   => 'required|string|max:255',
            'photo'          => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'brand_name'     => 'nullable|string|max:255',
            'size'           => 'nullable|string|max:100',
            'price'          => 'nullable|numeric|min:0',
            'color'          => 'nullable|string|max:100',
            'discount'       => 'nullable|numeric|min:0|max:100',
            'seller_price'   => 'nullable|numeric|min:0',
            'customer_price' => 'nullable|numeric|min:0',
            'note'           => 'nullable|string',
            'status'         => 'nullable|boolean',
        ]);

        $product = new Product();

        if ($request->hasFile('photo')) {
            $file = $request->file('photo');
            $filename = date('YmdHi') . '_' . $file->getClientOriginalName();
            $file->move(public_path('upload/products'), $filename);
            $product->photo = $filename;
        }

        $product->product_name   = $request->product_name;
        $product->brand_name     = $request->brand_name;
        $product->size           = $request->size;
        $product->price          = $request->price ?? 0;
        $product->color          = $request->color;
        $product->discount       = $request->discount ?? 0;
        $product->seller_price   = $request->seller_price ?? 0;
        $product->customer_price = $request->customer_price ?? 0;
        $product->note           = $request->note;
        $product->status         = $request->status ?? 1;

        $product->save();

        flash()->addSuccess('Product created successfully.');
        return redirect()->route('admin.product.list');
    }

    public function show(string $id)
    {
        $pageTitle = 'Product Details';
        $product = Product::findOrFail($id);
        return view('admin.product.show', compact('product', 'pageTitle'));
    }

    public function edit(string $id)
    {
        $pageTitle = 'Edit Product';
        $product = Product::findOrFail($id);
        return view('admin.product.edit', compact('product', 'pageTitle'));
    }

    public function update(Request $request, string $id)
    {
        $product = Product::findOrFail($id);

        $request->validate([
            'product_name'   => 'required|string|max:255',
            'photo'          => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'brand_name'     => 'nullable|string|max:255',
            'size'           => 'nullable|string|max:100',
            'price'          => 'nullable|numeric|min:0',
            'color'          => 'nullable|string|max:100',
            'discount'       => 'nullable|numeric|min:0|max:100',
            'seller_price'   => 'nullable|numeric|min:0',
            'customer_price' => 'nullable|numeric|min:0',
            'note'           => 'nullable|string',
            'status'         => 'nullable|boolean',
        ]);

        if ($request->hasFile('photo')) {
            if ($product->photo && file_exists(public_path('upload/products/' . $product->photo))) {
                @unlink(public_path('upload/products/' . $product->photo));
            }
            $file = $request->file('photo');
            $filename = date('YmdHi') . '_' . $file->getClientOriginalName();
            $file->move(public_path('upload/products'), $filename);
            $product->photo = $filename;
        }

        $product->product_name   = $request->product_name;
        $product->brand_name     = $request->brand_name;
        $product->size           = $request->size;
        $product->price          = $request->price ?? 0;
        $product->color          = $request->color;
        $product->discount       = $request->discount ?? 0;
        $product->seller_price   = $request->seller_price ?? 0;
        $product->customer_price = $request->customer_price ?? 0;
        $product->note           = $request->note;
        $product->status         = $request->status ?? 1;

        $product->save();

        flash()->addSuccess('Product updated successfully.');
        return redirect()->route('admin.product.list');
    }

    public function destroy(string $id)
    {
        $product = Product::findOrFail($id);
        if ($product->photo && file_exists(public_path('upload/products/' . $product->photo))) {
            @unlink(public_path('upload/products/' . $product->photo));
        }
        $product->delete();

        flash()->addError('Product deleted successfully.');
        return redirect()->route('admin.product.list');
    }
}