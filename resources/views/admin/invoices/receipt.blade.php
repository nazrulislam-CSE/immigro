<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Money Receipt #{{ $invoice->invoice_no }}</title>
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:opsz,wght@14..32,300;14..32,400;14..32,500;14..32,600;14..32,700&display=swap"
        rel="stylesheet">
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

        .receipt-container {
            max-width: 880px;
            margin: 0 auto;
            background: #ffffff;
            border-radius: 20px;
            box-shadow: 0 20px 35px -10px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            transition: all 0.2s;
        }

        /* Header with subtle gradient */
        .receipt-header {
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

        .receipt-title {
            text-align: right;
        }

        .receipt-title h2 {
            font-size: 32px;
            font-weight: 800;
            letter-spacing: 1px;
            background: rgba(255, 255, 255, 0.15);
            display: inline-block;
            padding: 8px 20px;
            border-radius: 40px;
            backdrop-filter: blur(4px);
        }

        .receipt-title p {
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

        /* Main content */
        .receipt-body {
            padding: 30px 35px 35px;
        }

        /* Invoice meta row */
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

        /* Client info grid */
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

        .client-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 16px 30px;
            background: #fefef7;
            padding: 18px 24px;
            border-radius: 20px;
            border: 1px solid #eef2f0;
        }

        .client-grid .field {
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
            box-shadow: 0 1px 2px rgba(0, 0, 0, 0.05);
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

        /* Footer note */
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
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.05);
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

            .receipt-container {
                box-shadow: none;
                border-radius: 0;
                margin: 0;
            }

            .btn-print,
            .print-wrapper {
                display: none;
            }

            .receipt-header {
                background: #1e466e;
                -webkit-print-color-adjust: exact;
                print-color-adjust: exact;
            }

            .divider {
                -webkit-print-color-adjust: exact;
                print-color-adjust: exact;
            }

            .client-grid,
            .meta-row {
                break-inside: avoid;
            }

            .amount-table {
                break-inside: avoid;
            }
        }
    </style>
</head>

<body>

    <div class="receipt-container">
        <!-- Header with gradient background -->
        <div class="receipt-header">
            <div class="header-content">
                <div class="logo-area">
                    @php
                        $logoPath = get_setting('site_logo')->value ?? null;
                    @endphp
                    @if ($logoPath && file_exists(public_path($logoPath)))
                        <img src="{{ asset($logoPath) }}" alt="Logo" class="logo-img">
                    @else
                        <div style="width: 60px; height: 60px; background: rgba(255,255,255,0.2); border-radius: 12px;">
                        </div>
                    @endif
                    <div class="company-info">
                        <h1>{{ get_setting('site_name')->value ?? 'Your Company' }}</h1>
                        <p>{{ get_setting('business_address')->value ?? '' }}<br>
                            Phone: {{ get_setting('phone')->value ?? 'N/A' }} | Email:
                            {{ get_setting('email')->value ?? '' }}</p>
                    </div>
                </div>
                <div class="receipt-title">
                    <h2>RECEIPT</h2>
                    <p>Payment Acknowledgement</p>
                </div>
            </div>
        </div>
        <div class="divider"></div>

        <div class="receipt-body">
            <!-- Invoice meta -->
            <div class="meta-row">
                <div class="meta-item"><span>Invoice No:</span> <strong>{{ $invoice->invoice_no }}</strong></div>
                <div class="meta-item"><span>Date:</span> <strong>{{ $invoice->created_at->format('d-m-Y') }}</strong>
                </div>
                <div class="meta-item"><span>Status:</span>
                    @php
                        $statusClass = $invoice->due > 0 ? 'warning' : 'success';
                    @endphp
                    <span style="color: {{ $invoice->due > 0 ? '#e8891c' : '#2b7e3a' }}; font-weight:600;">
                        {{ $invoice->due > 0 ? 'Partial Paid' : 'Fully Paid' }}
                    </span>
                </div>
            </div>

            <!-- Client Information (2‑column grid) -->
            <div class="info-section">
                <div class="section-title">Client Details</div>
                <div class="client-grid">
                    <div class="field">
                        <div class="field-label">Full Name</div>
                        <div class="field-value">{{ $invoice->client->client_name ?? '—' }}</div>
                    </div>
                    <div class="field">
                        <div class="field-label">Mobile Number</div>
                        <div class="field-value">{{ $invoice->mobile }}</div>
                    </div>
                    <div class="field">
                        <div class="field-label">Country</div>
                        <div class="field-value">{{ $invoice->country_name }}</div>
                    </div>
                    <div class="field">
                        <div class="field-label">Processing Time</div>
                        <div class="field-value">{{ $invoice->processing_time ?? 'Standard' }}</div>
                    </div>
                </div>
            </div>

            <!-- Amount breakdown -->
            <div class="amount-section">
                <div class="section-title">Payment Summary</div>
                <table class="amount-table">
                    <thead>
                        <tr>
                            <th>Description</th>
                            <th class="text-right">Amount (৳)</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Total Invoice Amount</td>
                            <td class="text-right">৳ {{ number_format($invoice->total_amount, 2) }}</td>
                        </tr>
                        <tr>
                            <td>Advance / Paid Amount</td>
                            <td class="text-right">৳ {{ number_format($invoice->advance_pay, 2) }}</td>
                        </tr>
                        <tr class="total-row">
                            <td><strong>Due Balance</strong></td>
                            <td class="text-right"><strong>৳ {{ number_format($invoice->due, 2) }}</strong></td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <!-- Signature & footer -->
            <div class="signature-area">
                <div class="signature-line">Received by</div>
                <div class="signature-line">Authorised Signature</div>
            </div>

            <div class="footer-note">
                This is a computer generated receipt – valid without signature.<br>
                Thank you for your business!
            </div>
        </div>
    </div>

    <div class="print-wrapper">
        <button class="btn-print" onclick="window.print();">
            🖨️ Print Receipt
        </button>
    </div>

    <script>
        // Auto‑print if ?print=1 is present in URL
        if (window.location.search.includes('print=1')) {
            window.print();
        }
    </script>
</body>

</html>
