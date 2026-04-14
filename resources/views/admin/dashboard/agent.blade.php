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
            box-shadow: 0 1rem 2rem rgba(0, 0, 0, 0.1);
        }

        .icon-circle {
            width: 60px;
            height: 60px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 28px;
            background: rgba(255, 255, 255, 0.2);
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
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
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
                            <h3 class="mb-1 fw-bold">Welcome back, <span
                                    class="text-warning">{{ $agent->staff_name ?? $admin->name }}</span> 👋</h3>
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
                <div class=" stat-card shadow-sm h-100"
                    style="background: linear-gradient(135deg, rgb(0, 198, 255), rgb(215 5 5 / 53%));">
                    <div class="card-body text-center">
                        <div class="position-relative d-inline-block mb-3">
                            <img src="{{ $agent->photo ? asset('storage/' . $agent->photo) : asset('dashboard/img/avatar5.png') }}"
                                class="rounded-circle wd-100 ht-100 border border-3 border-primary p-1" alt="profile">
                            <span class="position-absolute bottom-0 end-0 bg-success border border-light rounded-circle p-1"
                                style="width: 16px; height: 16px;"></span>
                        </div>
                        <h5 class="mb-1 fw-bold text-light">{{ $agent->staff_name }}</h5>
                        <p class=" mb-2 text-light"><i class="fe fe-mail"></i> {{ $admin->email }}</p>
                        <div class="d-flex justify-content-center gap-3 mb-2">
                            <span class="text-light"><i class="fe fe-phone text-primary"></i>
                                {{ $agent->mobile_number ?? 'N/A' }}</span>
                            <span class="text-light"><i class="fe fe-map-pin text-danger"></i>
                                {{ $agent->present_address ? Str::limit($agent->present_address, 20) : 'Not provided' }}</span>
                        </div>
                        <div class="mt-2">
                            <a href="{{ route('admin.profile.view') }}"
                                class="btn btn-sm btn-primary rounded-pill px-4">Update Profile</a>
                        </div>
                    </div>
                </div>
            </div>
              <div class="col-xl-4 col-lg-6 col-md-12">
            <div class="stat-card shadow-sm h-100" style="background: linear-gradient(135deg, rgb(0, 198, 255), rgb(18 231 83));">
                <div class="card-header bg-transparent border-0 pt-3">
                    <h5 class="card-title mb-0"><i class="fe fe-dollar-sign text-success me-1"></i> Agent Income</h5>
                </div>
                <div class="card-body pt-0">
                    <ul class="list-unstyled salary-list mb-0">
                        <li class="d-flex justify-content-between">
                            <span class="text-light"><i class="fe fe-file-text"></i> Total Income</span>
                            <strong class="text-light">0 TK</strong>
                        </li>
                        <li class="d-flex justify-content-between">
                            <span class="text-light"><i class="fe fe-file-text"></i> Total Withdraw</span>
                            <strong class="text-light">0 TK</strong>
                        </li>
                        <li class="d-flex justify-content-between">
                            <span class="text-light"><i class="fe fe-file-text"></i> Total Balance</span>
                            <strong class="text-light">0 TK</strong>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        </div>
    </div>
@endsection
