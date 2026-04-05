<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $pageTitle }} #{{ $income->id }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: #f8f9fa;
            padding: 20px;
        }
        .voucher-container {
            max-width: 700px;
            margin: auto;
            background: white;
            border-radius: 10px;
            box-shadow: 0 0 15px rgba(0,0,0,0.1);
            padding: 30px;
        }
        .header {
            text-align: center;
            margin-bottom: 30px;
            border-bottom: 2px dashed #ddd;
            padding-bottom: 20px;
        }
        .header h2 {
            margin-bottom: 5px;
        }
        .table th {
            width: 40%;
            background: #f1f1f1;
        }
        .footer {
            text-align: center;
            margin-top: 30px;
            padding-top: 20px;
            border-top: 1px solid #ddd;
            font-size: 12px;
            color: #666;
        }
        @media print {
            body {
                background: white;
                padding: 0;
            }
            .no-print {
                display: none;
            }
            .voucher-container {
                box-shadow: none;
                padding: 0;
            }
        }
        .btn-print {
            display: block;
            width: 200px;
            margin: 20px auto 0;
        }
    </style>
</head>
<body>
<div class="voucher-container">
    <div class="header">
        <h2>INCOME VOUCHER</h2>
        <p><strong>Voucher #:</strong> {{ $income->id }}</p>
        <p><strong>Date:</strong> {{ $income->date ? $income->date->format('d M Y') : 'N/A' }}</p>
    </div>

    <table class="table table-bordered">
        <tr><th>Client</th><td>{{ $income->client->client_name ?? 'N/A' }}</td></tr>
        <tr><th>Income Category</th><td>{{ $income->income_category ?? 'N/A' }}</td></tr>
        <tr><th>Total Amount</th><td><strong>{{ number_format($income->total_amount,2) }}</strong></td></tr>
        <tr><th>Payment Amount</th><td>{{ number_format($income->payment_amount,2) }}</td></tr>
        <tr><th>Due Amount</th><td>{{ number_format($income->due_amount,2) }}</td></tr>
        <tr><th>Payment Date</th><td>{{ $income->payment_date ? $income->payment_date->format('d M Y') : 'N/A' }}</td></tr>
        <tr><th>Payment Method</th><td>{{ $income->payment_method ?? 'N/A' }}</td></tr>
        <tr><th>Received By</th><td>{{ $income->received_by ?? 'N/A' }}</td></tr>
        <tr><th>Comments</th><td>{{ $income->comments ?? 'N/A' }}</td></tr>
        <tr><th>Created At</th><td>{{ $income->created_at->format('d M Y h:i A') }}</td></tr>
    </table>

    <div class="footer">
        <p>This is a computer-generated voucher – no signature required.</p>
        <p>Thank you!</p>
    </div>

    <button class="btn btn-primary btn-print no-print" onclick="window.print();">Print Voucher</button>
</div>

<script>
    // Auto-print if ?print=1 parameter is present
    if (window.location.search.includes('print=1')) {
        window.print();
    }
</script>
</body>
</html>