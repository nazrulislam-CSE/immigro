@extends('layouts.admin.app', [$pageTitle => 'Page Title'])

@section('content')
 <!-- Content Header (Page header) -->
 <div class="breadcrumb-header justify-content-between">
    <div class="d-flex align-items-center">
        {{-- <h4 class="content-title mb-2">Hi, welcome back!</h4> --}}
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0);">Pages</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{ $pageTitle ?? 'Page Title' }}</li>
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

 <!-- Main content -->
 <div class="card card-primary card-outline shadow-lg mb-4">
    <div class="card-header border-bottom d-flex justify-content-between align-items-center">
       <p class="card-title my-0">{{ $pageTitle ?? 'Page Title'}}</p>
       <div class="d-flex">
           <a href="{{ route('admin.education.index')}}" class="btn btn-danger me-2">
               <i class="fas fa-list d-inline"></i> Education List
           </a>
       </div>
   </div>
    <div class="card-body">
       <div class="table-responsive">
          <table class="table table-bordered">
             <tr>
                <td>Course Name</td>
                <td>{{ $education->course_name ?? 'NULL' }}</td>
             </tr>
             <tr>
                <td>Course Fee</td>
                <td class="font-weight-bolder">৳{{ $education->course_fee ?? 'NULL' }}</td>
             </tr>
             <tr>
                <td>Discount</td>
                <td class="font-weight-bolder">৳{{ $education->discount ?? 'NULL' }}</td>
             </tr>
             <tr>
                <td>Gross Course Fee</td>
                <td class="font-weight-bolder">৳{{ $education->gross_course_fee ?? 'NULL' }}</td>
             </tr>
             <tr>
                <td>Duration</td>
                <td>{{ $education->duration ?? 'NULL' }}</td>
             </tr>
             <tr>
                <td>Coordinator Name</td>
                <td>{{ $education->coordinator_name ?? 'NULL' }}</td>
             </tr>
             <tr>
                <td>Coordinator Photo</td>
                <td>
                    <img src="{{ (!empty($education->coordinator_photo)) ? url('upload/education/'.$education->coordinator_photo):url('upload/no_image.jpg') }}" width="80" alt="image" class="img-fluid">
                </td>
             </tr>
             <tr>
                <td>Experience</td>
                <td>{{ $education->experience ?? 'NULL' }}</td>
             </tr>
             <tr>
                <td>Course Meterials</td>
                <td>{!! $education->course_materials ?? 'NULL' !!}</td>
             </tr>
             <tr>
                <td>Study Type</td>
                <td>
                    @if($education->study_type == 1)
                        <span class="badge bg-pill bg-success">Spoken</span>
                    @elseif($education->study_type == 2)
                        <span class="badge bg-pill bg-danger">Kids Spoken</span>
                    @elseif($education->study_type == 3)
                        <span class="badge bg-pill bg-info">IELTS</span>
                    @elseif($education->study_type == 4)
                        <span class="badge bg-pill bg-warning">Japanese</span>
                    @elseif($education->study_type == 5)
                        <span class="badge bg-pill bg-warning">Korean</span>
                    @else
                        <span class="badge bg-pill bg-secondary">Diploma In English</span>
                    @endif
                </td>
             </tr>
             <tr>
                <td>Status</td>
                <td>
                    @if ($education->status == 1)
                    <span class="badge bg-pill bg-success">Active</span>
                    @else
                    <span class="badge bg-pill bg-success">Disable</span>
                    @endif
   
                </td>
             </tr>
             <tr>
                <td>Photo</td>
                <td>
                    <img src="{{ (!empty($education->image)) ? url('upload/education/'.$education->image):url('upload/no_image.jpg') }}" width="80" alt="image" class="img-fluid">
                </td>
             </tr>
             <tr>
                <td>Course Banner</td>
                <td>
                    <img src="{{ (!empty($education->banner)) ? url('upload/education/'.$education->banner):url('upload/page-title.jpg') }}" width="100%" alt="image" class="img-fluid">
                </td>
             </tr>
          </table>
       </div>
    </div>
 </div>
@endsection
