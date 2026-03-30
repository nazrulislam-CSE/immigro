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
                <a href="{{ route('admin.visa.index')}}" class="btn btn-danger me-2">
                    <i class="fas fa-list d-inline"></i> Visa List
                </a>
            </div>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.visa.store')}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="form-group col-xl-12 col-lg-12 col-md-12">
                        <label for="visa_type">Visa Type:</label>
                        @error('visa_type') <span class="text-danger">{{ $message }}</span> @enderror
                        <div class="input-group">
                            <span class="input-group-text" title="Visa Type" id="basic-addon1"><i class="fas fa-user-tie"></i></span>
                            <select  name="visa_type" id="visa_type" class=" form-control">
                                <option value="">Select Visa Type</option>
                                <option value="2" {{ old('visa_type') == '2' ? 'selected' : '' }}>Work Permit Visa</option>
                                <option value="1" {{ old('visa_type') == '1' ? 'selected' : '' }}>Tourist Visa</option>
                            </select>
                         </div>
                    </div>
                </div>
                <div id="tourist_visa_div" style="display: none;">
                    <div class="row">
                        <div class="form-group col-xl-6 col-lg-6 col-md-6">
                            <label for="t_country_name">Country Name: <span class="text-danger"></span></label>
                            @error('t_country_name') <span class="text-danger">{{ $message }}</span> @enderror
                             <div class="input-group">
                                 <span class="input-group-text" title="t_country_name" id="basic-addon1"><i class="fas fa-globe"></i></span>
                                 <input type="text" value="{{ old('t_country_name') }}" class=" form-control" name="t_country_name" placeholder="Enter Country Name">
                             </div>
                        </div>
                        {{-- <div class="form-group col-xl-6 col-lg-6 col-md-6">
                            <label for="t_clients_name">Clients Name : <span class="text-danger"></span></label>
                            @error('t_clients_name') <span class="text-danger">{{ $message }}</span> @enderror
                            <div class="input-group">
                                <span class="input-group-text" title="Clients Name" id="basic-addon1"><i class="fas fa-users"></i></span>
                                <input type="text" value="{{ old('t_clients_name') }}" class=" form-control" name="t_clients_name" placeholder="Enter Clients Name">
                            </div>
                        </div>
                        <div class="form-group col-xl-6 col-lg-6 col-md-6">
                            <label for="t_passport_number">Passport Number: <span class="text-danger"></span></label>
                            @error('t_passport_number') <span class="text-danger">{{ $message }}</span> @enderror
                            <div class="input-group">
                                <span class="input-group-text" title="Passport Number" id="basic-addon1"><i class="fas fa-address-card"></i></span>
                                <input type="number" min="0" value="{{ old('t_passport_number') }}" class=" form-control" name="t_passport_number" placeholder="Enter Your Passport Number">
                            </div>
                        </div>
                        <div class="form-group col-xl-6 col-lg-6 col-md-6">
                            <label for="t_phone">Phone: <span class="text-danger"></span></label>
                            @error('t_phone') <span class="text-danger">{{ $message }}</span> @enderror
                             <div class="input-group">
                                 <span class="input-group-text" title="Phone" id="basic-addon1"><i class="fas fa-phone"></i></span>
                                 <input type="number" min="0" value="{{ old('t_phone') }}" class=" form-control" name="t_phone" placeholder="Enter Phone Number">
                             </div>
                        </div> --}}
                      
                        <div class="form-group col-xl-6 col-lg-6 col-md-6">
                            <label for="t_visa_duration">Visa Duration : <span class="text-danger"></span></label>
                            @error('t_visa_duration') <span class="text-danger">{{ $message }}</span> @enderror
                            <div class="input-group">
                                <span class="input-group-text" title="Visa Duration" id="basic-addon1"><i class="fas fa-users"></i></span>
                                <input type="text" value="{{ old('t_visa_duration') }}" class=" form-control" name="t_visa_duration" placeholder="Enter Visa Duration">
                            </div>
                        </div>
                        <div class="form-group col-xl-6 col-lg-6 col-md-6">
                            <label for="t_processing_time">Visa Processing Time: <span class="text-danger"></span></label>
                            @error('t_processing_time') <span class="text-danger">{{ $message }}</span> @enderror
                             <div class="input-group">
                                 <span class="input-group-text" title="Visa Processing Time" id="basic-addon1"><i class="fas fa-university"></i></span>
                                 <input type="text" value="{{ old('t_processing_time') }}" class=" form-control" name="t_processing_time" placeholder="Enter Visa Processing Time">
                             </div>
                        </div>
                        {{-- <div class="form-group col-xl-6 col-lg-6 col-md-6">
                            <label for="t_agent_name">Agent Name : <span class="text-danger"></span></label>
                            @error('t_agent_name') <span class="text-danger">{{ $message }}</span> @enderror
                            <div class="input-group">
                                <span class="input-group-text" title="Agent Name" id="basic-addon1"><i class="fas fa-users"></i></span>
                                <input type="text" value="{{ old('t_agent_name') }}" class=" form-control" name="t_agent_name" placeholder="Enter Agent Name">
                            </div>
                        </div>
                        <div class="form-group col-xl-6 col-lg-6 col-md-6">
                            <label for="t_agent_price">Agent Price: <span class="text-danger"></span></label>
                            @error('t_agent_price') <span class="text-danger">{{ $message }}</span> @enderror
                             <div class="input-group">
                                 <span class="input-group-text font-weight-bolder" title="Agent Price" id="basic-addon1">৳</span>
                                 <input type="number" min="0" value="{{ old('t_agent_price') }}" class=" form-control" name="t_agent_price" placeholder="Enter Agent Price">
                             </div>
                        </div> --}}
                        <div class="form-group col-xl-6 col-lg-6 col-md-6">
                            <label for="t_customer_price">Amount: <span class="text-danger"></span></label>
                            @error('t_customer_price') <span class="text-danger">{{ $message }}</span> @enderror
                             <div class="input-group">
                                 <span class="input-group-text font-weight-bolder" title="Customer Price" id="basic-addon1">৳</span>
                                 <input type="text" min="" value="{{ old('t_customer_price') }}" class=" form-control" name="t_customer_price" placeholder="Enter Amount">
                             </div>
                        </div>

                        <div class="form-group col-xl-4 col-lg-4 col-md-6">
                            <label for="t_image">Flag <span class="text-danger font-weight-bolder">(Size:900,600px)</span>:</label>
                            @error('t_image') <span class="text-danger">{{ $message }}</span> @enderror
                            <div class="input-group">
                                <span class="input-group-text" title="Photo" id="basic-addon1"><i class="fas fa-photo-video"></i></span>
                                <input type="file" name="t_image" id="timage" class="form-control bg-white">
                            </div>
                        </div>
    
                       <div class="form-group col-xl-2 col-lg-2 col-md-6">
                           <img id="showImage1" src="{{ (!empty($visa->t_image)) ? url('upload/visa/'.$visa->t_image):url('upload/no_image.jpg') }}" alt="Admin" style="width:100px; height: 100px;"  >
                       </div>

                       <div class="form-group col-xl-6 col-lg-6 col-md-6">
                        <label for="status">Status:</label>
                        @error('status') <span class="text-danger">{{ $message }}</span> @enderror
                         <div class="input-group">
                             <span class="input-group-text" title="Name" id="basic-addon1"><i class="fas fa-user-tie" title="Name"></i></span>
                             <select  name="t_status" class=" form-control">
                              <option value="">Select Status</option>
                                 <option value="1" {{ old('t_status') == '1' ? 'selected' : '' }}>Active</option>
                                 <option value="0" {{ old('t_status') == '0' ? 'selected' : '' }}>Deactive</option>
                             </select>
                         </div>
                     </div>

                     <div class="form-group col-xl-12 col-lg-12 col-md-12">
                            <label for="t_banner">Visa Banner Photo <span class="text-danger font-weight-bolder">(Size:1920,900px)</span>:</label>
                            @error('t_banner') <span class="text-danger">{{ $message }}</span> @enderror
                            <div class="input-group">
                                <span class="input-group-text" title="Photo" id="basic-addon1"><i class="fas fa-photo-video"></i></span>
                                <input type="file" name="t_banner" id="banner" class="form-control bg-white">
                            </div>
                    </div>

                    <div class="form-group col-xl-12 col-lg-12 col-md-12">
                        <img id="showImage2" src="{{ (!empty($visa->t_banner)) ? url('upload/visa/'.$visa->t_banner):url('upload/page-title.jpg') }}" alt="photo" width="100%" >
                    </div>

                        <div class="form-group col-xl-12 col-lg-12  col-md-12">
                            <label for="t_document">Necessary Documents:</label>
                            @error('t_document') <span class="text-danger">{{ $message }}</span> @enderror
                            <textarea name="t_document" id="t_document">{{ old('t_document')}}</textarea>
                        </div>
    
                        <div class="col-xl-12 col-lg-6 col-md-6 col-sm-12 mt-3">
                            <button type="submit" class="add-to-cart btn btn-success btn-block"><i class="fas fa-plus"></i> Add Visa</button>
                        </div>
                    </div>
                </div>
                <div id="work_visa_div" style="display: none;">
                    <div class="row">
                        <div class="form-group col-xl-6 col-lg-6 col-md-6">
                            <label for="country_name">Country Name: <span class="text-danger"></span></label>
                            @error('country_name') <span class="text-danger">{{ $message }}</span> @enderror
                             <div class="input-group">
                                 <span class="input-group-text" title="country_name" id="basic-addon1"><i class="fas fa-globe"></i></span>
                                 <input type="text" value="{{ old('country_name') }}" class=" form-control" name="country_name" placeholder="Enter Country Name">
                             </div>
                        </div>
    
                        <div class="form-group col-xl-6 col-lg-6 col-md-6">
                            <label for="work_types">Work Types: <span class="text-danger"></span></label>
                            @error('work_types') <span class="text-danger">{{ $message }}</span> @enderror
                             <div class="input-group">
                                 <span class="input-group-text" title="Work Type" id="basic-addon1"><i class="fas fa-school"></i></span>
                                 <input type="text" value="{{ old('work_types') }}" class=" form-control" name="work_types" placeholder="Enter Work Type">
                             </div>
                        </div>
    
                        <div class="form-group col-xl-6 col-lg-6 col-md-6">
                            <label for="contact_year">Contact Year: <span class="text-danger"></span></label>
                            @error('contact_year') <span class="text-danger">{{ $message }}</span> @enderror
                             <div class="input-group">
                                 <span class="input-group-text" title="Contact Year" id="basic-addon1"><i class="fas fa-university"></i></span>
                                 <input type="text" min="" value="{{ old('contact_year') }}" class=" form-control" name="contact_year" placeholder="Enter Contact Year">
                             </div>
                        </div>
    
                        <div class="form-group col-xl-6 col-lg-6 col-md-6">
                            <label for="overtime">Overtime: <span class="text-danger"></span></label>
                            @error('overtime') <span class="text-danger">{{ $message }}</span> @enderror
                             <div class="input-group">
                                 <span class="input-group-text" title="Overtime" id="basic-addon1"><i class="fas fa-school"></i></span>
                                 <input type="text" value="{{ old('overtime') }}" class=" form-control" name="overtime" placeholder="Enter Overtime">
                             </div>
                        </div>
    
                        <div class="form-group col-xl-6 col-lg-6 col-md-6">
                            <label for="weekend">Weekend: <span class="text-danger"></span></label>
                            @error('weekend') <span class="text-danger">{{ $message }}</span> @enderror
                             <div class="input-group">
                                 <span class="input-group-text" title="Weekend" id="basic-addon1"><i class="fas fa-tags"></i></span>
                                 <input type="text" value="{{ old('weekend') }}" class=" form-control" name="weekend" placeholder="Enter Weekend">
                             </div>
                        </div>
    
                        <div class="form-group col-xl-6 col-lg-6 col-md-6">
                            <label for="basic_salary">Basic Salary: <span class="text-danger"></span></label>
                            @error('basic_salary') <span class="text-danger">{{ $message }}</span> @enderror
                             <div class="input-group">
                                 <span class="input-group-text font-weight-bolder" title="Basic Salary" id="basic-addon1">৳</span>
                                 <input type="number" min="0" value="{{ old('basic_salary') }}" class=" form-control" name="basic_salary" placeholder="Enter Basic Salary">
                             </div>
                        </div>
    
                        <div class="form-group col-xl-6 col-lg-6 col-md-6">
                            <label for="accommodation_cost">Accommodation Cost: <span class="text-danger"></span></label>
                            @error('accommodation_cost') <span class="text-danger">{{ $message }}</span> @enderror
                             <div class="input-group">
                                 <span class="input-group-text font-weight-bolder" title="Accommodation Cost" id="basic-addon1">৳</span>
                                 <input type="text" min="" value="{{ old('accommodation_cost') }}" class=" form-control" name="accommodation_cost" placeholder="Enter Accommodation Cost">
                             </div>
                        </div>
    
                        <div class="form-group col-xl-6 col-lg-6 col-md-6">
                            <label for="advance_payment">Advance Payment: <span class="text-danger"></span></label>
                            @error('advance_payment') <span class="text-danger">{{ $message }}</span> @enderror
                             <div class="input-group">
                                 <span class="input-group-text font-weight-bolder" title="Accommodation Cost" id="basic-addon1">৳</span>
                                 <input type="number" min="0" value="{{ old('advance_payment') }}" class=" form-control" name="advance_payment" placeholder="Enter Advance Payment">
                             </div>
                        </div>
    
                        <div class="form-group col-xl-6 col-lg-6 col-md-6">
                            <label for="total_cost">Total Cost: <span class="text-danger"></span></label>
                            @error('total_cost') <span class="text-danger">{{ $message }}</span> @enderror
                             <div class="input-group">
                                 <span class="input-group-text font-weight-bolder" title="Total Cost" id="basic-addon1">৳</span>
                                 <input type="number" min="0" value="{{ old('total_cost') }}" class=" form-control" name="total_cost" placeholder="Enter Total Cost">
                             </div>
                        </div>
    
                        <div class="form-group col-xl-6 col-lg-6 col-md-6">
                            <label for="after_work_permit">After Work Permit: <span class="text-danger"></span></label>
                            @error('after_work_permit') <span class="text-danger">{{ $message }}</span> @enderror
                             <div class="input-group">
                                 <span class="input-group-text font-weight-bolder" title="After Work Permit" id="basic-addon1">৳</span>
                                 <input type="number" min="0" value="{{ old('after_work_permit') }}" class=" form-control" name="after_work_permit" placeholder="Enter After Work Permit">
                             </div>
                        </div>
    
                        <div class="form-group col-xl-6 col-lg-6 col-md-6">
                            <label for="after_visa">After Visa: <span class="text-danger"></span></label>
                            @error('after_visa') <span class="text-danger">{{ $message }}</span> @enderror
                             <div class="input-group">
                                 <span class="input-group-text font-weight-bolder" title="After Visa" id="basic-addon1">৳</span>
                                 <input type="number" min="0" value="{{ old('after_visa') }}" class=" form-control" name="after_visa" placeholder="Enter After Visa">
                             </div>
                        </div>
    
                        <div class="form-group col-xl-6 col-lg-6 col-md-6">
                            <label for="duration_visa">Duration Visa: <span class="text-danger"></span></label>
                            @error('duration_visa') <span class="text-danger">{{ $message }}</span> @enderror
                             <div class="input-group">
                                 <span class="input-group-text" title="After Visa" id="basic-addon1"><i class="fas fa-university"></i></span>
                                 <input type="text" min="" value="{{ old('duration_visa') }}" class=" form-control" name="duration_visa" placeholder="Enter Duration Visa">
                             </div>
                        </div>
    
                        <div class="form-group col-xl-6 col-lg-6 col-md-6">
                            <label for="visa_processing_time">Visa Processing Time: <span class="text-danger"></span></label>
                            @error('visa_processing_time') <span class="text-danger">{{ $message }}</span> @enderror
                             <div class="input-group">
                                 <span class="input-group-text" title="Visa Processing Time" id="basic-addon1"><i class="fas fa-university"></i></span>
                                 <input type="text" value="{{ old('visa_processing_time') }}" class=" form-control" name="visa_processing_time" placeholder="Enter Visa Processing Time">
                             </div>
                        </div>
    
                        {{-- <div class="form-group col-xl-6 col-lg-6 col-md-6">
                            <label for="visa_type">Visa Type:</label>
                            @error('visa_type') <span class="text-danger">{{ $message }}</span> @enderror
                             <div class="input-group">
                                 <span class="input-group-text" title="Visa Type" id="basic-addon1"><i class="fas fa-user-tie"></i></span>
                                 <select  name="visa_type" class=" form-control">
                                  <option value="">Select Visa Type</option>
                                     <option value="1" {{ old('visa_type') == '1' ? 'selected' : '' }}>Tourist Visa</option>
                                     <option value="2" {{ old('visa_type') == '0' ? 'selected' : '' }}>Work Permit Visa</option>
                                 </select>
                             </div>
                        </div> --}}
    
                        <div class="form-group col-xl-4 col-lg-4 col-md-6">
                            <label for="image">Flag <span class="text-danger font-weight-bolder">(Size:551,225px)</span>:</label>
                            @error('image') <span class="text-danger">{{ $message }}</span> @enderror
                            <div class="input-group">
                                <span class="input-group-text" title="Photo" id="basic-addon1"><i class="fas fa-photo-video"></i></span>
                                <input type="file" name="image" id="image" class="form-control bg-white">
                            </div>
                        </div>
    
                       <div class="form-group col-xl-2 col-lg-2 col-md-6">
                           <img id="showImage" src="{{ (!empty($profile->image)) ? url('upload/study/'.$profile->image):url('upload/no_image.jpg') }}" alt="Admin" style="width:100px; height: 100px;"  >
                       </div>
    
                       <div class="form-group col-xl-12 col-lg-12 col-md-12">
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
    
                       <div class="form-group col-xl-12 col-lg-12 col-md-12">
                                <label for="banner">Visa Banner Photo <span class="text-danger font-weight-bolder">(Size:1920,605px)</span>:</label>
                                @error('banner') <span class="text-danger">{{ $message }}</span> @enderror
                                <div class="input-group">
                                    <span class="input-group-text" title="Photo" id="basic-addon1"><i class="fas fa-photo-video"></i></span>
                                    <input type="file" name="banner" id="banner" class="form-control bg-white">
                                </div>
                        </div>
    
                        <div class="form-group col-xl-12 col-lg-12 col-md-12">
                            <img id="showImage2" src="{{ (!empty($profile->image)) ? url('upload/page/'.$profile->image):url('upload/page-title.jpg') }}" alt="photo" width="100%" >
                        </div> 
    
                      
    
                    <div class="form-group col-xl-12 col-lg-12  col-md-12">
                        <label for="document">Necessary Documents:</label>
                        @error('document') <span class="text-danger">{{ $message }}</span> @enderror
                        <textarea name="document" id="document">{{ old('document')}}</textarea>
                    </div>

                    <div class="col-xl-12 col-lg-6 col-md-6 col-sm-12 mt-3">
                        <button type="submit" class="add-to-cart btn btn-success btn-block"><i class="fas fa-plus"></i> Add Visa</button>
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
            $('#timage').change(function(e){
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
                $('#description').summernote({
                    placeholder: 'Please some content here'
                });
                $('#document').summernote({
                    placeholder: 'Please some content here'
                });
                $('#t_document').summernote({
                    placeholder: 'Please some content here'
                });
            });
        });
        /* ============== Summernote Added ============ */
    </script>
    <script>
        $(document).ready(function() {
            $('#visa_type').change(function() {
                var selectedVisa = $(this).val();
                // alert(selectedVisa);
                $('[id$="_visa_div"]').hide(); // Hide all visa divs
                if (selectedVisa === '1') {
                    $('#tourist_visa_div').show(); // Show the work permit visa di
                } else if (selectedVisa === '2') {
                    $('#work_visa_div').show(); // Show the tourist visa div
                }else {
                    // Handle case when no visa type is selected
                }
            });
        });
    </script>
@endpush
