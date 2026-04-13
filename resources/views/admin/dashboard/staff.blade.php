@extends('layouts.admin.app', ['pageTitle' => $pageTitle])

@section('content')
<style>
    /* Custom styles for staff dashboard */
    .welcome-card {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        border: none;
        color: rgb(247, 37, 37);
    }
    .stat-card {
        transition: transform 0.2s, box-shadow 0.2s;
        border: none;
        border-radius: 1rem;
        overflow: hidden;
    }
    .stat-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 1rem 2rem rgba(0,0,0,0.1);
    }
    .icon-circle {
        width: 60px;
        height: 60px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 28px;
        background: rgba(255,255,255,0.2);
        backdrop-filter: blur(4px);
    }
    .progress-bar-custom {
        background: linear-gradient(90deg, #28a745, #20c997);
        border-radius: 10px;
    }
    .quick-link-btn {
        transition: all 0.2s;
        border-radius: 50px;
        padding: 8px 20px;
        font-weight: 500;
    }
    .quick-link-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 10px rgba(0,0,0,0.1);
    }
    .salary-list li {
        padding: 8px 0;
        border-bottom: 1px solid #f0f0f0;
    }
    .table-custom th {
        background-color: #f8f9fc;
        border-bottom: 2px solid #e3e6f0;
    }
</style>

<div class="breadcrumb-header d-flex justify-content-between align-items-center mb-4">
    <div>
        <h4 class="content-title mb-1">{{ $pageTitle }}</h4>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item"><a href="{{ route('admin.admin.home') }}">Home</a></li>
                <li class="breadcrumb-item active">Dashboard</li>
            </ol>
        </nav>
    </div>
    <div class="d-none d-md-block">
        <span class="badge bg-soft-primary p-2">{{ date('l, d M Y') }}</span>
    </div>
</div>

<div class="main-content-body">
    <!-- Welcome Row with gradient -->
    <div class="row row-sm mb-4">
        <div class="col-12">
            <div class="card welcome-card shadow-lg">
                <div class="card-body d-flex justify-content-between align-items-center flex-wrap">
                    <div>
                        <h3 class="mb-1 fw-bold">Welcome back, <span class="text-warning">{{ $staff->staff_name ?? $admin->name }}</span> 👋</h3>
                        <p class="mb-0 opacity-75">Here's your personal overview and recent activities.</p>
                    </div>
                    <div class="mt-2 mt-sm-0">
                        <div class="icon-circle bg-white bg-opacity-25">
                            <i class="fe fe-user"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row row-sm g-4">
        <!-- Profile Card (Stylish) -->
        <div class="col-xl-4 col-lg-6 col-md-12">
        <div class=" stat-card shadow-sm h-100" style="background: linear-gradient(135deg, rgb(0, 198, 255), rgb(215 5 5 / 53%));">
                <div class="card-body text-center">
                    <div class="position-relative d-inline-block mb-3">
                        <img src="{{ $staff->photo ? asset('storage/' . $staff->photo) : asset('dashboard/img/avatar5.png') }}" 
                             class="rounded-circle wd-100 ht-100 border border-3 border-primary p-1" alt="profile">
                        <span class="position-absolute bottom-0 end-0 bg-success border border-light rounded-circle p-1" style="width: 16px; height: 16px;"></span>
                    </div>
                    <h5 class="mb-1 fw-bold text-light">{{ $staff->staff_name }}</h5>
                    <p class=" mb-2 text-light"><i class="fe fe-mail"></i> {{ $admin->email }}</p>
                    <div class="d-flex justify-content-center gap-3 mb-2">
                        <span class="text-light"><i class="fe fe-phone text-primary"></i> {{ $staff->mobile_number ?? 'N/A' }}</span>
                        <span class="text-light"><i class="fe fe-map-pin text-danger"></i> {{ $staff->present_address ? Str::limit($staff->present_address, 20) : 'Not provided' }}</span>
                    </div>
                    <div class="mt-2">
                        <a href="{{ route('admin.profile.view') }}" class="btn btn-sm btn-primary rounded-pill px-4">Update Profile</a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Salary Summary Card (Neumorphic style) -->
        <div class="col-xl-4 col-lg-6 col-md-12">
            <div class="stat-card shadow-sm h-100" style="background: linear-gradient(135deg, rgb(0, 198, 255), rgb(18 231 83));">
                <div class="card-header bg-transparent border-0 pt-3">
                    <h5 class="card-title mb-0"><i class="fe fe-dollar-sign text-success me-1"></i> Salary Breakdown</h5>
                </div>
                <div class="card-body pt-0">
                    <ul class="list-unstyled salary-list mb-0">
                        <li class="d-flex justify-content-between">
                            <span class="text-light"><i class="fe fe-file-text"></i> Basic Salary</span>
                            <strong class="text-light">{{ number_format($staff->basic_salary ?? 0) }} TK</strong>
                        </li>
                        <li class="d-flex justify-content-between">
                            <span class="text-light"><i class="fe fe-home"></i> House Rent</span>
                            <strong class="text-light">{{ number_format($staff->house_rent ?? 0) }} TK</strong>
                        </li>
                        <li class="d-flex justify-content-between">
                            <span class="text-light"><i class="fe fe-crosshair"></i> Medical Allowance</span>
                            <strong class="text-light">{{ number_format($staff->medical_allowance ?? 0) }} TK</strong>
                        </li>
                        <li class="d-flex justify-content-between">
                            <span class="text-light"><i class="fe fe-trending-up"></i> Target Incentive</span>
                            <strong class="text-light">{{ number_format($staff->target_incentive ?? 0) }} TK</strong>
                        </li>
                        <li class="d-flex justify-content-between mt-2 pt-2 border-top border-2">
                            <span class="fw-bold text-light">Gross Salary</span>
                            <strong class="text-light fs-5">{{ number_format($staff->gross_salary ?? 0) }} TK</strong>
                        </li>
                    </ul>
                    <div class="mt-3 small text-light">
                        <i class="fe fe-credit-card"></i> Payment: <span class="badge bg-soft-info text-light">{{ ucfirst($staff->payment_system ?? 'Cash') }}</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Attendance Card (with gradient progress) -->
        <div class="col-xl-4 col-lg-6 col-md-12">
            <div class="stat-card shadow-sm h-100" style="background: linear-gradient(135deg, rgb(0, 198, 255), rgb(255 0 129));">
                <div class="card-header bg-transparent border-0 pt-3">
                    <h5 class="card-title mb-0"><i class="fe fe-calendar text-light me-1"></i> Monthly Attendance</h5>
                </div>
                <div class="card-body text-center">
                    <div class="display-4 fw-bold text-light">{{ $attendanceCount ?? 0 }}</div>
                    <p class="text-light">days present out of 26 working days</p>
                    <div class="progress mb-2" style="height: 12px; border-radius: 20px;">
                        <div class="progress-bar progress-bar-custom" 
                             role="progressbar" 
                             style="width: {{ min(100, ($attendanceCount / 26) * 100) }}%" 
                             aria-valuenow="{{ $attendanceCount }}" 
                             aria-valuemin="0" 
                             aria-valuemax="26">
                        </div>
                    </div>
                    <div class="d-flex justify-content-between mt-3">
                        <div>
                            <small class="text-light">Present: {{ $attendanceCount }}</small>
                        </div>
                        <div>
                            <small class="text-light">Absent: {{ max(0, 26 - $attendanceCount) }}</small>
                        </div>
                    </div>
                    <div class="mt-3">
                        <a href="{{ route('admin.staff.attendance.index') }}" class="btn btn-sm btn-primary rounded-pill px-4">
                            <i class="fe fe-eye"></i> View Details
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Recent Payments History with better table styling -->
    <div class="row row-sm mt-5">
        <div class="col-12">
            <div class="card shadow-sm border-0 rounded-3">
                <div class="card-header bg-white border-bottom-0 pt-4 pb-0">
                    <h5 class="card-title mb-0"><i class="fe fe-list me-2 text-primary"></i> Recent Salary Transactions</h5>
                </div>
                <div class="card-body">
                    @if($recentPayments && $recentPayments->count())
                        <div class="table-responsive">
                            <table class="table table-hover align-middle table-custom">
                                <thead>
                                    <tr class="text-muted">
                                        <th>Date</th>
                                        <th>Amount</th>
                                        <th>Method</th>
                                        <th>Status</th>
                                        <th>Reference</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($recentPayments as $payment)
                                    <tr>
                                        <td><i class="fe fe-calendar me-1"></i> {{ \Carbon\Carbon::parse($payment->payment_date ?? $payment->created_at)->format('d M, Y') }}</td>
                                        <td class="fw-bold text-success">{{ number_format($payment->amount) }} <small>TK</small></td>
                                        <td>
                                            @php
                                                $method = $payment->payment_system ?? 'Cash';
                                                $icon = match(strtolower($method)) {
                                                    'bkash' => 'fe fe-smartphone',
                                                    'nagad' => 'fe fe-smartphone',
                                                    'rocket' => 'fe fe-message-square',
                                                    'bank' => 'fe fe-grid',
                                                    default => 'fe fe-credit-card'
                                                };
                                            @endphp
                                            <i class="{{ $icon }} me-1"></i> {{ ucfirst($method) }}
                                        </td>
                                        <td><span class="badge bg-success rounded-pill px-3 py-1"><i class="fe fe-check-circle"></i> Completed</span></td>
                                        <td><code>{{ $payment->transaction_id ?? 'N/A' }}</code></td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="text-center py-5">
                            <i class="fe fe-inbox fs-1 text-muted"></i>
                            <p class="text-muted mt-2">No payment records found yet.</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Quick Action Links with modern buttons -->
    <div class="row row-sm mt-5">
        <div class="col-12">
            <div class="card shadow-sm border-0 rounded-3">
                <div class="card-body">
                    <h5 class="card-title mb-3"><i class="fe fe-zap me-2 text-warning"></i> Quick Actions</h5>
                    <div class="d-flex flex-wrap gap-3">
                        <a href="{{ route('admin.staff.attendance.index') }}" class="btn btn-outline-primary quick-link-btn">
                            <i class="fe fe-calendar-check"></i> My Attendance
                        </a>
                        <a href="{{ route('admin.staff.payment.index') }}" class="btn btn-outline-success quick-link-btn">
                            <i class="fe fe-dollar-sign"></i> Payment History
                        </a>
                        <a href="{{ route('admin.profile.view') }}" class="btn btn-outline-secondary quick-link-btn">
                            <i class="fe fe-user"></i> Edit Profile
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection