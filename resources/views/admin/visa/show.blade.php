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
           <a href="{{ route('admin.visa.index')}}" class="btn btn-danger me-2">
               <i class="fas fa-list d-inline"></i> Visa List
           </a>
       </div>
   </div>
    <div class="card-body">
       <div class="table-responsive">
          <table class="table table-bordered">
            @if($visa->visa_type == 1) 
            <tr>
                <td>Country Name</td>
                <td>{{ $visa->t_country_name ?? 'NULL' }}</td>
             </tr>
            {{-- <tr>
                <td>Clients Name</td>
                <td>{{ $visa->t_clients_name ?? 'NULL' }}</td>
             </tr>
             <tr>
                <td>Passport Number</td>
                <td>{{ $visa->t_passport_number ?? 'NULL' }}</td>
             </tr>
             <tr>
                <td>Phone</td>
                <td>{{ $visa->t_phone ?? 'NULL' }}</td>
             </tr> --}}
            <tr>
                <td>Duration Visa</td>
                <td>{{ $visa->t_visa_duration ?? 'NULL' }}</td>
             </tr>
             <tr>
                <td>Processing Time</td>
                <td>{{ $visa->t_processing_time ?? 'NULL' }}</td>
             </tr>
             {{-- <tr>
                <td>Agent Name</td>
                <td>{{ $visa->t_agent_name ?? 'NULL' }}</td>
             </tr> --}}
             {{-- <tr>
                <td>Agent Price</td>
                <td class="font-weight-bolder">৳{{ $visa->t_agent_price ?? '0.00' }}</td>
             </tr> --}}
             <tr>
                <td>Amount</td>
                <td class="font-weight-bolder">৳{{ $visa->t_customer_price ?? '0.00' }}</td>
             </tr>
             <tr>
                <td>Docuemnts</td></td>
                <td>{!! $visa->t_documents ?? 'NULL' !!}</td>
             </tr>
            <tr>
                <td>Visa Type</td>
                <td>
                    <span class="badge bg-pill bg-success">Tourist Visa</span>
                </td>
             </tr>
             <tr>
                <td>Status</td>
                <td>
                    @if ($visa->t_status == 1)
                    <span class="badge bg-pill bg-success">Active</span>
                    @else
                    <span class="badge bg-pill bg-success">Disable</span>
                    @endif
   
                </td>
             </tr>
             <tr>
                <td>Flag</td>
                <td>
                    <img src="{{ (!empty($visa->t_image)) ? url('upload/visa/'.$visa->t_image):url('upload/no_image.jpg') }}" width="80" alt="image" class="img-fluid">
                </td>
             </tr>
             <tr>
                <td>Visa Banner</td>
                <td>
                    <img src="{{ (!empty($visa->t_banner)) ? url('upload/visa/'.$visa->t_banner):url('upload/page-title.jpg') }}" width="100%" alt="image" class="img-fluid">
                </td>
             </tr>
            @else
            <tr>
                <td>Country Name</td>
                <td>{{ $visa->country_name ?? 'NULL' }}</td>
             </tr>
             <tr>
                <td>Work Types</td>
                <td>{{ $visa->work_types ?? 'NULL' }}</td>
             </tr>
             <tr>
                <td>Contact Year</td>
                <td>{{ $visa->contact_year ?? 'NULL' }}</td>
             </tr>
             <tr>
                <td>Overtime</td>
                <td>{{ $visa->overtime ?? 'NULL' }}</td>
             </tr>
             <tr>
                <td>Weekend</td>
                <td>{{ $visa->weekend ?? 'NULL' }}</td>
             </tr>
             <tr>
                <td>Basic Salary</td>
                <td class="font-weight-bolder">৳{{ $visa->basic_salary ?? 'NULL' }}</td>
             </tr>
             <tr>
                <td>Accommodation Cost</td>
                <td class="font-weight-bolder">৳{{ $visa->accommodation_cost ?? 'NULL' }}</td>
             </tr>
             <tr>
                <td>Advance Payment</td>
                <td class="font-weight-bolder">৳{{ $visa->advance_payment ?? 'NULL' }}</td>
             </tr>
             <tr>
                <td>Total Cost</td>
                <td class="font-weight-bolder">৳{{ $visa->total_cost ?? 'NULL' }}</td>
             </tr>
             <tr>
                <td>After Visa</td>
                <td class="font-weight-bolder">৳{{ $visa->after_visa ?? 'NULL' }}</td>
             </tr>
             <tr>
                <td>After Work Permit</td>
                <td class="font-weight-bolder">৳{{ $visa->after_work_permit ?? 'NULL' }}</td>
             </tr>
             <tr>
                <td>Duration Visa</td>
                <td>{{ $visa->duration_visa ?? 'NULL' }}</td>
             </tr>
             <tr>
                <td>Visa Processing Time</td>
                <td>{{ $visa->visa_processing_time ?? 'NULL' }}</td>
             </tr>
             <tr>
                <td>Docuemnts</td></td>
                <td>{!! $visa->documents ?? 'NULL' !!}</td>
             </tr>
             <tr>
                <td>Visa Type</td>
                <td>
                    <span class="badge bg-pill bg-danger">Work Permit Visa</span>
                </td>
             </tr>
             
             <tr>
                <td>Status</td>
                <td>
                    @if ($visa->status == 1)
                    <span class="badge bg-pill bg-success">Active</span>
                    @else
                    <span class="badge bg-pill bg-success">Disable</span>
                    @endif
   
                </td>
             </tr>
             <tr>
                <td>Flag</td>
                <td>
                    <img src="{{ (!empty($visa->image)) ? url('upload/visa/'.$visa->image):url('upload/no_image.jpg') }}" width="80" alt="image" class="img-fluid">
                </td>
             </tr>
             <tr>
                <td>Visa Banner</td>
                <td>
                    <img src="{{ (!empty($visa->banner)) ? url('upload/visa/'.$visa->banner):url('upload/page-title.jpg') }}" width="100%" alt="image" class="img-fluid">
                </td>
             </tr>
             @endif
          </table>
       </div>
    </div>
 </div>
@endsection
