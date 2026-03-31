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
                <div class="row">
                    <div class="col-md-12">
                        <table class="table table-bordered">
                             <tr>
                                <th width="200">Country Name</th>
                                <td>{{ $studentVisa->country_name }}</td>
                             </tr>
                             <tr>
                                <th>Slug</th>
                                <td>{{ $studentVisa->slug }}</td>
                             </tr>
                             <tr>
                                <th>Flag</th>
                                <td>
                                    <img src="{{ $studentVisa->flug ? asset('upload/student_visa/'.$studentVisa->flug) : asset('upload/no_image.jpg') }}"
                                         width="80" alt="Flag">
                                </td>
                             </tr>
                             <tr>
                                <th>University Logo</th>
                                <td>
                                    <img src="{{ $studentVisa->logo ? asset('upload/student_visa/'.$studentVisa->logo) : asset('upload/no_image.jpg') }}"
                                         width="80" alt="Logo">
                                </td>
                             </tr>
                             <tr>
                                <th>Program</th>
                                <td>{{ $studentVisa->program ?? 'N/A' }}</td>
                             </tr>
                             <tr>
                                <th>University Name</th>
                                <td>{{ $studentVisa->versity_name ?? 'N/A' }}</td>
                             </tr>
                             <tr>
                                <th>Intake</th>
                                <td>{{ $studentVisa->intake ?? 'N/A' }}</td>
                             </tr>
                             <tr>
                                <th>IELTS Requirement</th>
                                <td>{{ $studentVisa->ielts ?? 'N/A' }}</td>
                             </tr>
                             <tr>
                                <th>Application Fee</th>
                                <td>{{ number_format($studentVisa->application_fee, 2) }}</td>
                             </tr>
                             <tr>
                                <th>Average Tuition Fee</th>
                                <td>{{ number_format($studentVisa->averse_tution_fee, 2) }}</td>
                             </tr>
                             <tr>
                                <th>Accommodation Cost</th>
                                <td>{{ number_format($studentVisa->acommodation_cost, 2) }}</td>
                             </tr>
                             <tr>
                                <th>Processing Time</th>
                                <td>{{ $studentVisa->processing_time ?? 'N/A' }}</td>
                             </tr>
                             <tr>
                                <th>Medical Fee</th>
                                <td>{{ number_format($studentVisa->medical_fee, 2) }}</td>
                             </tr>
                             <tr>
                                <th>Service Charge</th>
                                <td>{{ $studentVisa->service_charge ?? 'N/A' }}</td>
                             </tr>
                             <tr>
                                <th>Status</th>
                                <td>
                                    @if($studentVisa->status)
                                        <span class="badge bg-success">Active</span>
                                    @else
                                        <span class="badge bg-danger">Inactive</span>
                                    @endif
                                </td>
                             </tr>
                             <tr>
                                <th>Documents</th>
                                <td>{!! $studentVisa->documents !!}</td>
                             </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection