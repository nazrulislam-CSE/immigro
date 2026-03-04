@extends('layouts.admin.app', ['pageTitle' => $pageTitle])

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h4 class="card-title">{{ $pageTitle }}</h4>
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staffModal"
                            id="addStaffBtn">
                            <i class="fas fa-plus"></i> Add Staff
                        </button>
                    </div>
                    <div class="card-body">
                        @if (session('success'))
                            <div class="alert alert-success">{{ session('success') }}</div>
                        @endif
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>SL</th>
                                        <th>Staff Name</th>
                                        <th>Mobile</th>
                                        <th>Photo</th>
                                        <th>Basic Salary</th>
                                        <th>House Rent</th>
                                        <th>Medical</th>
                                        <th>Incentive</th>
                                        <th>Gross</th>
                                        <th>Payment System</th>
                                        <th>Payment Amount</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($staff as $key => $member)
                                        <tr>
                                            <td>{{ $key + 1 }}</td>
                                            <td>{{ $member->staff_name }}</td>
                                            <td>{{ $member->mobile_number }}</td>
                                            <td>
                                                @if ($member->photo)
                                                    <img src="{{ asset('storage/' . $member->photo) }}" width="50"
                                                        height="50" class="img-thumbnail">
                                                @endif
                                            </td>
                                            <td>৳ {{ number_format($member->basic_salary, 2) }}</td>
                                            <td>৳ {{ number_format($member->house_rent, 2) }}</td>
                                            <td>৳ {{ number_format($member->medical_allowance, 2) }}</td>
                                            <td>৳ {{ number_format($member->target_incentive, 2) }}</td>
                                            <td>৳ {{ number_format($member->gross_salary, 2) }}</td>
                                            <td>{{ ucfirst($member->payment_system) }}</td>
                                            <td>৳ {{ number_format($member->payment_amount, 2) }}</td>
                                            <td>
                                                {{-- View Button --}}
                                                <button type="button" class="btn btn-sm btn-info view-btn"
                                                    data-id="{{ $member->id }}"
                                                    data-staff_name="{{ $member->staff_name }}"
                                                    data-mobile_number="{{ $member->mobile_number }}"
                                                    data-academic_qualification="{{ $member->academic_qualification }}"
                                                    data-experience="{{ $member->experience }}"
                                                    data-present_address="{{ $member->present_address }}"
                                                    data-permanent_address="{{ $member->permanent_address }}"
                                                    data-basic_salary="{{ $member->basic_salary }}"
                                                    data-house_rent="{{ $member->house_rent }}"
                                                    data-medical_allowance="{{ $member->medical_allowance }}"
                                                    data-target_incentive="{{ $member->target_incentive }}"
                                                    data-gross_salary="{{ $member->gross_salary }}"
                                                    data-payment_system="{{ $member->payment_system }}"
                                                    data-mobile_banking_number="{{ $member->mobile_banking_number }}"
                                                    data-bank_name="{{ $member->bank_name }}"
                                                    data-account_name="{{ $member->account_name }}"
                                                    data-account_number="{{ $member->account_number }}"
                                                    data-branch="{{ $member->branch }}"
                                                    data-payment_amount="{{ $member->payment_amount }}"
                                                    data-photo="{{ $member->photo }}"
                                                    data-email="{{ $member->admin->email ?? '' }}"
                                                    data-status="{{ $member->admin->status ?? 1 }}"
                                                    data-role_id="{{ $member->role_id }}"
                                                    data-bs-toggle="modal" data-bs-target="#staffModal">
                                                    <i class="fas fa-eye"></i>
                                                </button>

                                                {{-- Edit Button --}}
                                                <button type="button" class="btn btn-sm btn-primary edit-btn"
                                                    data-id="{{ $member->id }}"
                                                    data-staff_name="{{ $member->staff_name }}"
                                                    data-mobile_number="{{ $member->mobile_number }}"
                                                    data-academic_qualification="{{ $member->academic_qualification }}"
                                                    data-experience="{{ $member->experience }}"
                                                    data-present_address="{{ $member->present_address }}"
                                                    data-permanent_address="{{ $member->permanent_address }}"
                                                    data-basic_salary="{{ $member->basic_salary }}"
                                                    data-house_rent="{{ $member->house_rent }}"
                                                    data-medical_allowance="{{ $member->medical_allowance }}"
                                                    data-target_incentive="{{ $member->target_incentive }}"
                                                    data-gross_salary="{{ $member->gross_salary }}"
                                                    data-payment_system="{{ $member->payment_system }}"
                                                    data-mobile_banking_number="{{ $member->mobile_banking_number }}"
                                                    data-bank_name="{{ $member->bank_name }}"
                                                    data-account_name="{{ $member->account_name }}"
                                                    data-account_number="{{ $member->account_number }}"
                                                    data-branch="{{ $member->branch }}"
                                                    data-payment_amount="{{ $member->payment_amount }}"
                                                    data-photo="{{ $member->photo }}"
                                                    data-email="{{ $member->admin->email ?? '' }}"
                                                    data-status="{{ $member->admin->status ?? 1 }}"
                                                    data-role_id="{{ $member->role_id }}"
                                                    data-bs-toggle="modal" data-bs-target="#staffModal">
                                                    <i class="fas fa-edit"></i>
                                                </button>

                                                {{-- Delete Button --}}
                                                <a href="{{ route('admin.staff.delete', $member->id) }}"
                                                    class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">
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

    {{-- Staff Modal (Add/Edit/View) --}}
    <div class="modal fade" id="staffModal" tabindex="-1" aria-labelledby="staffModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <form id="staffForm" method="POST" action="" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="_method" id="method" value="POST">
                    <input type="hidden" id="form_mode" value="add"> {{-- add, edit, view --}}
                    <div class="modal-header">
                        <h5 class="modal-title" id="staffModalLabel">Add Staff</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        {{-- Basic Information Section --}}
                        <h5 class="mb-3">Basic Information</h5>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="staff_name" class="form-label">Staff Name *</label>
                                <input type="text" class="form-control" name="staff_name" id="staff_name"
                                    placeholder="Enter staff full name" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="mobile_number" class="form-label">Mobile Number</label>
                                <input type="text" class="form-control" name="mobile_number" id="mobile_number"
                                    placeholder="e.g., 017xxxxxxxx">
                            </div>
                        </div>

                        {{-- Email & Password --}}
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="email" class="form-label">Email Address *</label>
                                <input type="email" class="form-control" name="email" id="email"
                                    placeholder="staff@example.com" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="password" class="form-label">Password @if(!isset($form_mode) || $form_mode == 'add') * @endif</label>
                                <input type="password" class="form-control" name="password" id="password"
                                    placeholder="{{ isset($form_mode) && $form_mode == 'edit' ? 'Leave blank to keep unchanged' : '••••••••' }}"
                                    {{-- Only required for add mode --}}>
                                <small class="text-muted" id="passwordHelp" style="display: none;">Leave blank to keep current password</small>
                            </div>
                        </div>

                        {{-- Status --}}
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="status" class="form-label">Status</label>
                                <select class="form-control" name="status" id="status">
                                    <option value="1">Active</option>
                                    <option value="0">Inactive</option>
                                </select>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="photo" class="form-label">Photo</label>
                                <input type="file" class="form-control" name="photo" id="photo"
                                    accept="image/*">
                                <div id="photoPreview" class="mt-2"></div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="academic_qualification" class="form-label">Academic Qualification</label>
                                <textarea class="form-control" name="academic_qualification" id="academic_qualification"
                                    placeholder="e.g., B.Sc in CSE, MBA" rows="2"></textarea>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="experience" class="form-label">Experience</label>
                                <textarea class="form-control" name="experience" id="experience" placeholder="Previous work experience"
                                    rows="2"></textarea>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="present_address" class="form-label">Present Address</label>
                                <textarea class="form-control" name="present_address" id="present_address" placeholder="Current address"
                                    rows="2"></textarea>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="permanent_address" class="form-label">Permanent Address</label>
                                <textarea class="form-control" name="permanent_address" id="permanent_address" placeholder="Permanent address"
                                    rows="2"></textarea>
                            </div>
                        </div>

                        <hr>
                        {{-- Salary Details Section --}}
                        <h5 class="mb-3">Salary Details</h5>
                        <div class="row">
                            <div class="col-md-3 mb-3">
                                <label for="basic_salary" class="form-label">Basic Salary</label>
                                <input type="number" step="0.01" class="form-control salary-field"
                                    name="basic_salary" id="basic_salary" placeholder="0.00" value="0">
                            </div>
                            <div class="col-md-3 mb-3">
                                <label for="house_rent" class="form-label">House Rent</label>
                                <input type="number" step="0.01" class="form-control salary-field" name="house_rent"
                                    id="house_rent" placeholder="0.00" value="0">
                            </div>
                            <div class="col-md-3 mb-3">
                                <label for="medical_allowance" class="form-label">Medical Allowance</label>
                                <input type="number" step="0.01" class="form-control salary-field"
                                    name="medical_allowance" id="medical_allowance" placeholder="0.00" value="0">
                            </div>
                            <div class="col-md-3 mb-3">
                                <label for="target_incentive" class="form-label">Target Incentive</label>
                                <input type="number" step="0.01" class="form-control salary-field"
                                    name="target_incentive" id="target_incentive" placeholder="0.00" value="0">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="gross_salary" class="form-label">Gross Salary</label>
                                <input type="number" step="0.01" class="form-control" name="gross_salary"
                                    id="gross_salary" placeholder="Auto-calculated" readonly value="0">
                            </div>
                        </div>

                        <hr>
                        {{-- Payment Details Section --}}
                        <h5 class="mb-3">Payment Details</h5>
                        <div class="row">
                            <div class="col-md-4 mb-3">
                                <label for="payment_system" class="form-label">Payment System</label>
                                <select class="form-control" name="payment_system" id="payment_system">
                                    <option value="">Select payment method</option>
                                    <option value="cash">Cash</option>
                                    <option value="bkash">bKash</option>
                                    <option value="nagad">Nagad</option>
                                    <option value="rocket">Rocket</option>
                                    <option value="bank">Bank</option>
                                </select>
                            </div>
                        </div>

                        {{-- Mobile Banking Fields (for bKash/Nagad/Rocket) --}}
                        <div class="row" id="mobileBankingFields" style="display: none;">
                            <div class="col-md-4 mb-3">
                                <label for="mobile_banking_number" class="form-label">Mobile Banking Number</label>
                                <input type="text" class="form-control" name="mobile_banking_number"
                                    id="mobile_banking_number" placeholder="e.g., 017xxxxxxxx">
                            </div>
                        </div>

                        {{-- Bank Fields --}}
                        <div class="row" id="bankFields" style="display: none;">
                            <div class="col-md-3 mb-3">
                                <label for="bank_name" class="form-label">Bank Name</label>
                                <input type="text" class="form-control" name="bank_name" id="bank_name"
                                    placeholder="e.g., Sonali Bank">
                            </div>
                            <div class="col-md-3 mb-3">
                                <label for="account_name" class="form-label">Account Name</label>
                                <input type="text" class="form-control" name="account_name" id="account_name"
                                    placeholder="Name on account">
                            </div>
                            <div class="col-md-3 mb-3">
                                <label for="account_number" class="form-label">Account Number</label>
                                <input type="text" class="form-control" name="account_number" id="account_number"
                                    placeholder="Account number">
                            </div>
                            <div class="col-md-3 mb-3">
                                <label for="branch" class="form-label">Branch</label>
                                <input type="text" class="form-control" name="branch" id="branch"
                                    placeholder="Branch name">
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-4 mb-3">
                                <label for="payment_amount" class="form-label">Payment Amount</label>
                                <input type="number" step="0.01" class="form-control" name="payment_amount"
                                    id="payment_amount" placeholder="Enter amount">
                            </div>
                        </div>

                        <hr>
                        {{-- Role Assign --}}
                        <h5 class="mb-3">Role Assign</h5>
                        <div class="row">
                            <div class="col-md-6">
                                <label for="role_id" class="form-label">Role <span class="text-danger">*</span></label>
                                <select name="role_id" id="role_id"
                                    class="form-select @error('role_id') is-invalid @enderror" required>
                                    <option value="">-- Select Role --</option>
                                    @foreach ($roles as $role)
                                        <option value="{{ $role->id }}"
                                            {{ old('role_id') == $role->id ? 'selected' : '' }}>
                                            {{ ucfirst($role->name) }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('role_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary" id="modalSubmitBtn">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('admin')
    <script>
        $(document).ready(function() {
            // Function to calculate gross salary
            function calculateGross() {
                var basic = parseFloat($('#basic_salary').val()) || 0;
                var rent = parseFloat($('#house_rent').val()) || 0;
                var medical = parseFloat($('#medical_allowance').val()) || 0;
                var incentive = parseFloat($('#target_incentive').val()) || 0;
                var gross = basic + rent + medical + incentive;
                $('#gross_salary').val(gross.toFixed(2));
            }

            // Bind salary fields to calculation
            $('.salary-field').on('input', calculateGross);

            // Photo preview on file select
            $('#photo').change(function() {
                var file = this.files[0];
                if (file) {
                    var reader = new FileReader();
                    reader.onload = function(e) {
                        $('#photoPreview').html('<img src="' + e.target.result +
                            '" width="80" class="img-thumbnail">');
                    }
                    reader.readAsDataURL(file);
                }
            });

            // Show/hide fields based on payment system
            function togglePaymentFields() {
                var paymentSystem = $('#payment_system').val();
                $('#mobileBankingFields').hide();
                $('#bankFields').hide();

                if (paymentSystem === 'bkash' || paymentSystem === 'nagad' || paymentSystem === 'rocket') {
                    $('#mobileBankingFields').show();
                    $('#bank_name, #account_name, #account_number, #branch').val('');
                } else if (paymentSystem === 'bank') {
                    $('#bankFields').show();
                    $('#mobile_banking_number').val('');
                } else if (paymentSystem === 'cash') {
                    $('#mobile_banking_number, #bank_name, #account_name, #account_number, #branch').val('');
                } else {
                    $('#mobile_banking_number, #bank_name, #account_name, #account_number, #branch').val('');
                }
            }

            $('#payment_system').change(togglePaymentFields);

            // Function to set form fields readonly/disabled based on mode
            function setFormMode(mode) {
                // mode: 'add', 'edit', 'view'
                var isView = (mode === 'view');
                // Disable/enable all inputs, selects, textareas except hidden and button
                $('#staffForm input, #staffForm select, #staffForm textarea').not(
                    '#method, #form_mode, #modalSubmitBtn, [type="hidden"]').prop('disabled', isView);
                // For file input, we also disable
                $('#photo').prop('disabled', isView);
                // In view mode, hide submit button; in add/edit, show it
                if (isView) {
                    $('#modalSubmitBtn').hide();
                } else {
                    $('#modalSubmitBtn').show();
                }

                // Special handling for password field
                if (mode === 'edit') {
                    $('#password').prop('required', false);
                    $('#passwordHelp').show();
                    $('#password').attr('placeholder', 'Leave blank to keep unchanged');
                } else if (mode === 'add') {
                    $('#password').prop('required', true);
                    $('#passwordHelp').hide();
                    $('#password').attr('placeholder', '••••••••');
                } else {
                    $('#password').prop('required', false);
                    $('#passwordHelp').hide();
                }
            }

            // Reset modal on close
            $('#staffModal').on('hidden.bs.modal', function() {
                $('#staffForm')[0].reset();
                $('#method').val('POST');
                $('#staffForm').attr('action', '{{ route('admin.staff.store') }}');
                $('#staffModalLabel').text('Add Staff');
                $('#photoPreview').html('');
                $('#form_mode').val('add');
                setFormMode('add');
                togglePaymentFields();
                $('#password').val(''); // Clear password field
            });

            // View button
            $('.view-btn').click(function() {
                var id = $(this).data('id');
                $('#staff_name').val($(this).data('staff_name'));
                $('#mobile_number').val($(this).data('mobile_number'));
                $('#email').val($(this).data('email'));
                $('#status').val($(this).data('status'));
                $('#academic_qualification').val($(this).data('academic_qualification'));
                $('#experience').val($(this).data('experience'));
                $('#present_address').val($(this).data('present_address'));
                $('#permanent_address').val($(this).data('permanent_address'));
                $('#basic_salary').val($(this).data('basic_salary'));
                $('#house_rent').val($(this).data('house_rent'));
                $('#medical_allowance').val($(this).data('medical_allowance'));
                $('#target_incentive').val($(this).data('target_incentive'));
                $('#gross_salary').val($(this).data('gross_salary'));
                $('#payment_system').val($(this).data('payment_system')).trigger('change');
                $('#mobile_banking_number').val($(this).data('mobile_banking_number'));
                $('#bank_name').val($(this).data('bank_name'));
                $('#account_name').val($(this).data('account_name'));
                $('#account_number').val($(this).data('account_number'));
                $('#branch').val($(this).data('branch'));
                $('#payment_amount').val($(this).data('payment_amount'));
                $('#role_id').val($(this).data('role_id'));

                // Show existing photo preview
                var photo = $(this).data('photo');
                if (photo) {
                    $('#photoPreview').html('<img src="{{ asset('storage') }}/' + photo +
                        '" width="80" class="img-thumbnail">');
                } else {
                    $('#photoPreview').html('');
                }

                $('#form_mode').val('view');
                setFormMode('view');
                $('#staffModalLabel').text('View Staff');
                // No action needed for form submission
            });

            // Edit button
            $('.edit-btn').click(function() {
                var id = $(this).data('id');
                $('#staff_name').val($(this).data('staff_name'));
                $('#mobile_number').val($(this).data('mobile_number'));
                $('#email').val($(this).data('email'));
                $('#status').val($(this).data('status'));
                $('#academic_qualification').val($(this).data('academic_qualification'));
                $('#experience').val($(this).data('experience'));
                $('#present_address').val($(this).data('present_address'));
                $('#permanent_address').val($(this).data('permanent_address'));
                $('#basic_salary').val($(this).data('basic_salary'));
                $('#house_rent').val($(this).data('house_rent'));
                $('#medical_allowance').val($(this).data('medical_allowance'));
                $('#target_incentive').val($(this).data('target_incentive'));
                $('#gross_salary').val($(this).data('gross_salary'));
                $('#payment_system').val($(this).data('payment_system')).trigger('change');
                $('#mobile_banking_number').val($(this).data('mobile_banking_number'));
                $('#bank_name').val($(this).data('bank_name'));
                $('#account_name').val($(this).data('account_name'));
                $('#account_number').val($(this).data('account_number'));
                $('#branch').val($(this).data('branch'));
                $('#payment_amount').val($(this).data('payment_amount'));
                $('#role_id').val($(this).data('role_id'));

                // Show existing photo preview
                var photo = $(this).data('photo');
                if (photo) {
                    $('#photoPreview').html('<img src="{{ asset('storage') }}/' + photo +
                        '" width="80" class="img-thumbnail">');
                } else {
                    $('#photoPreview').html('');
                }

                // Clear password field for security (optional update)
                $('#password').val('');

                $('#form_mode').val('edit');
                setFormMode('edit');
                $('#method').val('POST'); // or 'PUT' if you prefer; but we'll keep POST with method spoofing
                $('#staffForm').attr('action', '{{ route('admin.staff.update', '') }}/' + id);
                $('#staffModalLabel').text('Edit Staff');
            });

            // Add button
            $('#addStaffBtn').click(function() {
                $('#staffForm')[0].reset();
                $('#method').val('POST');
                $('#staffForm').attr('action', '{{ route('admin.staff.store') }}');
                $('#staffModalLabel').text('Add Staff');
                $('#photoPreview').html('');
                $('#form_mode').val('add');
                setFormMode('add');
                togglePaymentFields();
                $('#password').val(''); // Clear password field
                $('#role_id').val(''); // Reset role selection
            });

            // Initial toggle
            togglePaymentFields();
            setFormMode('add'); // default
        });
    </script>
@endpush