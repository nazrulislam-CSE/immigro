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
                    <a href="{{ route('admin.book.sale.list') }}" class="btn btn-danger me-2">
                        <i class="fas fa-list d-inline"></i> Book List
                    </a>
                </div>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.book.sale.store') }}" method="post" enctype="multipart/form-data">
                    @csrf

                    <div class="row">
                        <!-- Book Name -->
                        <div class="form-group col-md-6">
                            <label for="book_name">Book Name <span class="text-danger">*</span></label>
                            <input type="text" name="book_name" id="book_name" class="form-control"
                                   placeholder="e.g., The Great Gatsby" value="{{ old('book_name') }}" required>
                            @error('book_name') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>

                        <!-- Writer Name -->
                        <div class="form-group col-md-6">
                            <label for="writer_name">Writer Name</label>
                            <input type="text" name="writer_name" id="writer_name" class="form-control"
                                   placeholder="e.g., F. Scott Fitzgerald" value="{{ old('writer_name') }}">
                        </div>

                        <!-- Photo -->
                        <div class="form-group col-md-6">
                            <label for="photo">Book Cover Photo</label>
                            <input type="file" name="photo" id="photo" class="form-control" accept="image/*">
                            @error('photo') <span class="text-danger">{{ $message }}</span> @enderror
                            <img id="showPhoto" src="{{ asset('upload/no_image.jpg') }}" width="80" class="mt-2">
                        </div>

                        <!-- Pages -->
                        <div class="form-group col-md-6">
                            <label for="page">Number of Pages</label>
                            <input type="text" name="page" id="page" class="form-control"
                                   placeholder="e.g., 320" value="{{ old('page') }}">
                        </div>

                        <!-- Price -->
                        <div class="form-group col-md-6">
                            <label for="price">Price ($)</label>
                            <input type="number" step="0.01" name="price" id="price" class="form-control"
                                   placeholder="0.00" value="{{ old('price', 0) }}">
                        </div>

                        <!-- Discount (%) -->
                        <div class="form-group col-md-6">
                            <label for="discount">Discount (%)</label>
                            <input type="number" step="0.01" name="discount" id="discount" class="form-control"
                                   placeholder="0" value="{{ old('discount', 0) }}">
                        </div>

                        <!-- Seller Price -->
                        <div class="form-group col-md-6">
                            <label for="seller_price">Seller Price ($)</label>
                            <input type="number" step="0.01" name="seller_price" id="seller_price" class="form-control"
                                   placeholder="0.00" value="{{ old('seller_price', 0) }}">
                        </div>

                        <!-- Customer Price -->
                        <div class="form-group col-md-6">
                            <label for="customer_price">Customer Price ($)</label>
                            <input type="number" step="0.01" name="customer_price" id="customer_price" class="form-control"
                                   placeholder="0.00" value="{{ old('customer_price', 0) }}">
                        </div>

                        <!-- Status -->
                        <div class="form-group col-md-6">
                            <label for="status">Status</label>
                            <select name="status" id="status" class="form-control">
                                <option value="0" {{ old('status') == 0 ? 'selected' : '' }}>Pending</option>
                                <option value="1" {{ old('status') == 1 ? 'selected' : '' }}>Approved</option>
                                <option value="2" {{ old('status') == 2 ? 'selected' : '' }}>Paid</option>
                                <option value="3" {{ old('status') == 3 ? 'selected' : '' }}>Delivery</option>
                            </select>
                        </div>

                        <div class="form-group col-md-12">
                            <button type="submit" class="btn btn-primary">Save Book</button>
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
        $('#photo').change(function(e){
            var reader = new FileReader();
            reader.onload = function(e){
                $('#showPhoto').attr('src', e.target.result);
            }
            reader.readAsDataURL(e.target.files[0]);
        });
    });
</script>
@endpush