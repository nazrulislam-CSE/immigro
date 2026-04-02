<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ProductOrder;
use App\Models\Product;

class ProductOrderController extends Controller
{
    public function index()
    {
        $pageTitle = 'Product Orders';
        $orders = ProductOrder::with('product')->latest()->get();
        return view('admin.product.order.index', compact('orders', 'pageTitle'));
    }

    public function create()
    {
        $pageTitle = 'Create Order';
        $products = Product::where('status', 1)->get();
        return view('admin.product.order.create', compact('pageTitle', 'products'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'product_id'        => 'required|exists:products,id',
            'customer_price'    => 'required|numeric|min:0',
            'quantity'          => 'required|integer|min:1',
            'customer_name'     => 'required|string|max:255',
            'mobile_number'     => 'required|string|max:20',
            'shipping_cost'     => 'nullable|numeric|min:0',
            'advance_payment'   => 'nullable|numeric|min:0',
            'payment_method'    => 'nullable|string|max:100',
            'shipping_address'  => 'required|string',
            'thana'             => 'nullable|string|max:100',
            'district'          => 'nullable|string|max:100',
            'status'            => 'nullable|in:0,1,2,3',
        ]);

        $order = new ProductOrder();
        $order->product_id      = $request->product_id;
        $order->customer_price  = $request->customer_price;
        $order->quantity        = $request->quantity;
        $order->customer_name   = $request->customer_name;
        $order->mobile_number   = $request->mobile_number;
        $order->shipping_cost   = $request->shipping_cost ?? 0;
        $order->advance_payment = $request->advance_payment ?? 0;
        $order->payment_method  = $request->payment_method;
        $order->shipping_address = $request->shipping_address;
        $order->thana           = $request->thana;
        $order->district        = $request->district;
        $order->status          = $request->status ?? 0;
        $order->save();

        flash()->addSuccess('Order created successfully.');
        return redirect()->route('admin.product.order.list');
    }

    public function show(string $id)
    {
        $pageTitle = 'Order Details';
        $order = ProductOrder::with('product')->findOrFail($id);
        return view('admin.product.order.show', compact('order', 'pageTitle'));
    }

    public function edit(string $id)
    {
        $pageTitle = 'Edit Order';
        $order = ProductOrder::findOrFail($id);
        $products = Product::where('status', 1)->get();
        return view('admin.product.order.edit', compact('order', 'products', 'pageTitle'));
    }

    public function update(Request $request, string $id)
    {
        $order = ProductOrder::findOrFail($id);

        $request->validate([
            'product_id'        => 'required|exists:products,id',
            'customer_price'    => 'required|numeric|min:0',
            'quantity'          => 'required|integer|min:1',
            'customer_name'     => 'required|string|max:255',
            'mobile_number'     => 'required|string|max:20',
            'shipping_cost'     => 'nullable|numeric|min:0',
            'advance_payment'   => 'nullable|numeric|min:0',
            'payment_method'    => 'nullable|string|max:100',
            'shipping_address'  => 'required|string',
            'thana'             => 'nullable|string|max:100',
            'district'          => 'nullable|string|max:100',
            'status'            => 'nullable|in:0,1,2,3',
        ]);

        $order->product_id      = $request->product_id;
        $order->customer_price  = $request->customer_price;
        $order->quantity        = $request->quantity;
        $order->customer_name   = $request->customer_name;
        $order->mobile_number   = $request->mobile_number;
        $order->shipping_cost   = $request->shipping_cost ?? 0;
        $order->advance_payment = $request->advance_payment ?? 0;
        $order->payment_method  = $request->payment_method;
        $order->shipping_address = $request->shipping_address;
        $order->thana           = $request->thana;
        $order->district        = $request->district;
        $order->status          = $request->status ?? 0;
        $order->save();

        flash()->addSuccess('Order updated successfully.');
        return redirect()->route('admin.product.order.list');
    }

    public function destroy(string $id)
    {
        $order = ProductOrder::findOrFail($id);
        $order->delete();

        flash()->addError('Order deleted successfully.');
        return redirect()->route('admin.product.order.list');
    }

    public function voucher($id)
    {
        $order = ProductOrder::with('product')->findOrFail($id);
        return view('admin.product.order.voucher', compact('order'));
    }
}