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
            <p class="card-title my-0">{{ $pageTitle ?? 'Page Title' }}</p>
            <div class="d-flex">
                <a href="{{ route('admin.visa.request.list') }}" class="btn btn-danger me-2">
                    <i class="fas fa-list d-inline"></i> Request Visa List
                </a>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered">
                    @php
                        $agent_name = App\Models\User::where('id', $visa->user_id)->first();
                    @endphp
                    @if ($visa->request_visa_type == 1)
                        <tr>
                            <td>Agent Name</td>
                            <td>{{ $agent_name->company_name ?? 'n/a' }}</td>
                        </tr>
                        <tr>
                            <td>Applicants Name</td>
                            <td>{{ $visa->applicant->first_name ?? 'NULL' }}</td>
                        </tr>
                        <tr>
                            <td>App ID</td>
                            <td>{{ $visa->app_id ?? 'NULL' }}</td>
                        </tr>
                        <tr>
                            <td>Partner Name</td>
                            <td>{{ $visa->partner_name ?? 'NULL' }}</td>
                        </tr>
                        <tr>
                            <td>Visa Type</td>
                            <td>
                                @if ($visa->visa_type == 1)
                                    <span class="badge bg-pill bg-success">Student Visa</span>
                                @elseif($visa->visa_type == 2)
                                    <span class="badge bg-pill bg-danger">Work Permit Visa</span>
                                @elseif($visa->visa_type == 3)
                                    <span class="badge bg-pill bg-danger">Medical Visa</span>
                                @elseif($visa->visa_type == 4)
                                    <span class="badge bg-pill bg-danger">Tourist Visa</span>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <td>Country Name</td>
                            <td>{{ $visa->university_name ?? 'NULL' }}</td>
                        </tr>
                        <tr>
                            <td>Program Name</td>
                            <td>
                                @if ($visa->program_name == 1)
                                    <span class="badge bg-pill bg-success">Diploma</span>
                                @elseif($visa->program_name == 2)
                                    <span class="badge bg-pill bg-danger">Bachelor</span>
                                @elseif($visa->program_name == 3)
                                    <span class="badge bg-pill bg-danger">Nursing</span>
                                @elseif($visa->program_name == 4)
                                    <span class="badge bg-pill bg-danger">MBBS</span>
                                @elseif($visa->program_name == 5)
                                    <span class="badge bg-pill bg-danger">Masters</span>
                                @elseif($visa->program_name == 6)
                                    <span class="badge bg-pill bg-danger">PHD</span>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <td>Intake</td>
                            <td>{{ $visa->intake ?? 'NULL' }}</td>
                        </tr>
                        <tr>
                            <td>Application Date</td>
                            <td>{{ $visa->application_date ?? 'NULL' }}</td>
                        </tr>
                        <tr>
                            <td>Application Fee</td>
                            <td>{{ $visa->application_fee ?? 'NULL' }}</td>
                        </tr>
                        <tr>
                            <td>Phone</td>
                            <td>{{ $visa->phone ?? 'NULL' }}</td>
                        </tr>
                        <tr>
                            <td>Email</td>
                            <td>{{ $visa->email ?? 'NULL' }}</td>
                        </tr>
                        <tr>
                            <td>Nid Photo</td>
                            <td>
                                @php
                                    $pdfPath = asset('upload/nidphoto/' . $visa->nid_photo); // Generate the URL to the uploaded file
                                @endphp
                                @if ($visa->nid_photo && file_exists(public_path('upload/nidphoto/' . $visa->nid_photo)))
                                    <a class="btn btn-success btn-sm mt-2 mb-2" href="{{ $pdfPath }}" target="_blank">
                                        <i class="fa fa-share fa-1x"></i> View Nid Photo
                                    </a>
                                @else
                                    <a class="btn btn-danger btn-sm mt-2 mb-2" href="{{ route('user.visa.index') }}">
                                        <i class="fa fa-share fa-1x"></i> No Nid Photo
                                    </a>
                                @endif
                            </td>
                        <tr>
                            <td>Passport Photo</td>
                            <td>
                                @php
                                    $pdfPath = asset('upload/passportphoto/' . $visa->passport_photo); // Generate the URL to the uploaded file
                                @endphp
                                @if ($visa->passport_photo && file_exists(public_path('upload/passportphoto/' . $visa->passport_photo)))
                                    <a class="btn btn-success btn-sm mt-2 mb-2" href="{{ $pdfPath }}" target="_blank">
                                        <i class="fa fa-share fa-1x"></i> View Passport Photo
                                    </a>
                                @else
                                    <a class="btn btn-danger btn-sm mt-2 mb-2" href="{{ route('user.visa.index') }}">
                                        <i class="fa fa-share fa-1x"></i> No Passport Photo
                                    </a>
                                @endif
                            </td>

                        </tr>
                        <tr>
                            <td>Documents</td>
                            <td>
                                @php
                                    $pdfPath = asset('storage') . '/' . $visa->documents;
                                @endphp
                                @if ($visa->documents && Storage::disk('public')->exists($visa->documents))
                                    <a class="btn btn-success btn-sm mt-2 mb-2" href="{{ $pdfPath }}"
                                        target="_blank"><i class="fa fa-share fa-1x"></i> View Documents</a>
                                @else
                                    {{-- Handle the case when the PDF file is null or does not exist --}}
                                    <a class="btn btn-danger btn-sm mt-2 mb-2" wire:navigate
                                        href="{{ route('user.visa.index') }}"><i class="fa fa-share fa-1x"></i> No
                                        Documents Found</a>
                                    {{-- For example, redirect to the same page --}}
                                @endif
                            </td>
                        </tr>
                        @php
                            $pdfFields = [
                                'passport_pdf' => 'Passport PDF',
                                'nid_pdf' => 'NID PDF',
                                'photo_pdf' => 'Photo PDF',
                                'cv_pdf' => 'CV PDF',
                                'police_pdf' => 'Police Clearance PDF',
                                'recommendation_pdf' => 'Recommendation PDF',
                                'ssc_pdf' => 'SSC PDF',
                                'hsc_pdf' => 'HSC PDF',
                                'honours_pdf' => 'Honours PDF',
                            ];
                        @endphp

                        @foreach ($pdfFields as $field => $label)
                            <tr>
                                <th>{{ $label }}</th>
                                <td>
                                    @if ($visa->$field && Storage::disk('public')->exists($visa->$field))
                                        <a href="{{ asset('storage/' . $visa->$field) }}" target="_blank"
                                            class="btn btn-success btn-sm">
                                            <i class="fa fa-eye"></i> View {{ $label }}
                                        </a>
                                    @else
                                        <button class="btn btn-danger btn-sm" disabled>
                                            <i class="fa fa-times"></i> No File Found
                                        </button>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                        <tr>
                            <td>Status</td>
                            <td>
                                @if ($visa->status == 1)
                                    <span class="badge bg-pill bg-warning">Pending</span>
                                @elseif($visa->status == 2)
                                    <span class="badge bg-pill bg-danger">Apply</span>
                                @elseif($visa->status == 3)
                                    <span class="badge bg-pill bg-info">Processing</span>
                                @elseif($visa->status == 4)
                                    <span class="badge bg-pill bg-success">Success</span>
                                @endif
                            </td>
                        </tr>
                    @elseif($visa->request_visa_type == 2)
                        @php
                            $wname = App\Models\Applicant::where('id', $visa->w_applicant_id)->first();
                        @endphp
                        <tr>
                            <td>Agent Name</td>
                            <td>{{ $agent_name->company_name ?? 'n/a' }}</td>
                        </tr>
                        <tr>
                            <td>Applicants Name</td>
                            <td>{{ $wname->first_name ?? 'NULL' }}</td>
                        </tr>
                        <tr>
                            <td>Passport Number</td>
                            <td>{{ $visa->passport_number ?? 'NULL' }}</td>
                        </tr>
                        <tr>
                            <td>Phone</td>
                            <td>{{ $visa->w_phone ?? 'NULL' }}</td>
                        </tr>
                        <tr>
                            <td>Country Name</td>
                            <td>{{ $visa->country_name ?? 'NULL' }}</td>
                        </tr>
                        <tr>
                            <td>Works Types</td>
                            <td>{{ $visa->work_types ?? 'NULL' }}</td>
                        </tr>
                        <tr>
                            <td>Works Experience</td>
                            <td>{{ $visa->work_experience ?? 'NULL' }}</td>
                        </tr>
                        <tr>
                            <td>Processing Time</td>
                            <td>{{ $visa->processing_time ?? 'NULL' }}</td>
                        </tr>
                        <tr>
                            <td>Agent Name</td>
                            <td>{{ $visa->agent_name ?? 'NULL' }}</td>
                        </tr>
                        <tr>
                            <td>Agent Price</td>
                            <td class="font-weight-bolder">৳{{ $visa->agent_price ?? '0.00' }}</td>
                        </tr>
                        <tr>
                            <td>Customer Price</td>
                            <td class="font-weight-bolder">৳{{ $visa->customer_price ?? '0.00' }}</td>
                        </tr>
                        <tr>
                            <td>Advance With Pay</td>
                            <td class="font-weight-bolder">৳{{ $visa->advance_pay ?? '0.00' }}</td>
                        </tr>
                        <tr>
                            <td>Nid Photo</td>
                            <td>
                                @php
                                    $pdfPath = asset('upload/nidphoto/' . $visa->w_nid_photo); // Generate the URL to the uploaded file
                                @endphp
                                @if ($visa->w_nid_photo && file_exists(public_path('upload/nidphoto/' . $visa->w_nid_photo)))
                                    <a class="btn btn-success btn-sm mt-2 mb-2" href="{{ $pdfPath }}" target="_blank">
                                        <i class="fa fa-share fa-1x"></i> View Nid Photo
                                    </a>
                                @else
                                    <a class="btn btn-danger btn-sm mt-2 mb-2" href="{{ route('user.visa.index') }}">
                                        <i class="fa fa-share fa-1x"></i> No Nid Photo
                                    </a>
                                @endif
                            </td>
                        <tr>
                            <td>Passport Photo</td>
                            <td>
                                @php
                                    $pdfPath = asset('upload/passportphoto/' . $visa->w_passport_photo); // Generate the URL to the uploaded file
                                @endphp
                                @if ($visa->w_passport_photo && file_exists(public_path('upload/passportphoto/' . $visa->w_passport_photo)))
                                    <a class="btn btn-success btn-sm mt-2 mb-2" href="{{ $pdfPath }}" target="_blank">
                                        <i class="fa fa-share fa-1x"></i> View Passport Photo
                                    </a>
                                @else
                                    <a class="btn btn-danger btn-sm mt-2 mb-2" href="{{ route('user.visa.index') }}">
                                        <i class="fa fa-share fa-1x"></i> No Passport Photo
                                    </a>
                                @endif
                            </td>

                        </tr>
                        <tr>
                            <td>Payment Slip</td>
                            <td>
                                <img src="{{ !empty($visa->payment_slip) ? url('upload/paymentslip/' . $visa->payment_slip) : url('upload/no_image.jpg') }}"
                                    width="80" alt="image" class="img-fluid">
                            </td>
                        </tr>

                        <tr>
                            <td>Documents</td>
                            <td>
                                @php
                                    $pdfPath = asset('storage') . '/' . $visa->wdocuments;
                                @endphp
                                @if ($visa->wdocuments && Storage::disk('public')->exists($visa->wdocuments))
                                    <a class="btn btn-success btn-sm mt-2 mb-2" href="{{ $pdfPath }}"
                                        target="_blank"><i class="fa fa-share fa-1x"></i> View Documents</a>
                                @else
                                    {{-- Handle the case when the PDF file is null or does not exist --}}
                                    <a class="btn btn-danger btn-sm mt-2 mb-2" wire:navigate
                                        href="{{ route('user.visa.index') }}"><i class="fa fa-share fa-1x"></i> No
                                        Documents Found</a>
                                    {{-- For example, redirect to the same page --}}
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <td>Experience Documents</td>
                            <td>
                                @php
                                    $pdfPath = asset('storage') . '/' . $visa->w_excdocument;
                                @endphp
                                @if ($visa->w_excdocument && Storage::disk('public')->exists($visa->w_excdocument))
                                    <a class="btn btn-success btn-sm mt-2 mb-2" href="{{ $pdfPath }}"
                                        target="_blank"><i class="fa fa-share fa-1x"></i> View Documents</a>
                                @else
                                    {{-- Handle the case when the PDF file is null or does not exist --}}
                                    <a class="btn btn-danger btn-sm mt-2 mb-2" wire:navigate
                                        href="{{ route('user.visa.index') }}"><i class="fa fa-share fa-1x"></i> No
                                        Documents Found</a>
                                    {{-- For example, redirect to the same page --}}
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <td>Status</td>
                            <td>
                                @if ($visa->status == 1)
                                    <span class="badge bg-pill bg-warning">Pending</span>
                                @elseif($visa->status == 2)
                                    <span class="badge bg-pill bg-danger">Apply</span>
                                @elseif($visa->status == 3)
                                    <span class="badge bg-pill bg-info">Processing</span>
                                @elseif($visa->status == 4)
                                    <span class="badge bg-pill bg-success">Success</span>
                                @endif
                            </td>
                        </tr>
                    @elseif($visa->request_visa_type == 3)
                        <tr>
                            <td>Agent Name</td>
                            <td>{{ $agent_name->company_name ?? 'n/a' }}</td>
                        </tr>
                        <tr>
                            <td>Clients Name</td>
                            <td>{{ $visa->clients_name ?? 'NULL' }}</td>
                        </tr>
                        <tr>
                            <td>Passport Number</td>
                            <td>{{ $visa->m_passport_number ?? 'NULL' }}</td>
                        </tr>
                        <tr>
                            <td>Phone</td>
                            <td>{{ $visa->m_phone ?? 'NULL' }}</td>
                        </tr>
                        <tr>
                            <td>Visa Type</td>
                            <td>
                                @if ($visa->m_visa_type == 1)
                                    <span class="badge bg-pill bg-success">Student Visa</span>
                                @elseif($visa->m_visa_type == 2)
                                    <span class="badge bg-pill bg-danger">Work Permit Visa</span>
                                @elseif($visa->m_visa_type == 3)
                                    <span class="badge bg-pill bg-danger">Medical Visa</span>
                                @elseif($visa->m_visa_type == 4)
                                    <span class="badge bg-pill bg-danger">Tourist Visa</span>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <td>Visa Duration</td>
                            <td>{{ $visa->visa_duration ?? 'NULL' }}</td>
                        </tr>
                        <tr>
                            <td>Processing Time</td>
                            <td>{{ $visa->m_processing_time ?? 'NULL' }}</td>
                        </tr>
                        <tr>
                            <td>Agent Name</td>
                            <td>{{ $visa->m_agent_name ?? 'NULL' }}</td>
                        </tr>
                        <tr>
                            <td>Agent Price</td>
                            <td class="font-weight-bolder">৳{{ $visa->m_agent_price ?? '0.00' }}</td>
                        </tr>
                        <tr>
                            <td>Customer Price</td>
                            <td class="font-weight-bolder">৳{{ $visa->m_customer_price ?? '0.00' }}</td>
                        </tr>
                        @php
                            $pdfFields = [
                                'mpassport_pdf' => 'Mother Passport PDF',
                                'mphoto_pdf' => 'Mother Photo PDF',
                                'mmedical_pdf' => 'Mother Medical PDF',
                            ];
                        @endphp

                        @foreach ($pdfFields as $field => $label)
                            <tr>
                                <th>{{ $label }}</th>
                                <td>
                                    @if ($visa->$field && Storage::disk('public')->exists($visa->$field))
                                        <a href="{{ asset('storage/' . $visa->$field) }}" target="_blank"
                                            class="btn btn-success btn-sm">
                                            <i class="fa fa-eye"></i> View {{ $label }}
                                        </a>
                                    @else
                                        <button class="btn btn-danger btn-sm" disabled>
                                            <i class="fa fa-times"></i> No File Found
                                        </button>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                        <tr>
                            <td>Status</td>
                            <td>
                                @if ($visa->status == 1)
                                    <span class="badge bg-pill bg-warning">Pending</span>
                                @elseif($visa->status == 2)
                                    <span class="badge bg-pill bg-danger">Apply</span>
                                @elseif($visa->status == 3)
                                    <span class="badge bg-pill bg-info">Processing</span>
                                @elseif($visa->status == 4)
                                    <span class="badge bg-pill bg-success">Success</span>
                                @endif
                            </td>
                        </tr>
                    @elseif($visa->request_visa_type == 4)
                        <tr>
                            <td>Agent Name</td>
                            <td>{{ $agent_name->company_name ?? 'n/a' }}</td>
                        </tr>
                        <tr>
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
                        </tr>
                        <tr>
                            <td>Visa Type</td>
                            <td>
                                @if ($visa->t_visa_type == 1)
                                    <span class="badge bg-pill bg-success">Student Visa</span>
                                @elseif($visa->t_visa_type == 2)
                                    <span class="badge bg-pill bg-danger">Work Permit Visa</span>
                                @elseif($visa->t_visa_type == 3)
                                    <span class="badge bg-pill bg-danger">Medical Visa</span>
                                @elseif($visa->t_visa_type == 4)
                                    <span class="badge bg-pill bg-danger">Tourist Visa</span>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <td>Visa Duration</td>
                            <td>{{ $visa->t_visa_duration ?? 'NULL' }}</td>
                        </tr>
                        <tr>
                            <td>Processing Time</td>
                            <td>{{ $visa->t_processing_time ?? 'NULL' }}</td>
                        </tr>
                        <tr>
                            <td>Agent Name</td>
                            <td>{{ $visa->t_agent_name ?? 'NULL' }}</td>
                        </tr>
                        <tr>
                            <td>Agent Price</td>
                            <td class="font-weight-bolder">৳{{ $visa->t_agent_price ?? '0.00' }}</td>
                        </tr>
                        <tr>
                            <td>Customer Price</td>
                            <td class="font-weight-bolder">৳{{ $visa->t_customer_price ?? '0.00' }}</td>
                        </tr>
                        <tr>
                            <td>Status</td>
                            <td>
                                @if ($visa->status == 1)
                                    <span class="badge bg-pill bg-warning">Pending</span>
                                @elseif($visa->status == 2)
                                    <span class="badge bg-pill bg-danger">Apply</span>
                                @elseif($visa->status == 3)
                                    <span class="badge bg-pill bg-info">Processing</span>
                                @elseif($visa->status == 4)
                                    <span class="badge bg-pill bg-success">Success</span>
                                @endif
                            </td>
                        </tr>
                    @elseif($visa->request_visa_type == 5)
                        <tr>
                            <td>Customer Name</td>
                            <td>{{ $visa->customer_name ?? 'NULL' }}</td>
                        </tr>
                        <tr>
                            <td>Customer Phone</td>
                            <td>{{ $visa->customer_phone ?? 'NULL' }}</td>
                        </tr>
                        <tr>
                            <td>Customer Address</td>
                            <td>{{ $visa->customer_address ?? 'NULL' }}</td>
                        </tr>
                        <tr>
                            <td>Setup Charge</td>
                            <td class="font-weight-bolder">৳{{ $visa->setup_charge ?? '0.00' }}</td>
                        </tr>
                        <tr>
                            <td>Monthly Fee</td>
                            <td class="font-weight-bolder">৳{{ $visa->monthly_fee ?? '0.00' }}</td>
                        </tr>
                        <tr>
                            <td>Software Type</td>
                            <td>
                                @if ($visa->software_type == 1)
                                    <span class="badge bg-pill bg-warning">Coaching Software</span>
                                @elseif($visa->software_type == 2)
                                    <span class="badge bg-pill bg-danger">Private Management Software</span>
                                @elseif($visa->software_type == 3)
                                    <span class="badge bg-pill bg-info">School Management Software</span>
                                @elseif($visa->software_type == 4)
                                    <span class="badge bg-pill bg-secondary">Super Shop Software</span>
                                @elseif($visa->software_type == 5)
                                    <span class="badge bg-pill bg-success">Mobile Showroom Software</span>
                                @elseif($visa->software_type == 6)
                                    <span class="badge bg-pill bg-warning">Computer Showroom Software</span>
                                @elseif($visa->software_type == 7)
                                    <span class="badge bg-pill bg-danger">Pharmacy Software</span>
                                @elseif($visa->software_type == 8)
                                    <span class="badge bg-pill bg-info">Ecommerce Website</span>
                                @elseif($visa->software_type == 9)
                                    <span class="badge bg-pill bg-secondary">Company Website</span>
                                @elseif($visa->software_type == 10)
                                    <span class="badge bg-pill bg-danger">Dealer Software</span>
                                @elseif($visa->software_type == 11)
                                    <span class="badge bg-pill bg-info">POS Software</span>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <td>Status</td>
                            <td>
                                @if ($visa->status == 1)
                                    <span class="badge bg-pill bg-warning">Pending</span>
                                @elseif($visa->status == 2)
                                    <span class="badge bg-pill bg-danger">Apply</span>
                                @elseif($visa->status == 3)
                                    <span class="badge bg-pill bg-info">Processing</span>
                                @elseif($visa->status == 4)
                                    <span class="badge bg-pill bg-success">Success</span>
                                @endif
                            </td>
                        </tr>
                    @endif
                </table>
            </div>
        </div>
    </div>
@endsection
