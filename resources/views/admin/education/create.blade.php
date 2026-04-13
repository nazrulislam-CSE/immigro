@extends('layouts.admin.app')

@section('title', $pageTitle ?? 'Add Upazila')

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
    <div class="d-flex my-auto">
        <!-- যেকোনো বাটন বা লিংক এখানে আসতে পারে -->
    </div>
</div>

<div class="main-content-body">
    <div class="row row-sm">
        <div class="card">
            <div class="card-header border-bottom d-flex justify-content-between align-items-center">
                <p class="card-title my-0">{{ $pageTitle ?? 'Page Title' }}</p>
                <div class="d-flex">
                    <a href="{{ route('admin.upazila.index') }}" class="btn btn-danger me-2">
                        <i class="fas fa-list d-inline"></i> Upazila List
                    </a>
                </div>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.upazila.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="form-group col-xl-6 col-lg-6 col-md-6">
                            <label for="name_en">Upazila Name (English): <span class="text-danger">*</span></label>
                            @error('name_en') <span class="text-danger">{{ $message }}</span> @enderror
                            <div class="input-group">
                                <span class="input-group-text" title="Upazila Name"><i class="fas fa-tags"></i></span>
                                <input type="text" value="{{ old('name_en') }}" class="form-control" name="name_en" id="name_en" placeholder="Upazila Name (English)">
                            </div>
                        </div>

                        <div class="form-group col-xl-6 col-lg-6 col-md-6">
                            <label for="name_bn">Upazila Name (Bangla): <span class="text-danger">*</span></label>
                            @error('name_bn') <span class="text-danger">{{ $message }}</span> @enderror
                            <div class="input-group">
                                <span class="input-group-text" title="Upazila Name (Bangla)"><i class="fas fa-tags"></i></span>
                                <input type="text" value="{{ old('name_bn') }}" class="form-control" name="name_bn" id="name_bn" placeholder="উপজেলার নাম (বাংলা)">
                            </div>
                        </div>

                        <div class="form-group col-xl-6 col-lg-6 col-md-6">
                            <label for="description_en">Description (English):</label>
                            @error('description_en') <span class="text-danger">{{ $message }}</span> @enderror
                            <div class="input-group">
                                <span class="input-group-text" title="Description"><i class="fas fa-align-left"></i></span>
                                <textarea class="form-control" name="description_en" id="description_en" placeholder="Description (English)">{{ old('description_en') }}</textarea>
                            </div>
                        </div>

                        <div class="form-group col-xl-6 col-lg-6 col-md-6">
                            <label for="description_bn">Description (Bangla):</label>
                            @error('description_bn') <span class="text-danger">{{ $message }}</span> @enderror
                            <div class="input-group">
                                <span class="input-group-text" title="বর্ণনা"><i class="fas fa-align-left"></i></span>
                                <textarea class="form-control" name="description_bn" id="description_bn" placeholder="বর্ণনা (বাংলা)">{{ old('description_bn') }}</textarea>
                            </div>
                        </div>

                        <div class="form-group col-xl-6 col-lg-6 col-md-6">
                            <label for="image">Image:</label>
                            @error('image') <span class="text-danger">{{ $message }}</span> @enderror
                            <div class="input-group">
                                <span class="input-group-text" title="Image"><i class="fas fa-image"></i></span>
                                <input type="file" class="form-control" name="image" id="image">
                            </div>
                            <div class="mt-2">
                                <img id="showImage" src="{{ asset('default-image.jpg') }}" alt="Preview" width="80" class="img-thumbnail">
                            </div>
                        </div>

                        <div class="form-group col-xl-4 col-lg-6 col-md-6">
                            <label for="status">Status:</label>
                            @error('status') <span class="text-danger">{{ $message }}</span> @enderror
                            <div class="input-group">
                                <span class="input-group-text" title="Status"><i class="fas fa-user-tie"></i></span>
                                <select name="status" id="status" class="form-control">
                                    <option value="">Select Status</option>
                                    <option value="1" {{ old('status') == '1' ? 'selected' : '' }}>Active</option>
                                    <option value="0" {{ old('status') == '0' ? 'selected' : '' }}>Deactive</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-xl-12 col-lg-6 col-md-6 col-sm-12 mt-3">
                            <button type="submit" class="btn btn-success btn-block"><i class="fas fa-plus"></i> Add Upazila</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@push('js')
<script>
    /* ============== Image Preview ============ */
    $(document).ready(function(){
        $('#image').change(function(e){
            var reader = new FileReader();
            reader.onload = function(e){
                $('#showImage').attr('src', e.target.result);
            }
            reader.readAsDataURL(e.target.files[0]);
        });
    });

    /* ============== Summernote Initialization ============ */
    $(document).ready(function() {
        $('#description_en').summernote({
            placeholder: 'Description English',
            height: 150
        });
        $('#description_bn').summernote({
            placeholder: 'বাংলায় বর্ণনা দিন',
            height: 150
        });
    });
</script>
@endpush