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
                        <span class="badge bg-danger side-badge" style="font-size:17px;">{{ count($softwareSales) }}</span>
                    </p>
                    <div class="d-flex">
                        <a href="{{ route('admin.software.sale.create') }}" class="btn btn-success me-2">
                            <i class="fas fa-plus d-inline"></i> Add New Software
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered text-nowrap">
                            <thead>
                                    <th>SL</th>
                                    <th>Software Name</th>
                                    <th>Demo Link</th>
                                    <th>Price</th>
                                    <th>Discount</th>
                                    <th>Commission</th>
                                    <th>Monthly Charge</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($softwareSales as $key => $software)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ $software->software_name }}</td>
                                    <td>
                                        @if($software->demo_link)
                                            <a href="{{ $software->demo_link }}" target="_blank">Demo Link</a>
                                        @else
                                            N/A
                                        @endif
                                    </td>
                                    <td>{{ number_format($software->price, 2) }}</td>
                                    <td>{{ $software->discount }}%</td>
                                    <td>{{ number_format($software->sell_comission, 2) }}</td>
                                    <td>{{ number_format($software->monthly_charge, 2) }}</td>
                                    <td>
                                        @if($software->status)
                                            <span class="badge bg-success">Active</span>
                                        @else
                                            <span class="badge bg-danger">Inactive</span>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ route('admin.software.sale.show', $software->id) }}" class="btn btn-success btn-sm me-1" title="View">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <a href="{{ route('admin.software.sale.edit', $software->id) }}" class="btn btn-primary btn-sm me-1" title="Edit">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <a href="{{ route('admin.software.sale.delete', $software->id) }}" id="delete" class="btn btn-danger btn-sm" title="Delete"
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