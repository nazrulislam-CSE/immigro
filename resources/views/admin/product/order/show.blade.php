@extends('layouts.admin.app', ['pageTitle' => $pageTitle])

@section('content')
<div class="breadcrumb-header justify-content-between">
    <div class="d-flex align-items-center">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item active" aria-current="page">{{ $pageTitle ?? 'Dashboard' }}</li>
                <li class="breadcrumb-item"><a href="javascript:void(0);">Dashboard</a></li>
            </ol>
        </nav>
    </div>
</div>

<div class="main-content-body">
    <div class="row row-sm">
        <div class="card">
            <div class="card-header border-bottom d-flex justify-content-between align-items-center">
                <p class="card-title my-0">{{ $pageTitle }}</p>
                <a href="{{ route('admin.product.order.list') }}" class="btn btn-danger">Order List</a>
            </div>
            <div class="card-body">
                <table class="table table-bordered">
                    <tr><th>Order ID</th><td>{{ $order->id }}</td></tr>
                    <tr><th>Product</th><td>{{ $order->product->product_name ?? 'N/A' }} ({{ $order->product->size ?? '' }}, {{ $order->product->color ?? '' }})</td></tr>
                    <tr><th>Customer Price</th><td>${{ number_format($order->customer_price,2) }}</td></tr>
                    <tr><th>Quantity</th><td>{{ $order->quantity }}</td></tr>
                    <tr><th>Total (Subtotal)</th><td>{{ number_format($order->customer_price * $order->quantity,2) }}</td></tr>
                    <tr><th>Shipping Cost</th><td>{{ number_format($order->shipping_cost,2) }}</td></tr>
                    <tr><th>Advance Payment</th><td>{{ number_format($order->advance_payment,2) }}</td></tr>
                    <tr><th>Due / Total</th><td>{{ number_format($order->total_price,2) }}</td></tr>
                    <tr><th>Customer Name</th><td>{{ $order->customer_name }}</td></tr>
                    <tr><th>Mobile Number</th><td>{{ $order->mobile_number }}</td></tr>
                    <tr><th>Payment Method</th><td>{{ $order->payment_method ?? 'N/A' }}</td></tr>
                    <tr><th>Thana</th><td>{{ $order->thana ?? 'N/A' }}</td></tr>
                    <tr><th>District</th><td>{{ $order->district ?? 'N/A' }}</td></tr>
                    <tr><th>Shipping Address</th><td>{{ $order->shipping_address }}</td></tr>
                    <tr><th>Status</th><td>{!! $order->status_badge !!}</td></tr>
                    <tr><th>Created At</th><td>{{ $order->created_at->format('d M Y h:i A') }}</td></tr>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection