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
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header border-bottom d-flex justify-content-between align-items-center">
                    <p class="card-title my-0">
                        {{ $pageTitle }}
                        <span class="badge bg-danger side-badge" style="font-size:17px;">{{ count($medicalVisas) }}</span>
                    </p>
                    <div class="d-flex">
                        <a href="{{ route('admin.medical.visa.create') }}" class="btn btn-success me-2">
                            <i class="fas fa-plus d-inline"></i> Add New Medical Visa
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered text-nowrap">
                            <thead>
                                <tr>
                                    <th>SL</th>
                                    <th>Flag</th>
                                    <th>Country</th>
                                    <th>Visa Type</th>
                                    <th>Duration</th>
                                    <th>Apply Fee</th>
                                    <th>Visa Fee</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($medicalVisas as $key => $visa)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>
                                        <img src="{{ $visa->flug ? asset('upload/medical_visa/'.$visa->flug) : asset('upload/no_image.jpg') }}"
                                             width="40" alt="flag">
                                    </td>
                                    <td>{{ $visa->country_name }}</td>
                                    <td>{{ $visa->visa_type ?? 'N/A' }}</td>
                                    <td>{{ $visa->visa_duration ?? 'N/A' }}</td>
                                    <td>{{ number_format($visa->apply_fee, 2) }}</td>
                                    <td>{{ number_format($visa->visa_fee, 2) }}</td>
                                    <td>
                                        @if($visa->status)
                                            <span class="badge bg-success">Active</span>
                                        @else
                                            <span class="badge bg-danger">Inactive</span>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ route('admin.medical.visa.show', $visa->id) }}" class="btn btn-success btn-sm me-1" title="View">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <a href="{{ route('admin.medical.visa.edit', $visa->id) }}" class="btn btn-primary btn-sm me-1" title="Edit">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <a href="{{ route('admin.medical.visa.delete', $visa->id) }}" id="delete" class="btn btn-danger btn-sm" title="Delete"
                                          >
                                            <i class="fa fa-trash"></i>
                                        </a>
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
</div>
@endsection