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
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header border-bottom d-flex justify-content-between align-items-center">
                    <p class="card-title my-0">{{ $pageTitle }} <span class="badge bg-danger">{{ count($products) }}</span></p>
                    <div class="d-flex">
                        @if(auth('admin')->user()->can('create Products'))
                        <a href="{{ route('admin.product.create') }}" class="btn btn-success">
                            <i class="fas fa-plus"></i> Add Product
                        </a>
                        @endif
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered text-nowrap">
                            <thead>
                                <tr>
                                    <th>SL</th>
                                    <th>Photo</th>
                                    <th>Product Name</th>
                                    <th>Brand</th>
                                    <th>Size</th>
                                    <th>Price</th>
                                    <th>Discount</th>
                                    <th>Seller Price</th>
                                    <th>Customer Price</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($products as $key => $product)
                                <tr>
                                    <td>{{ $key+1 }}</td>
                                    <td>
                                        <img src="{{ $product->photo ? asset('upload/products/'.$product->photo) : asset('upload/no_image.jpg') }}"
                                             width="50" height="50" style="object-fit: cover;">
                                    </td>
                                    <td>{{ $product->product_name }}</td>
                                    <td>{{ $product->brand_name ?? 'N/A' }}</td>
                                    <td>{{ $product->size ?? 'N/A' }}</td>
                                    <td>{{ number_format($product->price,2) }}</td>
                                    <td>{{ $product->discount }}%</td>
                                    <td>{{ number_format($product->seller_price,2) }}</td>
                                    <td>{{ number_format($product->customer_price,2) }}</td>
                                    <td>
                                        @if($product->status)
                                            <span class="badge bg-success">Active</span>
                                        @else
                                            <span class="badge bg-danger">Inactive</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if(auth('admin')->user()->can('view Products'))
                                        <a href="{{ route('admin.product.show', $product->id) }}" class="btn btn-sm btn-success"><i class="fas fa-eye"></i></a>
                                        @endif
                                        @if(auth('admin')->user()->can('edit Products'))
                                        <a href="{{ route('admin.product.edit', $product->id) }}" class="btn btn-sm btn-primary"><i class="fas fa-edit"></i></a>
                                        @endif
                                        @if(auth('admin')->user()->can('delete Products'))
                                        <form action="{{ route('admin.product.delete', $product->id) }}" method="POST" style="display:inline;">
                                            @csrf @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')"><i class="fas fa-trash"></i></button>
                                        </form>
                                        @endif
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection