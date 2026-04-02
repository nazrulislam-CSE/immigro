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
                <div class="d-flex">
                    <a href="{{ route('admin.product.list') }}" class="btn btn-danger">Product List</a>
                </div>
            </div>
            <div class="card-body">
                <table class="table table-bordered">
                    <tr><th>Product Name</th><td>{{ $product->product_name }}</td></tr>
                    <tr><th>Photo</th><td><img src="{{ $product->photo ? asset('upload/products/'.$product->photo) : asset('upload/no_image.jpg') }}" width="100"></td></tr>
                    <tr><th>Brand</th><td>{{ $product->brand_name ?? 'N/A' }}</td></tr>
                    <tr><th>Size</th><td>{{ $product->size ?? 'N/A' }}</td></tr>
                    <tr><th>Price</th><td>{{ number_format($product->price,2) }}</td></tr>
                    <tr><th>Color</th><td>{{ $product->color ?? 'N/A' }}</td></tr>
                    <tr><th>Discount</th><td>{{ $product->discount }}%</td></tr>
                    <tr><th>Seller Price</th><td>{{ number_format($product->seller_price,2) }}</td></tr>
                    <tr><th>Customer Price</th><td>{{ number_format($product->customer_price,2) }}</td></tr>
                    <tr><th>Status</th><td>{!! $product->status ? '<span class="badge bg-success">Active</span>' : '<span class="badge bg-danger">Inactive</span>' !!}</td></tr>
                    <tr><th>Note</th><td>{{ $product->note ?? 'N/A' }}</td></tr>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection