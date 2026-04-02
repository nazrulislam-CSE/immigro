<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Voucher #{{ $order->id }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: #f8f9fa;
            padding: 20px;
        }
        .voucher-container {
            max-width: 800px;
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
        .order-details {
            margin-bottom: 20px;
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
        <h2>ORDER VOUCHER</h2>
        <p><strong>Order ID:</strong> #{{ $order->id }}</p>
        <p><strong>Date:</strong> {{ $order->created_at->format('d M Y h:i A') }}</p>
    </div>

    <div class="order-details">
        <table class="table table-bordered">
            <tr><th>Product Name</th><td>{{ $order->product->product_name ?? 'N/A' }}</td></tr>
            <tr><th>Product Details</th><td>
                @if($order->product->size) Size: {{ $order->product->size }}, @endif
                @if($order->product->color) Color: {{ $order->product->color }} @endif
            </td></tr>
            <tr><th>Customer Name</th><td>{{ $order->customer_name }}</td></tr>
            <tr><th>Mobile Number</th><td>{{ $order->mobile_number }}</td></tr>
            <tr><th>Unit Price</th><td>${{ number_format($order->customer_price, 2) }}</td></tr>
            <tr><th>Quantity</th><td>{{ $order->quantity }}</td></tr>
            <tr><th>Subtotal</th><td>{{ number_format($order->customer_price * $order->quantity, 2) }}</td></tr>
            <tr><th>Shipping Cost</th><td>{{ number_format($order->shipping_cost, 2) }}</td></tr>
            <tr><th>Advance Payment</th><td>{{ number_format($order->advance_payment, 2) }}</td></tr>
            <tr><th>Total Payable</th><td><strong>{{ number_format($order->total_price, 2) }}</strong></td></tr>
            <tr><th>Payment Method</th><td>{{ $order->payment_method ?? 'N/A' }}</td></tr>
            <tr><th>Thana</th><td>{{ $order->thana ?? 'N/A' }}</td></tr>
            <tr><th>District</th><td>{{ $order->district ?? 'N/A' }}</td></tr>
            <tr><th>Shipping Address</th><td>{{ $order->shipping_address }}</td></tr>
            <tr><th>Status</th><td>{!! $order->status_badge !!}</td></tr>
        </table>
    </div>

    <div class="footer">
        <p>Thank you for your order!</p>
        <p>This is a computer-generated voucher - no signature required.</p>
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