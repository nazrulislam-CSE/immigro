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
                        <div class="row">
                            @foreach ($studentVisas as $visa)
                                <div class="col-md-3 mb-4">
                                    <div class="card shadow-lg border-0 h-100">
                                        <a href="{{ route('admin.student.visa.show', $visa->id) }}">
                                            <!-- Flag -->
                                            <img src="{{ $visa->flug ? asset('upload/student_visa/' . $visa->flug) : asset('upload/no_image.jpg') }}"
                                                class="card-img-top" style="height:180px; object-fit:cover;" alt="flag">
                                        </a>

                                        <div class="card-body text-center">

                                            <!-- Country -->
                                            <h5 class="fw-bold">{{ $visa->country_name }}</h5>

                                            <!-- Actions -->
                                            <div class="d-flex justify-content-center gap-2 mt-3">

                                                {{-- <a href="{{ route('admin.student.visa.show', $visa->id) }}"
                                                    class="btn btn-success btn-sm" title="View">
                                                    <i class="fas fa-eye"></i>
                                                </a> --}}

                                                @if ($admin && $admin->hasRole('Super Admin'))
                                                    <a href="{{ route('admin.student.visa.edit', $visa->id) }}"
                                                        class="btn btn-primary btn-sm" title="Edit">
                                                        <i class="fas fa-edit"></i>
                                                    </a>

                                                    <a href="{{ route('admin.student.visa.delete', $visa->id) }}"
                                                        id="delete" class="btn btn-danger btn-sm" title="Delete">
                                                        <i class="fa fa-trash"></i>
                                                    </a>
                                                @endif

                                            </div>

                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
