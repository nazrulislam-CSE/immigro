@extends('layouts.admin.app', ['pageTitle' => $pageTitle])

@section('content')
    <div class="breadcrumb-header justify-content-between">
        <div class="d-flex align-items-center">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item active" aria-current="page">{{ $pageTitle }}</li>
                    <li class="breadcrumb-item"><a href="javascript:void(0);">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('admin.visitor.index') }}">Visitor List</a></li>
                </ol>
            </nav>
        </div>
    </div>

    <div class="main-content-body">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header border-bottom">
                        <h4 class="card-title">Visitor Details</h4>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered">
                            <tr>
                                <th style="width:200px;">Name</th>
                                <td>{{ $visitor->name }}</td>
                            </tr>
                            <tr>
                                <th>Mobile</th>
                                <td>{{ $visitor->mobile }}</td>
                            </tr>
                            <tr>
                                <th>Interacted Country</th>
                                <td>{{ $visitor->interacted_country }}</td>
                            </tr>
                            <tr>
                                <th>Visa Category</th>
                                <td>
                                    @if ($visitor->visa_category)
                                        <span
                                            class="badge 
                                                        @switch($visitor->visa_category)
                                                            @case('Work permit') bg-primary @break
                                                            @case('Student visa') bg-success @break
                                                            @case('Medical visa') bg-info text-dark @break
                                                            @case('Tourist visa') bg-warning text-dark @break
                                                            @case('Umrah visa') bg-secondary @break
                                                            @case('Double entry visa') bg-dark @break
                                                            @default bg-light text-dark
                                                        @endswitch
                                                    ">
                                            {{ $visitor->visa_category }}
                                        </span>
                                    @else
                                        <span class="text-muted">N/A</span>
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <th>Date</th>
                                <td>{{ $visitor->date ? $visitor->date->format('d-m-Y') : '' }}</td>
                            </tr>
                            <tr>
                                <th>Next Follow up</th>
                                <td>{{ $visitor->next_followup ? $visitor->next_followup->format('d-m-Y') : '' }}</td>
                            </tr>
                            <tr>
                                <th>Follow up Result</th>
                                <td>{{ ucfirst($visitor->followup_result) }}</td>
                            </tr>
                            <tr>
                                <th>Comments</th>
                                <td>{{ $visitor->comments }}</td>
                            </tr>
                            <tr>
                                <th>Counsellor Name</th>
                                <td>{{ $visitor->counsellor_name }}</td>
                            </tr>
                            <tr>
                                <th>Created At</th>
                                <td>{{ $visitor->created_at ? $visitor->created_at->format('d-m-Y H:i') : '' }}</td>
                            </tr>
                            <tr>
                                <th>Updated At</th>
                                <td>{{ $visitor->updated_at ? $visitor->updated_at->format('d-m-Y H:i') : '' }}</td>
                            </tr>
                        </table>
                        <a href="{{ route('admin.visitor.index') }}" class="btn btn-secondary mt-3">Back to List</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
