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
                    <a href="{{ route('admin.visa.index') }}" class="btn btn-danger me-2">
                        <i class="fas fa-list d-inline"></i> Visa List
                    </a>
                </div>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.visa.store') }}" method="post" enctype="multipart/form-data">
                    @csrf

                    <div class="row">
                        <!-- Country Name -->
                        <div class="form-group col-md-6">
                            <label for="country_name">Country Name <span class="text-danger">*</span></label>
                            <input type="text" name="country_name" id="country_name" class="form-control"
                                   placeholder="e.g., United States" value="{{ old('country_name') }}" required>
                            @error('country_name') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>

                        <!-- Slug (auto-generated) -->
                        <div class="form-group col-md-6">
                            <label for="slug">Slug (auto-generated)</label>
                            <input type="text" name="slug" id="slug" class="form-control"
                                   placeholder="auto-generated from country name" value="{{ old('slug') }}" readonly>
                            @error('slug') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>

                        <!-- Flag Image -->
                        <div class="form-group col-md-6">
                            <label for="flug">Flag Image</label>
                            <input type="file" name="flug" id="flug" class="form-control" accept="image/*"
                                   placeholder="Upload flag image">
                            @error('flug') <span class="text-danger">{{ $message }}</span> @enderror
                            <img id="showImage" src="{{ asset('upload/no_image.jpg') }}" alt="Flag Preview" width="80" class="mt-2">
                        </div>

                        <!-- Visa Category -->
                        <div class="form-group col-md-6">
                            <label for="visa_category">Visa Category</label>
                            <input type="text" name="visa_category" id="visa_category" class="form-control"
                                   placeholder="e.g., Tourist, Business, Student" value="{{ old('visa_category') }}">
                        </div>

                        <!-- Work Category -->
                        <div class="form-group col-md-6">
                            <label for="work_category">Work Category</label>
                            <input type="text" name="work_category" id="work_category" class="form-control"
                                   placeholder="e.g., IT, Healthcare, Construction" value="{{ old('work_category') }}">
                        </div>

                        <!-- Company Contact -->
                        <div class="form-group col-md-6">
                            <label for="company_contact">Company Contact</label>
                            <input type="text" name="company_contact" id="company_contact" class="form-control"
                                   placeholder="Phone/Email of company" value="{{ old('company_contact') }}">
                        </div>

                        <!-- Processing Time -->
                        <div class="form-group col-md-6">
                            <label for="processing_time">Processing Time</label>
                            <input type="text" name="processing_time" id="processing_time" class="form-control"
                                   placeholder="e.g., 5-7 business days" value="{{ old('processing_time') }}">
                        </div>

                        <!-- Apply Fee -->
                        <div class="form-group col-md-6">
                            <label for="apply_fee">Apply Fee</label>
                            <input type="number" step="0.01" name="apply_fee" id="apply_fee" class="form-control"
                                   placeholder="0.00" value="{{ old('apply_fee', 0) }}">
                        </div>

                        <!-- Medical Fee -->
                        <div class="form-group col-md-6">
                            <label for="medical_fee">Medical Fee</label>
                            <input type="number" step="0.01" name="medical_fee" id="medical_fee" class="form-control"
                                   placeholder="0.00" value="{{ old('medical_fee', 0) }}">
                        </div>

                        <!-- Agent Rate -->
                        <div class="form-group col-md-6">
                            <label for="agent_rate">Agent Rate</label>
                            <input type="number" step="0.01" name="agent_rate" id="agent_rate" class="form-control"
                                   placeholder="0.00" value="{{ old('agent_rate', 0) }}">
                        </div>

                        <!-- Customer Rate -->
                        <div class="form-group col-md-6">
                            <label for="customer_rate">Customer Rate</label>
                            <input type="number" step="0.01" name="customer_rate" id="customer_rate" class="form-control"
                                   placeholder="0.00" value="{{ old('customer_rate', 0) }}">
                        </div>

                        <!-- Advance Payment -->
                        <div class="form-group col-md-6">
                            <label for="advance_payment">Advance Payment</label>
                            <input type="number" step="0.01" name="advance_payment" id="advance_payment" class="form-control"
                                   placeholder="0.00" value="{{ old('advance_payment', 0) }}">
                        </div>

                        <!-- After Visa Payment -->
                        <div class="form-group col-md-6">
                            <label for="after_visa_payment">After Visa Payment</label>
                            <input type="number" step="0.01" name="after_visa_payment" id="after_visa_payment" class="form-control"
                                   placeholder="0.00" value="{{ old('after_visa_payment', 0) }}">
                        </div>

                        <!-- Manpower Ticket -->
                        <div class="form-group col-md-6">
                            <label for="manpower_ticket">Manpower Ticket</label>
                            <input type="number" step="0.01" name="manpower_ticket" id="manpower_ticket" class="form-control"
                                   placeholder="0.00" value="{{ old('manpower_ticket', 0) }}">
                        </div>

                        <!-- Status -->
                        <div class="form-group col-md-6">
                            <label for="status">Status</label>
                            <select name="status" id="status" class="form-control">
                                <option value="1" {{ old('status') == 1 ? 'selected' : '' }}>Active</option>
                                <option value="0" {{ old('status') == 0 ? 'selected' : '' }}>Inactive</option>
                            </select>
                        </div>

                        <!-- Documents (Summernote) -->
                        <div class="form-group col-md-12">
                            <label for="documents">Documents</label>
                            <textarea name="documents" id="documents" class="form-control summernote"
                                      placeholder="Enter required documents details...">{{ old('documents') }}</textarea>
                        </div>

                        <div class="form-group col-md-12">
                            <button type="submit" class="btn btn-primary">Save Visa</button>
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
        // Auto-generate slug from country name
        $('#country_name').on('keyup', function() {
            let country = $(this).val();
            let slug = country.toLowerCase()
                .replace(/[^\w\s-]/g, '')   // remove special characters
                .replace(/\s+/g, '-')        // replace spaces with hyphens
                .replace(/--+/g, '-')        // remove multiple hyphens
                .trim();
            $('#slug').val(slug);
        });

        // Image preview
        $('#flug').change(function(e){
            var reader = new FileReader();
            reader.onload = function(e){
                $('#showImage').attr('src', e.target.result);
            }
            reader.readAsDataURL(e.target.files[0]);
        });

        // Summernote for documents
        $('#documents').summernote({
            placeholder: 'Enter required documents details...',
            height: 200
        });
    });
</script>
@endpush