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
                <form action="{{ route('admin.product.order.store') }}" method="post">
                    @csrf
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label>Product <span class="text-danger">*</span></label>
                            <select name="product_id" class="form-control" required>
                                <option value="">Select Product</option>
                                @foreach($products as $product)
                                    <option value="{{ $product->id }}" data-price="{{ $product->customer_price }}" {{ old('product_id') == $product->id ? 'selected' : '' }}>
                                        {{ $product->product_name }} ({{ $product->size }}, {{ $product->color }}) - {{ $product->customer_price }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label>Customer Price ($) <span class="text-danger">*</span></label>
                            <input type="number" step="0.01" name="customer_price" class="form-control" required value="{{ old('customer_price') }}">
                        </div>
                        <div class="form-group col-md-6">
                            <label>Quantity <span class="text-danger">*</span></label>
                            <input type="number" name="quantity" class="form-control" required min="1" value="{{ old('quantity',1) }}">
                        </div>
                        <div class="form-group col-md-6">
                            <label>Customer Name <span class="text-danger">*</span></label>
                            <input type="text" name="customer_name" class="form-control" required value="{{ old('customer_name') }}">
                        </div>
                        <div class="form-group col-md-6">
                            <label>Mobile Number <span class="text-danger">*</span></label>
                            <input type="text" name="mobile_number" class="form-control" required value="{{ old('mobile_number') }}">
                        </div>
                        <div class="form-group col-md-6">
                            <label>Shipping Cost ($)</label>
                            <input type="number" step="0.01" name="shipping_cost" class="form-control" value="{{ old('shipping_cost',0) }}">
                        </div>
                        <div class="form-group col-md-6">
                            <label>Advance Payment ($)</label>
                            <input type="number" step="0.01" name="advance_payment" class="form-control" value="{{ old('advance_payment',0) }}">
                        </div>
                        <div class="form-group col-md-6">
                            <label>Payment Method</label>
                            <input type="text" name="payment_method" class="form-control" placeholder="e.g., bKash, Nagad, Cash" value="{{ old('payment_method') }}">
                        </div>
                        <div class="form-group col-md-6">
                            <label>Thana</label>
                            <input type="text" name="thana" class="form-control" value="{{ old('thana') }}">
                        </div>
                        <div class="form-group col-md-6">
                            <label>District</label>
                            <input type="text" name="district" class="form-control" value="{{ old('district') }}">
                        </div>
                        <div class="form-group col-md-12">
                            <label>Shipping Address <span class="text-danger">*</span></label>
                            <textarea name="shipping_address" class="form-control" rows="2" required>{{ old('shipping_address') }}</textarea>
                        </div>
                        <div class="form-group col-md-6">
                            <label>Status</label>
                            <select name="status" class="form-control">
                                <option value="0" {{ old('status') == 0 ? 'selected' : '' }}>Pending</option>
                                <option value="1" {{ old('status') == 1 ? 'selected' : '' }}>Approved</option>
                                <option value="2" {{ old('status') == 2 ? 'selected' : '' }}>Paid</option>
                                <option value="3" {{ old('status') == 3 ? 'selected' : '' }}>Delivery</option>
                            </select>
                        </div>
                        <div class="form-group col-md-12">
                            <button type="submit" class="btn btn-primary">Save Order</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@push('admin')
<script>
    $(document).ready(function(){
        $('select[name="product_id"]').change(function(){
            let price = $(this).find(':selected').data('price');
            if(price) $('input[name="customer_price"]').val(price);
        });
    });
</script>
@endpush