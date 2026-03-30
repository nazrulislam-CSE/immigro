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
        <!-- Row -->
            <div class="row row-sm">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header border-bottom d-flex justify-content-between align-items-center">
                            <p class="card-title my-0">{{ $pageTitle ?? 'Page Title'}} <span class="badge bg-danger side-badge" style="font-size:17px;">{{ count($visas) }}</span> </p>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="file-datatable" class="border-top-0  table table-bordered text-nowrap key-buttons border-bottom">
                                    <thead>
                                        <tr>
                                            <th class="border-bottom-0">SL</th>
                                            <th class="border-bottom-0">Documents</th>
                                            <th class="border-bottom-0">Agent Name</th>
                                            <th class="border-bottom-0">Amount</th>
                                            <th class="border-bottom-0">Commission</th>
                                            {{-- <th class="border-bottom-0">Total Amount</th> --}}
                                            <th class="border-bottom-0">Applicants Name</th>
                                            <th class="border-bottom-0">Phone</th>
                                            <th class="border-bottom-0">Visa Type</th>
                                            {{-- <th class="border-bottom-0">Application Fee</th>
                                            <th class="border-bottom-0">Agent Name</th>
                                            <th class="border-bottom-0">Agent Price</th>
                                            <th class="border-bottom-0">Customer Price</th>
                                            <th class="border-bottom-0">Advance Pay</th> --}}
                                            <th class="border-bottom-0">Status</th>
                                            <th class="border-bottom-0">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($visas as $key=> $visa)
                                        <tr>
                                            <td class="col-1">{{ $key+1 }}</td>
                                            <td class="text-center">
                                                @if($visa->request_visa_type == 1)
                                                    @php
                                                        $pdfPath = asset('storage').'/'.$visa->documents;
                                                    @endphp
                                                    @if($visa->documents && Storage::disk('public')->exists($visa->documents))
                                                        <a class="btn btn-success btn-sm mt-2 mb-2" href="{{ $pdfPath }}" target="_blank"><i class="fa fa-share fa-1x"></i> View Documents</a>
                                                    @else
                                                        {{-- Handle the case when the PDF file is null or does not exist --}}
                                                        <a  class="btn btn-danger btn-sm mt-2 mb-2" wire:navigate href="{{ route('user.visa.index') }}"><i class="fa fa-share fa-1x"></i> No Documents Found</a>
                                                        {{-- For example, redirect to the same page --}}
                                                    @endif
                                                @elseif($visa->request_visa_type == 2)
                                                    @php
                                                        $pdfPath = asset('storage').'/'.$visa->wdocuments;
                                                    @endphp
                                                    @if($visa->wdocuments && Storage::disk('public')->exists($visa->wdocuments))
                                                        <a class="btn btn-success btn-sm mt-2 mb-2" href="{{ $pdfPath }}" target="_blank"><i class="fa fa-share fa-1x"></i> View Documents</a>
                                                    @else
                                                        {{-- Handle the case when the PDF file is null or does not exist --}}
                                                        <a  class="btn btn-danger btn-sm mt-2 mb-2" wire:navigate href="{{ route('user.visa.index') }}"><i class="fa fa-share fa-1x"></i> No Documents Found</a>
                                                        {{-- For example, redirect to the same page --}}
                                                    @endif
                                                @elseif($visa->request_visa_type == 3)
                                                    @php
                                                        $pdfPath = asset('storage').'/'.$visa->wdocuments;
                                                    @endphp
                                                    @if($visa->wdocuments && Storage::disk('public')->exists($visa->wdocuments))
                                                        <a class="btn btn-success btn-sm mt-2 mb-2" href="{{ $pdfPath }}" target="_blank"><i class="fa fa-share fa-1x"></i> View Documents</a>
                                                    @else
                                                        {{-- Handle the case when the PDF file is null or does not exist --}}
                                                        <a  class="btn btn-danger btn-sm mt-2 mb-2" wire:navigate href="{{ route('user.visa.index') }}"><i class="fa fa-share fa-1x"></i> No Documents Found</a>
                                                        {{-- For example, redirect to the same page --}}
                                                    @endif
                                                @elseif($visa->request_visa_type == 4)
                                                    @php
                                                        $pdfPath = asset('storage').'/'.$visa->wdocuments;
                                                    @endphp
                                                    @if($visa->wdocuments && Storage::disk('public')->exists($visa->wdocuments))
                                                        <a class="btn btn-success btn-sm mt-2 mb-2" href="{{ $pdfPath }}" target="_blank"><i class="fa fa-share fa-1x"></i> View Documents</a>
                                                    @else
                                                        {{-- Handle the case when the PDF file is null or does not exist --}}
                                                        <a  class="btn btn-danger btn-sm mt-2 mb-2" wire:navigate href="{{ route('user.visa.index') }}"><i class="fa fa-share fa-1x"></i> No Documents Found</a>
                                                        {{-- For example, redirect to the same page --}}
                                                    @endif
                                                @elseif($visa->request_visa_type == 5)
                                                    @php
                                                        $pdfPath = asset('storage').'/'.$visa->wdocuments;
                                                    @endphp
                                                    @if($visa->wdocuments && Storage::disk('public')->exists($visa->wdocuments))
                                                        <a class="btn btn-success btn-sm mt-2 mb-2" href="{{ $pdfPath }}" target="_blank"><i class="fa fa-share fa-1x"></i> View Documents</a>
                                                    @else
                                                        {{-- Handle the case when the PDF file is null or does not exist --}}
                                                        <a  class="btn btn-danger btn-sm mt-2 mb-2" wire:navigate href="{{ route('user.visa.index') }}"><i class="fa fa-share fa-1x"></i> No Documents Found</a>
                                                        {{-- For example, redirect to the same page --}}
                                                    @endif
                                                @endif
                                            </td>
                                            @php
                                                $agent_name = App\Models\User::where('id',$visa->user_id)->first();
                                            @endphp
                                            <td>{{ $agent_name->company_name ?? 'n/a'}}</td>
                                            <td class="font-weight-bolder">৳{{ $visa->amount ?? '0.00'}}</td>
                                            <td class="font-weight-bolder">৳{{ $visa->commission_amount ?? '0.00'}}</td>
                                            {{-- <td>{{ $agent_name->total_amount ?? '0.00'}}</td> --}}
                                            @php
                                                $wname = App\Models\Applicant::where('id',$visa->w_applicant_id)->first();
                                            @endphp
                                            @if($visa->request_visa_type == 1)
                                                <td>{{ $visa->applicant->first_name ?? 'Null'}}</td>
                                            @elseif($visa->request_visa_type == 2)
                                                <td>{{ $wname->first_name ?? 'Null'}}</td>
                                            @elseif($visa->request_visa_type == 3)
                                                <td>{{ $visa->clients_name ?? 'Null'}}</td>
                                            @elseif($visa->request_visa_type == 4)
                                                <td>{{ $visa->t_clients_name ?? 'Null'}}</td>
                                            @elseif($visa->request_visa_type == 5)
                                                <td>{{ $visa->customer_name ?? 'Null'}}</td>
                                            @endif
                                            @if($visa->request_visa_type == 1)
                                                <td>{{ $visa->phone ?? 'Null'}}</td>
                                            @elseif($visa->request_visa_type == 2)
                                                <td>{{ $visa->w_phone ?? 'Null'}}</td>
                                            @elseif($visa->request_visa_type == 3)
                                                <td>{{ $visa->m_phone ?? 'Null'}}</td>
                                            @elseif($visa->request_visa_type == 4)
                                                <td>{{ $visa->t_phone ?? 'Null'}}</td>
                                            @elseif($visa->request_visa_type == 5)
                                                <td>{{ $visa->customer_phone ?? 'Null'}}</td>
                                            @endif
                                           
                                            {{-- <td>{{ $visa->application_fee ?? 'Null'}}</td>
                                            <td>{{ $visa->agent_name ?? 'Null'}}</td>
                                            <td>{{ $visa->agent_price ?? 'Null'}}</td>
                                            <td>{{ $visa->customer_price ?? 'Null'}}</td>
                                            <td>{{ $visa->advance_pay ?? 'Null'}}</td> --}}
                                            
                                            <td>
                                                @if($visa->request_visa_type == 1)
                                                    <span class="badge bg-pill bg-success">Student Visa</span>
                                                @elseif($visa->request_visa_type == 2)
                                                    <span class="badge bg-pill bg-warning">Work Permit Visa</span>
                                                @elseif($visa->request_visa_type == 3)
                                                    <span class="badge bg-pill bg-danger">Medical Visa</span>
                                                @elseif($visa->request_visa_type == 4)
                                                    <span class="badge bg-pill bg-info">Tourist Visa</span>
                                                @elseif($visa->request_visa_type == 5)
                                                    <span class="badge bg-pill bg-info">Software Visa</span>
                                                @endif
                                            </td>
                                            <td>
                                                @if($visa->status == 1)
                                                    <span class="badge bg-pill bg-warning">Pending</span>
                                                @elseif($visa->status == 2)
                                                    <span class="badge bg-pill bg-danger">Apply</span>
                                                @elseif($visa->status == 3)
                                                    <span class="badge bg-pill bg-info">Processing</span>
                                                @elseif($visa->status == 4)
                                                    <span class="badge bg-pill bg-success">Success</span>
                                                @endif
                                            </td>
                                            <td>
                                                <a href="{{ route('admin.visa.request.list.show',$visa->id)}}" class="btn btn-success btn-sm mr-2"><i class="fas fa-eye"></i></a>
                                                <a href="{{ route('admin.visa.request.list.edit',$visa->id)}}" class="btn btn-primary btn-sm mr-2"><i class="fas fa-edit"></i></a>
                                                <a href="#" class="btn btn-danger btn-sm" title="Delete Data" id="delete"><i class="fa fa-trash"></i></a>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End Row -->
    </div>
@endsection
