@extends('layouts.admin.app', ['pageTitle' => $pageTitle])

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4 class="card-title">{{ $pageTitle }}</h4>
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addSupplierModal">
                        <i class="fas fa-plus"></i> Add Supplier
                    </button>
                </div>
                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>SL</th>
                                    <th>Name</th>
                                    <th>Mobile</th>
                                    <th>Address</th>
                                    <th>Previous Due</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($suppliers as $key => $supplier)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ $supplier->name }}</td>
                                    <td>{{ $supplier->mobile_number }}</td>
                                    <td>{{ $supplier->address }}</td>
                                    <td>{{ $supplier->previous_due }}</td>
                                    <td>
                                        <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#editSupplierModal{{ $supplier->id }}">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        <a href="{{ route('admin.supplier.delete', $supplier->id) }}" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">
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

{{-- Add Supplier Modal --}}
<div class="modal fade" id="addSupplierModal" tabindex="-1" aria-labelledby="addSupplierModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ route('admin.supplier.store') }}" method="POST">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="addSupplierModalLabel">Add New Supplier</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="name" class="form-label">Name *</label>
                        <input type="text" class="form-control" name="name" placeholder="Enter Supplier Name" required>
                    </div>
                    <div class="mb-3">
                        <label for="mobile_number" class="form-label">Mobile Number</label>
                        <input type="text" class="form-control" name="mobile_number" placeholder="Enter Mobile Number">
                    </div>
                    <div class="mb-3">
                        <label for="address" class="form-label">Address</label>
                        <textarea class="form-control" name="address" rows="2" placeholder="Enter Address"></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="previous_due" class="form-label">Previous Due</label>
                        <input type="number" step="0.01" class="form-control" name="previous_due" placeholder="Enter Previous Due">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- Edit Supplier Modals --}}
@foreach($suppliers as $supplier)
<div class="modal fade" id="editSupplierModal{{ $supplier->id }}" tabindex="-1" aria-labelledby="editSupplierModalLabel{{ $supplier->id }}" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ route('admin.supplier.update', $supplier->id) }}" method="POST">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="editSupplierModalLabel{{ $supplier->id }}">Edit Supplier</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="name{{ $supplier->id }}" class="form-label">Name *</label>
                        <input type="text" class="form-control" name="name" id="name{{ $supplier->id }}" value="{{ $supplier->name }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="mobile_number{{ $supplier->id }}" class="form-label">Mobile Number</label>
                        <input type="text" class="form-control" name="mobile_number" id="mobile_number{{ $supplier->id }}" value="{{ $supplier->mobile_number }}">
                    </div>
                    <div class="mb-3">
                        <label for="address{{ $supplier->id }}" class="form-label">Address</label>
                        <textarea class="form-control" name="address" id="address{{ $supplier->id }}" rows="2">{{ $supplier->address }}</textarea>
                    </div>
                    <div class="mb-3">
                        <label for="previous_due{{ $supplier->id }}" class="form-label">Previous Due</label>
                        <input type="number" step="0.01" class="form-control" name="previous_due" id="previous_due{{ $supplier->id }}" value="{{ $supplier->previous_due }}">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endforeach
@endsection