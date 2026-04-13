@extends('layouts.admin.app', ['pageTitle' => $pageTitle])

@section('content')
    @php
        $admin = Auth::guard('admin')->user();
    @endphp
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
                            <span class="badge bg-danger side-badge"
                                style="font-size:17px;">{{ count($studentVisas) }}</span>
                        </p>
                        @if ($admin && $admin->hasRole('Super Admin'))
                            <div class="d-flex">
                                <a href="{{ route('admin.student.visa.create') }}" class="btn btn-success me-2">
                                    <i class="fas fa-plus d-inline"></i> Add New Student Visa
                                </a>
                            </div>
                        @endif
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered text-nowrap">
                                <thead>
                                    <tr>
                                        <th>SL</th>
                                        <th>Flag</th>
                                        <th>Country</th>
                                        <th>Program</th>
                                        <th>University</th>
                                        <th>Intake</th>
                                        <th>IELTS</th>
                                        <th>Status</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($studentVisas as $key => $visa)
                                        <tr>
                                            <td>{{ $key + 1 }}</td>
                                            <td>
                                                <img src="{{ $visa->flug ? asset('upload/student_visa/' . $visa->flug) : asset('upload/no_image.jpg') }}"
                                                    width="40" alt="flag">
                                            </td>
                                            <td>{{ $visa->country_name }}</td>
                                            <td>{{ $visa->program ?? 'N/A' }}</td>
                                            <td>{{ $visa->versity_name ?? 'N/A' }}</td>
                                            <td>{{ $visa->intake ?? 'N/A' }}</td>
                                            <td>{{ $visa->ielts ?? 'N/A' }}</td>
                                            <td>
                                                @if ($visa->status)
                                                    <span class="badge bg-success">Active</span>
                                                @else
                                                    <span class="badge bg-danger">Inactive</span>
                                                @endif
                                            </td>
                                            <td>
                                                <a href="{{ route('admin.student.visa.show', $visa->id) }}"
                                                    class="btn btn-success btn-sm me-1" title="View">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                                @if ($admin && $admin->hasRole('Super Admin'))
                                                    <a href="{{ route('admin.student.visa.edit', $visa->id) }}"
                                                        class="btn btn-primary btn-sm me-1" title="Edit">
                                                        <i class="fas fa-edit"></i>
                                                    </a>
                                                @endif
                                                @if ($admin && $admin->hasRole('Super Admin'))
                                                    <a href="{{ route('admin.student.visa.delete', $visa->id) }}"
                                                        id="delete" class="btn btn-danger btn-sm" title="Delete">
                                                        <i class="fa fa-trash"></i>
                                                    </a>
                                                @endif
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
