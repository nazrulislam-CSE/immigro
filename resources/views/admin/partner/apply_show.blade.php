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
           <a href="{{ route('admin.apply.list')}}" class="btn btn-danger me-2">
               <i class="fas fa-list d-inline"></i> Apply List
           </a>
       </div>
   </div>
    <div class="card-body">
       <div class="table-responsive">
          <table class="table table-bordered">
            <tr>
                <td>First Name</td>
                <td>{{ $ielt->first_name ?? 'NULL' }}</td>
             </tr>
             <tr>
                <td>Last Name</td>
                <td>{{ $ielt->last_name ?? 'NULL' }}</td>
             </tr>
             <tr>
                <td>Phone</td>
                <td>{{ $ielt->phone ?? 'NULL' }}</td>
             </tr>
             <tr>
                <td>Email</td>
                <td>{{ $ielt->email ?? 'NULL' }}</td>
             </tr>
             <tr>
                <td>Birth Date</td>
                <td>{{ $ielt->birth_day ?? 'NULL' }}</td>
             </tr>
             <tr>
                <td>School Name</td>
                <td>{{ $ielt->school_name ?? 'NULL' }}</td>
             </tr>
             <tr>
                <td>School Name</td>
                <td>{{ $ielt->school_name ?? 'NULL' }}</td>
             </tr>
             <tr>
                <td> School Passing Year</td>
                <td>{{ $ielt->school_passing_year ?? 'NULL' }}</td>
             </tr>
             <tr>
                <td>School GPA</td>
                <td>{{ $ielt->school_gpa ?? 'NULL' }}</td>
             </tr>
             <tr>
                <td>Collage Name</td>
                <td>{{ $ielt->collage_name ?? 'NULL' }}</td>
             </tr>
             <tr>
                <td> Collage Passing Year</td>
                <td>{{ $ielt->collage_passing_year ?? 'NULL' }}</td>
             </tr>
             <tr>
                <td>Collage GPA</td>
                <td>{{ $ielt->collage_gpa ?? 'NULL' }}</td>
             </tr>
             <tr>
                <td>Department</td>
                <td>{{ $ielt->department ?? 'NULL' }}</td>
             </tr>
             <tr>
                <td>Subject</td>
                <td>{{ $ielt->subject ?? 'NULL' }}</td>
             </tr>
             <tr>
                <td>Country</td>
                <td>{{ $ielt->country ?? 'NULL' }}</td>
             </tr>
             <tr>
                <td>Proficiency</td>
                <td>{{ $ielt->proficiency ?? 'NULL' }}</td>
             </tr>
             <tr>
                <td>Study Type</td>
                <td>{{ $ielt->study_type ?? 'NULL' }}</td>
             </tr>
             <tr>
                <td>Address</td>
                <td>{{ $ielt->address ?? 'NULL' }}</td>
             </tr>
             <tr>
                <td>Village</td>
                <td>{{ $ielt->village ?? 'NULL' }}</td>
             </tr>
             <tr>
                <td>Thana</td>
                <td>{{ $ielt->thana ?? 'NULL' }}</td>
             </tr>
             <tr>
                <td>District</td>
                <td>{{ $ielt->district ?? 'NULL' }}</td>
             </tr>
             <tr>
                <td>Message</td>
                <td>{{ $ielt->message ?? 'NULL' }}</td>
             </tr>
             <tr>
                <td>Status</td>
                <td>
                    @if ($ielt->status == 1)
                    <span class="badge bg-pill bg-success">Active</span>
                    @else
                    <span class="badge bg-pill bg-success">Disable</span>
                    @endif
   
                </td>
             </tr>
          </table>
       </div>
    </div>
 </div>
@endsection
