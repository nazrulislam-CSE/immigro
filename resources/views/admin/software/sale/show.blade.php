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
                    <a href="{{ route('admin.software.sale.list') }}" class="btn btn-danger me-2">
                        <i class="fas fa-list d-inline"></i> Software Sale List
                    </a>
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        <table class="table table-bordered">
                            <tr>
                                <th width="200">Software Name</th>
                                <td>{{ $software->software_name }}</td>
                            </tr>
                            <tr>
                                <th>Demo Link</th>
                                <td>
                                    @if($software->demo_link)
                                        <a href="{{ $software->demo_link }}" target="_blank">{{ $software->demo_link }}</a>
                                    @else
                                        N/A
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <th>Price</th>
                                <td>{{ number_format($software->price, 2) }}</td>
                            </tr>
                            <tr>
                                <th>Discount</th>
                                <td>{{ $software->discount }}%</td>
                            </tr>
                            <tr>
                                <th>Sell Commission</th>
                                <td>{{ number_format($software->sell_comission, 2) }}</td>
                            </tr>
                            <tr>
                                <th>Monthly Charge</th>
                                <td>{{ number_format($software->monthly_charge, 2) }}</td>
                            </tr>
                            <tr>
                                <th>Status</th>
                                <td>
                                    @if($software->status)
                                        <span class="badge bg-success">Active</span>
                                    @else
                                        <span class="badge bg-danger">Inactive</span>
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <th>Facilities / Features</th>
                                <td>{!! $software->facilities !!}</td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection