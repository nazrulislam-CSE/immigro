@extends('layouts.admin.app', [$pageTitle => 'Page Title'])
@section('content')
<div class="breadcrumb-header justify-content-between">
    <div class="d-flex align-items-center">
        {{-- <h4 class="content-title mb-2">Hi, welcome back!</h4> --}}
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item active" aria-current="page">{{ $pageTitle ?? 'Dashboard' }}</li>
                <li class="breadcrumb-item"><a href="javascript:void(0);">Dashboard</a></li>
            </ol>
        </nav>
    </div>
    <div class="d-flex my-auto">
        {{-- <div class=" d-flex right-page">
            <div class="d-flex justify-content-center me-5">
                <div class="">
                    <span class="d-block">
                        <span class="label ">EXPENSES</span>
                    </span>
                    <span class="value">
                        $53,000
                    </span>
                </div>
                <div class="ms-3 mt-2">
                    <span class="sparkline_bar"></span>
                </div>
            </div>
            <div class="d-flex justify-content-center">
                <div class="">
                    <span class="d-block">
                        <span class="label">PROFIT</span>
                    </span>
                    <span class="value">
                        $34,000
                    </span>
                </div>
                <div class="ms-3 mt-2">
                    <span class="sparkline_bar31"></span>
                </div>
            </div>
        </div> --}}
    </div>
</div>

    <div class="main-content-body">
        <div class="row row-sm">
            
    <div class="card">
        <div class="card-header border-bottom d-flex justify-content-between align-items-center">
            <p class="card-title my-0">{{ $pageTitle ?? 'Page Title'}}</p>
            <div class="d-flex">
                <a href="{{ route('admin.visa.request.list')}}" class="btn btn-danger me-2">
                    <i class="fas fa-list d-inline"></i> Visa Request List
                </a>
            </div>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.visa.request.list.update',$visa->id) }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="form-group col-xl-12 col-lg-12 col-md-12">
                    @if($visa->request_visa_type == '1')
                        <h2  class="bg-success p-2 text-center rounded">Student Visa</h2>
                    @elseif($visa->request_visa_type == '2')
                        <h2  class="bg-success p-2 text-center rounded">Work Permit Visa</h2>
                    @elseif($visa->request_visa_type == '3')
                        <h2  class="bg-success p-2 text-center rounded">Medical Visa</h2>
                    @elseif($visa->request_visa_type == '4')
                        <h2  class="bg-success p-2 text-center rounded">Tourist Visa</h2>
                    @endif
                    </div>
                    <div class="form-group col-xl-12 col-lg-12 col-md-12">
                        <label for="status">Status:</label>
                        @error('status') <span class="text-danger">{{ $message }}</span> @enderror
                        <div class="input-group">
                            <span class="input-group-text" title="status" id="basic-addon1"><i class="fas fa-user-tie"></i></span>
                            <select  name="status" id="status" class=" form-control">
                                <option value="1"@if($visa->status == '1') selected @endif>Pending</option>
                                <option value="2"@if($visa->status == '2') selected @endif>Apply</option>
                                <option value="3"@if($visa->status == '3') selected @endif>Processing</option>
                                <option value="4"@if($visa->status == '4') selected @endif>Success</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group col-xl-12 col-lg-12 col-md-12">
                        <label for="amount">Amount</label>: <span class="text-danger"></span></label>
                        @error('amount') <span class="text-danger">{{ $message }}</span> @enderror
                            <div class="input-group">
                                <span class="input-group-text font-weight-bolder" title="Amount" id="basic-addon1">৳</span>
                                <input type="number" min="0" value="{{ $visa->amount ?? '0'}}" class=" form-control" id="amount" name="amount" placeholder="Enter Amount">
                            </div>
                    </div>
                    <div class="form-group col-xl-12 col-lg-12 col-md-12">
                        <label for="commission">Commission: <span class="text-danger"></span> <span id="commission-error" class="text-danger d-none">Commission should not exceed the amount</span></label>
                        @error('commission') <span class="text-danger">{{ $message }}</span> @enderror
                        <div class="input-group">
                            <span class="input-group-text font-weight-bolder" title="Commission" id="basic-addon1">৳</span>
                            <input type="number" min="0" value="{{ $visa->commission_amount ?? '0'}}" class=" form-control" id="commission" name="commission" placeholder="Enter Commissin">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="total">Total Amount : <span class="text-danger"></span></label>
                        <div class="input-group">
                            <span class="input-group-text font-weight-bolder" title="Total" id="basic-addon1">৳</span>
                            <input type="text" class="form-control" value="{{ $visa->total_amount ?? '0'}}" name="total_amount" id="total" readonly>
                        </div>
                    </div>
                    <div class="col-xl-12 col-lg-6 col-md-6 col-sm-12 mt-3">
                        <button type="submit" class="add-to-cart btn btn-success btn-block"><i class="fas fa-paper-plane"></i> Update Visa Request</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
        </div>
    </div>
@endsection
@push('admin')
    <script>
        $(document).ready(function(){
            $('#amount, #commission').keyup(function(){
                var amount = parseFloat($('#amount').val()) || 0;
                var commission = parseFloat($('#commission').val()) || 0;
                var total = amount - commission;
                $('#total').val(total.toFixed(2));

                // Check if commission exceeds threshold
                if (commission > amount) {
                    $('#commission-error').removeClass('d-none');
                } else {
                    $('#commission-error').addClass('d-none');
                }
            });
        });
    </script>
@endpush
