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
                    <a href="{{ route('admin.software.sale.list') }}" class="btn btn-danger me-2">
                        <i class="fas fa-list d-inline"></i> Software Sale List
                    </a>
                </div>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.software.sale.update', $software->id) }}" method="post">
                    @csrf
                    @method('PUT')

                    <div class="row">
                        <!-- Software Name -->
                        <div class="form-group col-md-6">
                            <label for="software_name">Software Name <span class="text-danger">*</span></label>
                            <input type="text" name="software_name" id="software_name" class="form-control"
                                   placeholder="e.g., CRM Pro" value="{{ old('software_name', $software->software_name) }}" required>
                            @error('software_name') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>

                        <!-- Demo Link -->
                        <div class="form-group col-md-6">
                            <label for="demo_link">Demo Link</label>
                            <input type="url" name="demo_link" id="demo_link" class="form-control"
                                   placeholder="https://example.com/demo" value="{{ old('demo_link', $software->demo_link) }}">
                            @error('demo_link') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>

                        <!-- Price -->
                        <div class="form-group col-md-6">
                            <label for="price">Price</label>
                            <input type="number" step="0.01" name="price" id="price" class="form-control"
                                   placeholder="0.00" value="{{ old('price', $software->price) }}">
                            @error('price') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>

                        <!-- Discount (%) -->
                        <div class="form-group col-md-6">
                            <label for="discount">Discount (%)</label>
                            <input type="number" step="0.01" name="discount" id="discount" class="form-control"
                                   placeholder="0" value="{{ old('discount', $software->discount) }}">
                            @error('discount') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>

                        <!-- Sell Commission -->
                        <div class="form-group col-md-6">
                            <label for="sell_comission">Sell Commission</label>
                            <input type="number" step="0.01" name="sell_comission" id="sell_comission" class="form-control"
                                   placeholder="0.00" value="{{ old('sell_comission', $software->sell_comission) }}">
                            @error('sell_comission') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>

                        <!-- Monthly Charge -->
                        <div class="form-group col-md-6">
                            <label for="monthly_charge">Monthly Charge</label>
                            <input type="number" step="0.01" name="monthly_charge" id="monthly_charge" class="form-control"
                                   placeholder="0.00" value="{{ old('monthly_charge', $software->monthly_charge) }}">
                            @error('monthly_charge') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>

                        <!-- Facilities -->
                        <div class="form-group col-md-12">
                            <label for="facilities">Facilities / Features</label>
                            <textarea name="facilities" id="facilities" class="form-control summernote">{{ old('facilities', $software->facilities) }}</textarea>
                        </div>

                        <!-- Status -->
                        <div class="form-group col-md-6">
                            <label for="status">Status</label>
                            <select name="status" id="status" class="form-control">
                                <option value="1" {{ old('status', $software->status) == 1 ? 'selected' : '' }}>Active</option>
                                <option value="0" {{ old('status', $software->status) == 0 ? 'selected' : '' }}>Inactive</option>
                            </select>
                        </div>

                        <div class="form-group col-md-12">
                            <button type="submit" class="btn btn-primary">Update Software</button>
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
        $('#facilities').summernote({
            placeholder: 'Enter software facilities, features, etc...',
            height: 200
        });
    });
</script>
@endpush