@extends('layouts.admin.app', [$pageTitle => 'Page Title'])
@section('content')
<div class="breadcrumb-header justify-content-between">
    <div class="d-flex align-items-center">
        {{-- <h4 class="content-title mb-2">Hi, welcome back!</h4> --}}
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item active" aria-current="page">{{ $pageTitle ?? 'Dashboard' }}</li>
                <li class="breadcrumb-item"><a href="javascript:void(0);">Dashboard</a></li>
            </ol>
        </nav>
    </div>
    <div class="d-flex my-auto">
        {{-- <div class=" d-flex right-page">
            <div class="d-flex justify-content-center me-5">
                <div class="">
                    <span class="d-block">
                        <span class="label ">EXPENSES</span>
                    </span>
                    <span class="value">
                        $53,000
                    </span>
                </div>
                <div class="ms-3 mt-2">
                    <span class="sparkline_bar"></span>
                </div>
            </div>
            <div class="d-flex justify-content-center">
                <div class="">
                    <span class="d-block">
                        <span class="label">PROFIT</span>
                    </span>
                    <span class="value">
                        $34,000
                    </span>
                </div>
                <div class="ms-3 mt-2">
                    <span class="sparkline_bar31"></span>
                </div>
            </div>
        </div> --}}
    </div>
</div>

    <div class="main-content-body">
        <div class="row row-sm">
            
    <div class="card">
        <div class="card-header border-bottom d-flex justify-content-between align-items-center">
            <p class="card-title my-0">{{ $pageTitle ?? 'Page Title'}}</p>
            <div class="d-flex">
                <a href="{{ route('admin.education.index')}}" class="btn btn-danger me-2">
                    <i class="fas fa-list d-inline"></i> Education List
                </a>
            </div>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.education.store')}}" method="post" enctype="multipart/form-data">
                @csrf
              <div class="row">
                    <div class="form-group col-xl-6 col-lg-6 col-md-6">
                       <label for="course_name">Course Name: <span class="text-danger"></span></label>
                       @error('course_name') <span class="text-danger">{{ $message }}</span> @enderror
                        <div class="input-group">
                            <span class="input-group-text" title="Course Name" id="basic-addon1"><i class="fas fa-school"></i></span>
                            <input type="text" value="{{ old('course_name') }}" class=" form-control" name="course_name" placeholder="Enter Course Name">
                        </div>
                    </div>

                    <div class="form-group col-xl-6 col-lg-6 col-md-6">
                        <label for="course_fee">Course Fee: <span class="text-danger"></span></label>
                        @error('course_fee') <span class="text-danger">{{ $message }}</span> @enderror
                        <div class="input-group">
                            <span class="input-group-text font-weight-bolder" title="Course Fee" id="basic-addon1">৳</span>
                            <input type="number" min="0" value="{{ old('course_fee') }}" class="form-control" name="course_fee" id="course_fee" placeholder="Enter Course Fee">
                        </div>
                    </div>
                    
                    <div class="form-group col-xl-6 col-lg-6 col-md-6">
                        <label for="discount">Discount: <span class="text-danger"></span></label> <!-- Error message element for discount -->
                        <span id="discount-error" class="text-danger"></span>
                        @error('discount') <span class="text-danger">{{ $message }}</span> @enderror
                        <div class="input-group">
                            <span class="input-group-text font-weight-bolder" title="Discount" id="basic-addon1">৳</span>
                            <input type="number" min="0" value="{{ old('discount') }}" class="form-control" name="discount" id="discount" placeholder="Enter Discount">
                        </div>
                    </div>
                  
                    
                    <div class="form-group col-xl-6 col-lg-6 col-md-6">
                        <label for="gross_course_fee">Gross Course Fee: <span class="text-danger"></span></label>
                        @error('gross_course_fee') <span class="text-danger">{{ $message }}</span> @enderror
                        <div class="input-group">
                            <span class="input-group-text font-weight-bolder" title="Gross Course Fee" id="basic-addon1">৳</span>
                            <input type="number" min="0" value="{{ old('gross_course_fee') }}" class="form-control" name="gross_course_fee" id="gross_course_fee" placeholder="Enter Gross Course Fee" readonly>
                        </div>
                    </div>

                    <div class="form-group col-xl-6 col-lg-6 col-md-6">
                        <label for="duration">Duration: <span class="text-danger"></span></label>
                        @error('duration') <span class="text-danger">{{ $message }}</span> @enderror
                         <div class="input-group">
                             <span class="input-group-text" title="Duration" id="basic-addon1"><i class="fas fa-school"></i></span>
                             <input type="text" value="{{ old('duration') }}" class=" form-control" name="duration" placeholder="Enter Duration">
                         </div>
                     </div>

                    <div class="form-group col-xl-6 col-lg-6 col-md-6">
                        <label for="experience">Experience: <span class="text-danger"></span></label>
                        @error('experience') <span class="text-danger">{{ $message }}</span> @enderror
                        <div class="input-group">
                            <span class="input-group-text" title="Experience" id="basic-addon1"><i class="fas fa-school"></i></span>
                            <input type="text" value="{{ old('experience') }}" class=" form-control" name="experience" placeholder="Enter Experience">
                        </div>
                    </div>

                    <div class="form-group col-xl-6 col-lg-6 col-md-6">
                        <label for="coordinator_name">Coordinator Name: <span class="text-danger"></span></label>
                        @error('coordinator_name') <span class="text-danger">{{ $message }}</span> @enderror
                        <div class="input-group">
                            <span class="input-group-text" title="Coordinator Name" id="basic-addon1"><i class="fas fa-university"></i></span>
                            <input type="text" value="{{ old('coordinator_name') }}" class=" form-control" name="coordinator_name" placeholder="Enter Coordinator Name">
                        </div>
                    </div>

                    <div class="form-group col-xl-4 col-lg-4 col-md-6 col-sm-12">
                        <label for="coordinator_photo">Coordinator Photo <span class="text-danger font-weight-bolder">(Size:551,551px)</span>:</label>
                        @error('coordinator_photo') <span class="text-danger">{{ $message }}</span> @enderror
                        <div class="input-group">
                            <span class="input-group-text" title="Coordinator Photo" id="basic-addon1"><i class="fas fa-photo-video"></i></span>
                            <input type="file" name="coordinator_photo" id="image1" class="form-control bg-white">
                        </div>
                    </div>

                   <div class="form-group col-xl-2 col-lg-2 col-md-6 col-sm-12">
                       <img id="showImage1" src="{{ (!empty($profile->image)) ? url('upload/education/'.$profile->image):url('upload/no_image.jpg') }}" alt="Admin" style="width:80px; height: 80px;"  >
                   </div>

                   <div class="form-group col-xl-6 col-lg-6 col-md-6 col-sm-12">
                    <label for="image">Course Photo <span class="text-danger font-weight-bolder">(Size:900,600px)</span>:</label>
                    @error('image') <span class="text-danger">{{ $message }}</span> @enderror
                    <div class="input-group">
                        <span class="input-group-text" title="Photo" id="basic-addon1"><i class="fas fa-photo-video"></i></span>
                        <input type="file" name="image" id="image" class="form-control bg-white">
                    </div>
                </div>

               <div class="form-group col-xl-6 col-lg-6 col-md-6 col-sm-12">
                   <img width="100%" id="showImage" src="{{ (!empty($profile->image)) ? url('upload/education/'.$profile->image):url('upload/no_image.jpg') }}" alt="Admin" style="width:80px; height: 80px;"  >
               </div>

               <div class="form-group col-xl-12 col-lg-12 col-md-12">
                        <label for="banner">Course Banner <span class="text-danger font-weight-bolder">(Size:1920,605px)</span>:</label>
                        @error('banner') <span class="text-danger">{{ $message }}</span> @enderror
                        <div class="input-group">
                            <span class="input-group-text" title="Photo" id="basic-addon1"><i class="fas fa-photo-video"></i></span>
                            <input type="file" name="banner" id="banner" class="form-control bg-white">
                        </div>
                </div>

                <div class="form-group col-xl-12 col-lg-12 col-md-12">
                    <img id="showImage2" src="{{ (!empty($profile->image)) ? url('upload/education/'.$profile->image):url('upload/page-title.jpg') }}" alt="photo" width="100%" >
                </div>



                    <div class="form-group col-xl-12 col-lg-12  col-md-6">
                        <label for="course_materials">Course Materials:</label>
                        @error('course_materials') <span class="text-danger">{{ $message }}</span> @enderror
                        <textarea name="course_materials" id="course_materials">{{ old('course_materials')}}</textarea>
                    </div>

                   <div class="form-group col-xl-6 col-lg-6 col-md-6">
                        <label for="study_type">Study Type:</label>
                        @error('study_type') <span class="text-danger">{{ $message }}</span> @enderror
                         <div class="input-group">
                             <span class="input-group-text" title="Study Type" id="basic-addon1"><i class="fas fa-user-tie"></i></span>
                             <select  name="study_type" class=" form-control">
                              <option value="">Select Study Type</option>
                                 <option value="1" {{ old('study_type') == '1' ? 'selected' : '' }}>Spoken</option>
                                 <option value="2" {{ old('study_type') == '2' ? 'selected' : '' }}>Kids Spoken</option>
                                 <option value="3" {{ old('study_type') == '3' ? 'selected' : '' }}>IELTS</option>
                                 <option value="4" {{ old('study_type') == '4' ? 'selected' : '' }}>Japanese</option>
                                 <option value="5" {{ old('study_type') == '5' ? 'selected' : '' }}>Korean</option>
                                 <option value="5" {{ old('study_type') == '6' ? 'selected' : '' }}>Diploma In English</option>
                             </select>
                         </div>
                    </div>

                    <div class="form-group col-xl-6 col-lg-6 col-md-6">
                       <label for="status">Status:</label>
                       @error('status') <span class="text-danger">{{ $message }}</span> @enderror
                        <div class="input-group">
                            <span class="input-group-text" title="Name" id="basic-addon1"><i class="fas fa-user-tie" title="Name"></i></span>
                            <select  name="status" class=" form-control">
                             <option value="">Select Status</option>
                                <option value="1" {{ old('status') == '1' ? 'selected' : '' }}>Active</option>
                                <option value="0" {{ old('status') == '0' ? 'selected' : '' }}>Deactive</option>
                            </select>
                        </div>
                    </div>
  
                    <div class="col-xl-12 col-lg-6 col-md-6 col-sm-12 mt-3">
                        <button type="submit" class="add-to-cart btn btn-success btn-block"><i class="fas fa-plus"></i> Add Education</button>
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
        /* ============== Team Photo ============ */
        $(document).ready(function(){
            $('#image').change(function(e){
                var reader = new FileReader();
                reader.onload = function(e){
                    $('#showImage').attr('src',e.target.result);
                }
                reader.readAsDataURL(e.target.files['0']);
            });
        });

        $(document).ready(function(){
            $('#image1').change(function(e){
                var reader = new FileReader();
                reader.onload = function(e){
                    $('#showImage1').attr('src',e.target.result);
                }
                reader.readAsDataURL(e.target.files['0']);
            });
        });

        $(document).ready(function(){
            $('#banner').change(function(e){
                var reader = new FileReader();
                reader.onload = function(e){
                    $('#showImage2').attr('src',e.target.result);
                }
                reader.readAsDataURL(e.target.files['0']);
            });
        });
        /* ============== Summernote Added ============ */
        jQuery(function(e){
            'use strict';
            $(document).ready(function() {
                $('#course_materials').summernote({
                    placeholder: 'Please some content here'
                });
            });
        });
        /* ============== Summernote Added ============ */
    </script>
    <script>
        // Function to calculate the gross course fee
        function calculateGrossCourseFee() {
            var courseFee = parseFloat(document.getElementById('course_fee').value);
            var discount = parseFloat(document.getElementById('discount').value);

            // Check if discount is greater than course fee
            if (discount > courseFee) {
                // Display an error message
                document.getElementById('discount-error').innerText = "Discount cannot be greater than Course Fee.";
                // Clear the value of the gross course fee input
                document.getElementById('gross_course_fee').value = "";
                return;
            } else {
                // Clear the error message
                document.getElementById('discount-error').innerText = "";
            }


            // Calculate the gross course fee
            var grossCourseFee = courseFee - discount;

            // Set the value of the gross course fee input
            document.getElementById('gross_course_fee').value = grossCourseFee.toFixed(2);
        }

        // Call the function initially and whenever inputs change
        calculateGrossCourseFee();
        document.getElementById('course_fee').addEventListener('keyup', calculateGrossCourseFee);
        document.getElementById('discount').addEventListener('keyup', calculateGrossCourseFee);
    </script>
@endpush