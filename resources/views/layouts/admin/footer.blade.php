@php
    $admin = Auth::guard('admin')->user();
    $isSuperAdmin = $admin && $admin->hasRole('Super Admin');
@endphp
@if (!$isSuperAdmin)
<style>
    .main-footer {
        background-color: #19e5db;
        border-top: 1px solid #534acf;
        margin-top: auto;
    }
</style>
@endif
<div class="main-footer ht-45">
    <div class="container-fluid pd-t-0-f ht-100p d-flex justify-content-between align-items-center">
        <span>
            Copyright © {{ date('Y') }}
            <a href="javascript:void(0);" class="text-primary">{{ get_setting('site_name')->value ?? '' }}</a>.
            All Rights Reserved.
        </span>
        <span class="text-muted">
            Developed by <a href="#" class="text-primary"
                target="_blank">{{ get_setting('developed_by')->value ?? '' }}</a>
        </span>
    </div>
</div>
