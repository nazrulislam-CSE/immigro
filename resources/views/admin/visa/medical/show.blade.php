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
                    <a href="{{ route('admin.medical.visa.index') }}" class="btn btn-danger me-2">
                        <i class="fas fa-list d-inline"></i> Medical Visa List
                    </a>
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        <table class="table table-bordered">
                            <tr>
                                <th width="200">Country Name</th>
                                <td>{{ $medicalVisa->country_name }}</td>
                            </tr>
                            <tr>
                                <th>Slug</th>
                                <td>{{ $medicalVisa->slug }}</td>
                            </tr>
                            <tr>
                                <th>Flag</th>
                                <td>
                                    <img src="{{ $medicalVisa->flug ? asset('upload/medical_visa/'.$medicalVisa->flug) : asset('upload/no_image.jpg') }}"
                                         width="80" alt="Flag">
                                </td>
                            </tr>
                            <tr>
                                <th>Visa Type</th>
                                <td>{{ $medicalVisa->visa_type ?? 'N/A' }}</td>
                            </tr>
                            <tr>
                                <th>Visa Duration</th>
                                <td>{{ $medicalVisa->visa_duration ?? 'N/A' }}</td>
                            </tr>
                            <tr>
                                <th>Apply Fee</th>
                                <td>{{ number_format($medicalVisa->apply_fee, 2) }}</td>
                            </tr>
                            <tr>
                                <th>Processing Time</th>
                                <td>{{ $medicalVisa->processing_time ?? 'N/A' }}</td>
                            </tr>
                            <tr>
                                <th>Publish Date</th>
                                <td>{{ $medicalVisa->publish_date ? $medicalVisa->publish_date->format('d M Y') : 'N/A' }}</td>
                            </tr>
                            <tr>
                                <th>Service Charge</th>
                                <td>{{ $medicalVisa->service_charge ?? 'N/A' }}</td>
                            </tr>
                            <tr>
                                <th>Visa Fee</th>
                                <td>{{ number_format($medicalVisa->visa_fee, 2) }}</td>
                            </tr>
                            <tr>
                                <th>Status</th>
                                <td>
                                    @if($medicalVisa->status)
                                        <span class="badge bg-success">Active</span>
                                    @else
                                        <span class="badge bg-danger">Inactive</span>
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <th>Documents</th>
                                <td>{!! $medicalVisa->documents !!}</td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection