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
                    <p class="card-title my-0">{{ $pageTitle }} <span class="badge bg-danger">{{ count($orders) }}</span></p>
                    <a href="{{ route('admin.product.order.create') }}" class="btn btn-success">
                        <i class="fas fa-plus"></i> New Order
                    </a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered text-nowrap">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Product</th>
                                    <th>Customer</th>
                                    <th>Mobile</th>
                                    <th>Qty</th>
                                    <th>Unit Price</th>
                                    <th>Total</th>
                                    <th>Advance</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($orders as $order)
                                <tr>
                                    <td>{{ $order->id }}</td>
                                    <td>{{ $order->product->product_name ?? 'N/A' }} ({{ $order->product->size ?? '' }}, {{ $order->product->color ?? '' }})</td>
                                    <td>{{ $order->customer_name }}</td>
                                    <td>{{ $order->mobile_number }}</td>
                                    <td>{{ $order->quantity }}</td>
                                    <td>{{ number_format($order->customer_price,2) }}</td>
                                    <td>{{ number_format($order->total_price,2) }}</td>
                                    <td>{{ number_format($order->advance_payment,2) }}</td>
                                    <td>{!! $order->status_badge !!}</td>
                                    <td>
                                        <a href="{{ route('admin.product.order.show', $order->id) }}" class="btn btn-sm btn-success"><i class="fas fa-eye"></i></a>
                                        <a href="{{ route('admin.product.order.edit', $order->id) }}" class="btn btn-sm btn-primary"><i class="fas fa-edit"></i></a>
                                        <a href="{{ route('admin.product.order.delete', $order->id) }}" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')"><i class="fas fa-trash"></i></a>
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