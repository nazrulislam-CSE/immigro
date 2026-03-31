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
                    <a href="{{ route('admin.student.visa.index') }}" class="btn btn-danger me-2">
                        <i class="fas fa-list d-inline"></i> Student Visa List
                    </a>
                </div>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.student.visa.update', $studentVisa->id) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="row">
                        <!-- Country Name -->
                        <div class="form-group col-md-6">
                            <label for="country_name">Country Name <span class="text-danger">*</span></label>
                            <input type="text" name="country_name" id="country_name" class="form-control"
                                   placeholder="e.g., Canada" value="{{ old('country_name', $studentVisa->country_name) }}" required>
                            @error('country_name') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>

                        <!-- Flag Image -->
                        <div class="form-group col-md-6">
                            <label for="flug">Flag Image</label>
                            <input type="file" name="flug" id="flug" class="form-control" accept="image/*">
                            @error('flug') <span class="text-danger">{{ $message }}</span> @enderror
                            <img id="showFlag" src="{{ $studentVisa->flug ? asset('upload/student_visa/'.$studentVisa->flug) : asset('upload/no_image.jpg') }}" width="80" class="mt-2">
                        </div>

                        <!-- Logo -->
                        <div class="form-group col-md-6">
                            <label for="logo">University Logo</label>
                            <input type="file" name="logo" id="logo" class="form-control" accept="image/*">
                            @error('logo') <span class="text-danger">{{ $message }}</span> @enderror
                            <img id="showLogo" src="{{ $studentVisa->logo ? asset('upload/student_visa/'.$studentVisa->logo) : asset('upload/no_image.jpg') }}" width="80" class="mt-2">
                        </div>

                        <!-- Program -->
                        <div class="form-group col-md-6">
                            <label for="program">Program</label>
                            <input type="text" name="program" id="program" class="form-control"
                                   placeholder="e.g., Computer Science" value="{{ old('program', $studentVisa->program) }}">
                        </div>

                        <!-- University Name -->
                        <div class="form-group col-md-6">
                            <label for="versity_name">University Name</label>
                            <input type="text" name="versity_name" id="versity_name" class="form-control"
                                   placeholder="e.g., University of Toronto" value="{{ old('versity_name', $studentVisa->versity_name) }}">
                        </div>

                        <!-- Intake -->
                        <div class="form-group col-md-6">
                            <label for="intake">Intake</label>
                            <input type="text" name="intake" id="intake" class="form-control"
                                   placeholder="e.g., Fall 2024, Spring 2025" value="{{ old('intake', $studentVisa->intake) }}">
                        </div>

                        <!-- IELTS -->
                        <div class="form-group col-md-6">
                            <label for="ielts">IELTS Requirement</label>
                            <input type="text" name="ielts" id="ielts" class="form-control"
                                   placeholder="e.g., 6.5 overall" value="{{ old('ielts', $studentVisa->ielts) }}">
                        </div>

                        <!-- Application Fee -->
                        <div class="form-group col-md-6">
                            <label for="application_fee">Application Fee</label>
                            <input type="number" step="0.01" name="application_fee" id="application_fee"
                                   class="form-control" placeholder="0.00" value="{{ old('application_fee', $studentVisa->application_fee) }}">
                        </div>

                        <!-- Tuition Fee -->
                        <div class="form-group col-md-6">
                            <label for="averse_tution_fee">Average Tuition Fee (per year)</label>
                            <input type="number" step="0.01" name="averse_tution_fee" id="averse_tution_fee"
                                   class="form-control" placeholder="0.00" value="{{ old('averse_tution_fee', $studentVisa->averse_tution_fee) }}">
                        </div>

                        <!-- Accommodation Cost -->
                        <div class="form-group col-md-6">
                            <label for="acommodation_cost">Accommodation Cost</label>
                            <input type="number" step="0.01" name="acommodation_cost" id="acommodation_cost"
                                   class="form-control" placeholder="0.00" value="{{ old('acommodation_cost', $studentVisa->acommodation_cost) }}">
                        </div>

                        <!-- Processing Time -->
                        <div class="form-group col-md-6">
                            <label for="processing_time">Processing Time</label>
                            <input type="text" name="processing_time" id="processing_time" class="form-control"
                                   placeholder="e.g., 4-6 weeks" value="{{ old('processing_time', $studentVisa->processing_time) }}">
                        </div>

                        <!-- Medical Fee -->
                        <div class="form-group col-md-6">
                            <label for="medical_fee">Medical Fee</label>
                            <input type="number" step="0.01" name="medical_fee" id="medical_fee"
                                   class="form-control" placeholder="0.00" value="{{ old('medical_fee', $studentVisa->medical_fee) }}">
                        </div>

                        <!-- Service Charge -->
                        <div class="form-group col-md-6">
                            <label for="service_charge">Service Charge</label>
                            <input type="text" name="service_charge" id="service_charge" class="form-control"
                                   placeholder="e.g., $500" value="{{ old('service_charge', $studentVisa->service_charge) }}">
                        </div>

                        <!-- Status -->
                        <div class="form-group col-md-6">
                            <label for="status">Status</label>
                            <select name="status" id="status" class="form-control">
                                <option value="1" {{ old('status', $studentVisa->status) == 1 ? 'selected' : '' }}>Active</option>
                                <option value="0" {{ old('status', $studentVisa->status) == 0 ? 'selected' : '' }}>Inactive</option>
                            </select>
                        </div>

                        <!-- Documents -->
                        <div class="form-group col-md-12">
                            <label for="documents">Required Documents</label>
                            <textarea name="documents" id="documents" class="form-control summernote">{{ old('documents', $studentVisa->documents) }}</textarea>
                        </div>

                        <div class="form-group col-md-12">
                            <button type="submit" class="btn btn-primary">Update Student Visa</button>
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

        // Logo preview
        $('#logo').change(function(e){
            var reader = new FileReader();
            reader.onload = function(e){
                $('#showLogo').attr('src', e.target.result);
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