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

        </div>
    </div>
    <div class="main-content-body">
        <!-- Row -->
        <div class="row row-sm">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header border-bottom d-flex justify-content-between align-items-center">
                        <p class="card-title my-0">{{ $pageTitle ?? 'Page Title' }} <span class="badge bg-danger side-badge"
                                style="font-size:17px;">{{ count($visitors) }}</span> </p>

                        <div class="d-flex">
                            <a href="{{ route('admin.visitor.create') }}" class="btn btn-success me-2">
                                <i class="fas fa-plus d-inline"></i> Add New Visitor
                            </a>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="file-datatable"
                                class="border-top-0  table table-bordered text-nowrap key-buttons border-bottom">
                                <thead>
                                    <tr>
                                        <th>SL</th>
                                        <th>Name</th>
                                        <th>Mobile</th>
                                        <th>Interacted Country</th>
                                        <th>Visa Category</th>
                                        <th>Date</th>
                                        <th>Next Follow up</th>
                                        <th>Follow up Result</th>
                                        <th>Comments</th>
                                        <th>Counsellor Name</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($visitors as $key => $visitor)
                                        <tr>
                                            <td>{{ $key + 1 }}</td>
                                            <td>{{ $visitor->name }}</td>
                                            <td>{{ $visitor->mobile }}</td>
                                            <td>{{ $visitor->interacted_country }}</td>
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
                                            <td>{{ $visitor->date ? $visitor->date->format('d-m-Y') : '' }}</td>
                                            <td>{{ $visitor->next_followup ? $visitor->next_followup->format('d-m-Y') : '' }}
                                            </td>
                                            <td>{{ ucfirst($visitor->followup_result) }}</td>
                                            <td>{{ $visitor->comments }}</td>
                                            <td>{{ $visitor->counsellor_name }}</td>
                                            <td>
                                                <a href="{{ route('admin.visitor.show', $visitor->id) }}"
                                                    class="btn btn-success btn-sm mr-2"><i class="fas fa-eye"></i></a>
                                                <a href="{{ route('admin.visitor.edit', $visitor->id) }}"
                                                    class="btn btn-primary btn-sm mr-2"><i class="fas fa-edit"></i></a>
                                                <a href="{{ route('admin.visitor.delete', $visitor->id) }}"
                                                    class="btn btn-danger btn-sm" title="Delete Data" id="delete"><i
                                                        class="fa fa-trash"></i></a>
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
        <!-- End Row -->
    </div>
@endsection
