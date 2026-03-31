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
                    <a href="{{ route('admin.medical.visa.index') }}" class="btn btn-danger me-2">
                        <i class="fas fa-list d-inline"></i> Medical Visa List
                    </a>
                </div>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.medical.visa.update', $medicalVisa->id) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="row">
                        <!-- Country Name -->
                        <div class="form-group col-md-6">
                            <label for="country_name">Country Name <span class="text-danger">*</span></label>
                            <input type="text" name="country_name" id="country_name" class="form-control"
                                   placeholder="e.g., Germany" value="{{ old('country_name', $medicalVisa->country_name) }}" required>
                            @error('country_name') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>

                        <!-- Flag Image -->
                        <div class="form-group col-md-6">
                            <label for="flug">Flag Image</label>
                            <input type="file" name="flug" id="flug" class="form-control" accept="image/*">
                            @error('flug') <span class="text-danger">{{ $message }}</span> @enderror
                            <img id="showFlag" src="{{ $medicalVisa->flug ? asset('upload/medical_visa/'.$medicalVisa->flug) : asset('upload/no_image.jpg') }}" width="80" class="mt-2">
                        </div>

                        <!-- Visa Type -->
                        <div class="form-group col-md-6">
                            <label for="visa_type">Visa Type</label>
                            <input type="text" name="visa_type" id="visa_type" class="form-control"
                                   placeholder="e.g., Medical Treatment, Medical Check-up" value="{{ old('visa_type', $medicalVisa->visa_type) }}">
                        </div>

                        <!-- Visa Duration -->
                        <div class="form-group col-md-6">
                            <label for="visa_duration">Visa Duration</label>
                            <input type="text" name="visa_duration" id="visa_duration" class="form-control"
                                   placeholder="e.g., 90 days, 6 months" value="{{ old('visa_duration', $medicalVisa->visa_duration) }}">
                        </div>

                        <!-- Apply Fee -->
                        <div class="form-group col-md-6">
                            <label for="apply_fee">Apply Fee</label>
                            <input type="number" step="0.01" name="apply_fee" id="apply_fee"
                                   class="form-control" placeholder="0.00" value="{{ old('apply_fee', $medicalVisa->apply_fee) }}">
                        </div>

                        <!-- Processing Time -->
                        <div class="form-group col-md-6">
                            <label for="processing_time">Processing Time</label>
                            <input type="text" name="processing_time" id="processing_time" class="form-control"
                                   placeholder="e.g., 10-15 business days" value="{{ old('processing_time', $medicalVisa->processing_time) }}">
                        </div>

                        <!-- Publish Date -->
                        <div class="form-group col-md-6">
                            <label for="publish_date">Publish Date</label>
                            <input type="date" name="publish_date" id="publish_date" class="form-control"
                                   value="{{ old('publish_date', $medicalVisa->publish_date ? $medicalVisa->publish_date->format('Y-m-d') : '') }}">
                        </div>

                        <!-- Service Charge -->
                        <div class="form-group col-md-6">
                            <label for="service_charge">Service Charge</label>
                            <input type="text" name="service_charge" id="service_charge" class="form-control"
                                   placeholder="e.g., $50" value="{{ old('service_charge', $medicalVisa->service_charge) }}">
                        </div>

                        <!-- Visa Fee -->
                        <div class="form-group col-md-6">
                            <label for="visa_fee">Visa Fee</label>
                            <input type="number" step="0.01" name="visa_fee" id="visa_fee"
                                   class="form-control" placeholder="0.00" value="{{ old('visa_fee', $medicalVisa->visa_fee) }}">
                        </div>

                        <!-- Status -->
                        <div class="form-group col-md-6">
                            <label for="status">Status</label>
                            <select name="status" id="status" class="form-control">
                                <option value="1" {{ old('status', $medicalVisa->status) == 1 ? 'selected' : '' }}>Active</option>
                                <option value="0" {{ old('status', $medicalVisa->status) == 0 ? 'selected' : '' }}>Inactive</option>
                            </select>
                        </div>

                        <!-- Documents -->
                        <div class="form-group col-md-12">
                            <label for="documents">Required Documents</label>
                            <textarea name="documents" id="documents" class="form-control summernote">{{ old('documents', $medicalVisa->documents) }}</textarea>
                        </div>

                        <div class="form-group col-md-12">
                            <button type="submit" class="btn btn-primary">Update Medical Visa</button>
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
        // Optional: auto-generate slug on country change if slug is empty
        $('#country_name').on('keyup', function() {
            if ($('#slug').val().trim() === '') {
                let country = $(this).val();
                let slug = country.toLowerCase()
                    .replace(/[^\w\s-]/g, '')
                    .replace(/\s+/g, '-')
                    .replace(/--+/g, '-')
                    .trim();
                $('#slug').val(slug);
            }
        });

        // Flag preview
        $('#flug').change(function(e){
            var reader = new FileReader();
            reader.onload = function(e){
                $('#showFlag').attr('src', e.target.result);
            }
            reader.readAsDataURL(e.target.files[0]);
        });

        // Summernote
        $('#documents').summernote({
            placeholder: 'Enter required documents details...',
            height: 200
        });
    });
</script>
@endpush