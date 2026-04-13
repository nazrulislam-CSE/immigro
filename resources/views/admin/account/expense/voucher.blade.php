<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $pageTitle }} #{{ $expense->id }}</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:opsz,wght@14..32,300;14..32,400;14..32,500;14..32,600;14..32,700&display=swap" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            background: #eef2f5;
            font-family: 'Inter', sans-serif;
            padding: 40px 20px;
            color: #1a2c3e;
        }

        .voucher-container {
            max-width: 880px;
            margin: 0 auto;
            background: #ffffff;
            border-radius: 20px;
            box-shadow: 0 20px 35px -10px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }

        /* Header with gradient */
        .voucher-header {
            background: linear-gradient(135deg, #1e466e 0%, #0f2c44 100%);
            color: white;
            padding: 30px 35px;
        }

        .header-content {
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 20px;
        }

        .logo-area {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .logo-img {
            max-height: 70px;
            width: auto;
            background: white;
            border-radius: 12px;
            padding: 5px;
        }

        .company-info h1 {
            font-size: 26px;
            font-weight: 700;
            letter-spacing: -0.5px;
            margin-bottom: 6px;
        }

        .company-info p {
            font-size: 13px;
            opacity: 0.85;
            line-height: 1.4;
        }

        .voucher-title {
            text-align: right;
        }

        .voucher-title h2 {
            font-size: 32px;
            font-weight: 800;
            letter-spacing: 1px;
            background: rgba(255,255,255,0.15);
            display: inline-block;
            padding: 8px 20px;
            border-radius: 40px;
            backdrop-filter: blur(4px);
        }

        .voucher-title p {
            font-size: 14px;
            margin-top: 8px;
            opacity: 0.8;
        }

        /* Divider */
        .divider {
            height: 4px;
            background: linear-gradient(90deg, #f3b33d, #e8891c, #f3b33d);
            width: 100%;
        }

        /* Main body */
        .voucher-body {
            padding: 30px 35px 35px;
        }

        /* Meta row */
        .meta-row {
            display: flex;
            justify-content: space-between;
            background: #f8fafc;
            padding: 12px 20px;
            border-radius: 14px;
            margin-bottom: 30px;
            font-size: 14px;
            font-weight: 500;
            border: 1px solid #e2edf2;
        }

        .meta-item span:first-child {
            color: #5b6e8c;
            margin-right: 10px;
        }

        /* Info grid */
        .info-section {
            margin-bottom: 30px;
        }

        .section-title {
            font-size: 18px;
            font-weight: 700;
            color: #1e466e;
            border-left: 4px solid #f3b33d;
            padding-left: 12px;
            margin-bottom: 18px;
        }

        .info-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 16px 30px;
            background: #fefef7;
            padding: 18px 24px;
            border-radius: 20px;
            border: 1px solid #eef2f0;
        }

        .info-grid .field {
            display: flex;
            align-items: baseline;
            flex-wrap: wrap;
        }

        .field-label {
            font-weight: 600;
            width: 110px;
            color: #2c4c6e;
            font-size: 14px;
        }

        .field-value {
            font-weight: 500;
            color: #1f2f40;
            font-size: 15px;
        }

        /* Amount table */
        .amount-section {
            margin: 30px 0;
        }

        .amount-table {
            width: 100%;
            border-collapse: collapse;
            font-size: 15px;
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 1px 2px rgba(0,0,0,0.05);
        }

        .amount-table th {
            background: #eef2f5;
            padding: 14px 20px;
            text-align: left;
            font-weight: 700;
            color: #1a3a5e;
        }

        .amount-table td {
            padding: 14px 20px;
            border-bottom: 1px solid #e6edf2;
        }

        .amount-table tr:last-child td {
            border-bottom: none;
        }

        .total-row td {
            background: #fef5e7;
            font-weight: 800;
            font-size: 16px;
            border-top: 2px solid #f3b33d;
        }

        .text-right {
            text-align: right;
        }

        /* Signature area */
        .signature-area {
            display: flex;
            justify-content: space-between;
            margin: 45px 0 30px;
            gap: 40px;
        }

        .signature-line {
            flex: 1;
            border-top: 2px dashed #cbdde9;
            padding-top: 12px;
            text-align: center;
            font-size: 13px;
            font-weight: 500;
            color: #5c7f9c;
        }

        .footer-note {
            text-align: center;
            font-size: 12px;
            color: #7e95ae;
            border-top: 1px solid #e2edf2;
            padding-top: 22px;
            margin-top: 15px;
        }

        /* Print button */
        .btn-print {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: #1e466e;
            color: white;
            border: none;
            padding: 12px 28px;
            font-size: 15px;
            font-weight: 600;
            border-radius: 40px;
            cursor: pointer;
            transition: 0.2s;
            margin: 0 auto 30px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.05);
        }

        .btn-print:hover {
            background: #0f3452;
            transform: translateY(-2px);
        }

        .print-wrapper {
            text-align: center;
        }

        /* Print styles */
        @media print {
            body {
                background: white;
                padding: 0;
                margin: 0;
            }
            .voucher-container {
                box-shadow: none;
                border-radius: 0;
                margin: 0;
            }
            .btn-print, .print-wrapper {
                display: none;
            }
            .voucher-header {
                background: #1e466e;
                -webkit-print-color-adjust: exact;
                print-color-adjust: exact;
            }
            .divider {
                -webkit-print-color-adjust: exact;
                print-color-adjust: exact;
            }
            .info-grid, .meta-row {
                break-inside: avoid;
            }
            .amount-table {
                break-inside: avoid;
            }
        }
    </style>
</head>
<body>

<div class="voucher-container">
    <!-- Header with gradient background -->
    <div class="voucher-header">
        <div class="header-content">
            <div class="logo-area">
                @php
                    $logoPath = get_setting('site_logo')->value ?? null;
                @endphp
                @if($logoPath && file_exists(public_path($logoPath)))
                    <img src="{{ asset($logoPath) }}" alt="Logo" class="logo-img">
                @else
                    <div style="width: 60px; height: 60px; background: rgba(255,255,255,0.2); border-radius: 12px;"></div>
                @endif
                <div class="company-info">
                    <h1>{{ get_setting('site_name')->value ?? 'Your Company' }}</h1>
                    <p>{{ get_setting('business_address')->value ?? '' }}<br>
                    Phone: {{ get_setting('phone')->value ?? 'N/A' }} | Email: {{ get_setting('email')->value ?? '' }}</p>
                </div>
            </div>
            <div class="voucher-title">
                <h2>VOUCHER</h2>
                <p>Expense Acknowledgement</p>
            </div>
        </div>
    </div>
    <div class="divider"></div>

    <div class="voucher-body">
        <!-- Meta row -->
        <div class="meta-row">
            <div class="meta-item"><span>Voucher No:</span> <strong>#{{ $expense->id }}</strong></div>
            <div class="meta-item"><span>Date:</span> <strong>{{ $expense->date ? $expense->date->format('d M Y') : 'N/A' }}</strong></div>
            <div class="meta-item"><span>Status:</span> <span style="color: #e8891c; font-weight:600;">Paid</span></div>
        </div>

        <!-- Expense Details (2-column grid) -->
        <div class="info-section">
            <div class="section-title">Expense Details</div>
            <div class="info-grid">
                <div class="field">
                    <div class="field-label">Expense Category</div>
                    <div class="field-value">{{ $expense->expense_category ?? 'N/A' }}</div>
                </div>
                <div class="field">
                    <div class="field-label">Payment Method</div>
                    <div class="field-value">{{ $expense->payment_method ?? 'N/A' }}</div>
                </div>
                <div class="field">
                    <div class="field-label">Paid By</div>
                    <div class="field-value">{{ $expense->paid_by ?? 'N/A' }}</div>
                </div>
                <div class="field">
                    <div class="field-label">Created At</div>
                    <div class="field-value">{{ $expense->created_at->format('d M Y h:i A') }}</div>
                </div>
                @if($expense->comments)
                <div class="field" style="grid-column: span 2;">
                    <div class="field-label">Comments</div>
                    <div class="field-value">{{ $expense->comments }}</div>
                </div>
                @endif
            </div>
        </div>

        <!-- Financial Summary -->
        <div class="amount-section">
            <div class="section-title">Financial Summary</div>
            <table class="amount-table">
                <thead>
                    <tr>
                        <th>Description</th>
                        <th class="text-right">Amount (৳)</th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="total-row">
                        <td><strong>Expense Amount</strong></td>
                        <td class="text-right"><strong>৳ {{ number_format($expense->expense_amount, 2) }}</strong></td>
                    </tr>
                </tbody>
            </table>
        </div>

        <!-- Signature & footer -->
        <div class="signature-area">
            <div class="signature-line">Paid By (Signature)</div>
            <div class="signature-line">Authorised Signature</div>
        </div>

        <div class="footer-note">
            This is a computer-generated voucher – valid without signature.<br>
            Thank you for your transaction!
        </div>
    </div>
</div>

<div class="print-wrapper">
    <button class="btn-print" onclick="window.print();">
        🖨️ Print Voucher
    </button>
</div>

<script>
    // Auto-print if ?print=1 is present in URL
    if (window.location.search.includes('print=1')) {
        window.print();
    }
</script>
</body>
</html>