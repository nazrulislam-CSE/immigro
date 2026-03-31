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
    <div class="d-flex my-auto">
        <!-- Optional stats section -->
    </div>
</div>

<div class="main-content-body">
    <div class="row row-sm">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header border-bottom d-flex justify-content-between align-items-center">
                    <p class="card-title my-0">
                        {{ $pageTitle ?? 'Visa List' }}
                        <span class="badge bg-danger side-badge" style="font-size:17px;">{{ count($visas) }}</span>
                    </p>
                    <div class="d-flex">
                        <a href="{{ route('admin.visa.create') }}" class="btn btn-success me-2">
                            <i class="fas fa-plus d-inline"></i> Add New Visa
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="file-datatable" class="border-top-0 table table-bordered text-nowrap key-buttons border-bottom">
                            <thead>
                                <tr>
                                    <th class="border-bottom-0">SL</th>
                                    <th class="border-bottom-0">Flag</th>
                                    <th class="border-bottom-0">Country Name</th>
                                    <th class="border-bottom-0">Visa Category</th>
                                    <th class="border-bottom-0">Work Category</th>
                                    <th class="border-bottom-0">Processing Time</th>
                                    <th class="border-bottom-0">Status</th>
                                    <th class="border-bottom-0">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($visas as $key => $visa)
                                <tr>
                                    <td class="col-1">{{ $key + 1 }}</td>
                                    <td>
                                        <img src="{{ $visa->flug ? asset('upload/visa/'.$visa->flug) : asset('upload/no_image.jpg') }}"
                                             width="50" alt="flag" class="img-fluid">
                                    </td>
                                    <td>{{ $visa->country_name }}</td>
                                    <td>{{ $visa->visa_category ?? 'N/A' }}</td>
                                    <td>{{ $visa->work_category ?? 'N/A' }}</td>
                                    <td>{{ $visa->processing_time ?? 'N/A' }}</td>
                                    <td>
                                        @if($visa->status == 1)
                                            <span class="badge bg-pill bg-success">Active</span>
                                        @else
                                            <span class="badge bg-pill bg-danger">Inactive</span>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ route('admin.visa.show', $visa->id) }}" class="btn btn-success btn-sm me-1" title="View">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <a href="{{ route('admin.visa.edit', $visa->id) }}" class="btn btn-primary btn-sm me-1" title="Edit">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <a href="{{ route('admin.visa.delete', $visa->id) }}" id="delete" class="btn btn-danger btn-sm" title="Delete"
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