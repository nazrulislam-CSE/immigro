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
                    <h4 class="card-title">{{ $pageTitle }}</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.visitor.store') }}" method="POST">
                        @csrf

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="name">Name <span class="text-danger">*</span></label>
                                    <input type="text" name="name" id="name" class="form-control" value="{{ old('name') }}" placeholder="Enter Name" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="mobile">Mobile Number</label>
                                    <input type="text" name="mobile" id="mobile" class="form-control" value="{{ old('mobile') }}" placeholder="Enter Mobile Number">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="interacted_country">Interacted Country</label>
                                    <input type="text" name="interacted_country" id="interacted_country" class="form-control" value="{{ old('interacted_country') }}" placeholder="Enter Interacted Country">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="visa_category">Visa Category</label>
                                    <select name="visa_category" id="visa_category" class="form-control">
                                        <option value="">Select Visa Category</option>
                                        <option value="Work permit" {{ old('visa_category')=='Work permit' ? 'selected' : '' }}>Work permit</option>
                                        <option value="Student visa" {{ old('visa_category')=='Student visa' ? 'selected' : '' }}>Student visa</option>
                                        <option value="Medical visa" {{ old('visa_category')=='Medical visa' ? 'selected' : '' }}>Medical visa</option>
                                        <option value="Tourist visa" {{ old('visa_category')=='Tourist visa' ? 'selected' : '' }}>Tourist visa</option>
                                        <option value="Umrah visa" {{ old('visa_category')=='Umrah visa' ? 'selected' : '' }}>Umrah visa</option>
                                        <option value="Double entry visa" {{ old('visa_category')=='Double entry visa' ? 'selected' : '' }}>Double entry visa</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="date">Date</label>
                                    <input type="date" name="date" id="date" class="form-control" value="{{ old('date') }}" placeholder="Select Date">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="next_followup">Next Follow up</label>
                                    <input type="date" name="next_followup" id="next_followup" class="form-control" value="{{ old('next_followup') }}" placeholder="Select Next Follow up Date">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="followup_result">Follow up Result</label>
                                    <select name="followup_result" id="followup_result" class="form-control">
                                        <option value="">Select</option>
                                        <option value="yes" {{ old('followup_result')=='yes' ? 'selected' : '' }}>Yes</option>
                                        <option value="no" {{ old('followup_result')=='no' ? 'selected' : '' }}>No</option>
                                        <option value="pending" {{ old('followup_result')=='pending' ? 'selected' : '' }}>Pending</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="counsellor_name">Counsellor Name</label>
                                    <input type="text" name="counsellor_name" id="counsellor_name" class="form-control" value="{{ old('counsellor_name') }}" placeholder="Enter Counsellor Name">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="comments">Comments</label>
                                    <textarea name="comments" id="comments" rows="3" class="form-control" placeholder="Enter Comments">{{ old('comments') }}</textarea>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12 text-right">
                                <button type="submit" class="btn btn-primary">Submit</button>
                                <a href="{{ route('admin.visitor.index') }}" class="btn btn-secondary">Cancel</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection