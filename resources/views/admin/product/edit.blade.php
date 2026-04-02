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
                <form action="{{ route('admin.product.update', $product->id) }}" method="post" enctype="multipart/form-data">
                    @csrf @method('PUT')
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label>Product Name <span class="text-danger">*</span></label>
                            <input type="text" name="product_name" class="form-control" required value="{{ old('product_name', $product->product_name) }}">
                        </div>
                        <div class="form-group col-md-6">
                            <label>Photo</label>
                            <input type="file" name="photo" class="form-control" accept="image/*">
                            <img id="preview" src="{{ $product->photo ? asset('upload/products/'.$product->photo) : asset('upload/no_image.jpg') }}" width="80" class="mt-2">
                        </div>
                        <div class="form-group col-md-6">
                            <label>Brand Name</label>
                            <input type="text" name="brand_name" class="form-control" value="{{ old('brand_name', $product->brand_name) }}">
                        </div>
                        <div class="form-group col-md-6">
                            <label>Size</label>
                            <input type="text" name="size" class="form-control" value="{{ old('size', $product->size) }}">
                        </div>
                        <div class="form-group col-md-6">
                            <label>Price ($)</label>
                            <input type="number" step="0.01" name="price" class="form-control" value="{{ old('price', $product->price) }}">
                        </div>
                        <div class="form-group col-md-6">
                            <label>Color</label>
                            <input type="text" name="color" class="form-control" value="{{ old('color', $product->color) }}">
                        </div>
                        <div class="form-group col-md-6">
                            <label>Discount (%)</label>
                            <input type="number" step="0.01" name="discount" class="form-control" value="{{ old('discount', $product->discount) }}">
                        </div>
                        <div class="form-group col-md-6">
                            <label>Seller Price ($)</label>
                            <input type="number" step="0.01" name="seller_price" class="form-control" value="{{ old('seller_price', $product->seller_price) }}">
                        </div>
                        <div class="form-group col-md-6">
                            <label>Customer Price ($)</label>
                            <input type="number" step="0.01" name="customer_price" class="form-control" value="{{ old('customer_price', $product->customer_price) }}">
                        </div>
                        <div class="form-group col-md-6">
                            <label>Status</label>
                            <select name="status" class="form-control">
                                <option value="1" {{ old('status', $product->status) == 1 ? 'selected' : '' }}>Active</option>
                                <option value="0" {{ old('status', $product->status) == 0 ? 'selected' : '' }}>Inactive</option>
                            </select>
                        </div>
                        <div class="form-group col-md-12">
                            <label>Note</label>
                            <textarea name="note" class="form-control" rows="3">{{ old('note', $product->note) }}</textarea>
                        </div>
                        <div class="form-group col-md-12">
                            <button type="submit" class="btn btn-primary">Update Product</button>
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
    $(document).ready(function() {
        $('input[name="photo"]').change(function(e) {
            let reader = new FileReader();
            reader.onload = function(e) { $('#preview').attr('src', e.target.result); }
            reader.readAsDataURL(e.target.files[0]);
        });
    });
</script>
@endpush