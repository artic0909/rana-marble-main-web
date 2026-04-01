<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice - #{{ $order->order_number }}</title>
    <style>
        body {
            font-family: 'Helvetica', 'Arial', sans-serif;
            font-size: 14px;
            color: #333;
            margin: 0;
            padding: 0;
        }

        .invoice-box {
            max-width: 800px;
            margin: auto;
            padding: 30px;
            border: 1px solid #eee;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.15);
            line-height: 24px;
        }

        .header {
            width: 100%;
            margin-bottom: 40px;
        }

        .header table {
            width: 100%;
        }

        .logo {
            font-size: 28px;
            font-weight: bold;
            color: #2a1206;
            text-transform: uppercase;
        }

        .company-details {
            text-align: right;
            font-size: 12px;
            color: #666;
        }

        .customer-details {
            margin-bottom: 40px;
        }

        .customer-details table {
            width: 100%;
        }

        .section-title {
            font-size: 12px;
            font-weight: bold;
            color: #6b3a18;
            text-transform: uppercase;
            margin-bottom: 10px;
            border-bottom: 2px solid #6b3a18;
            padding-bottom: 5px;
        }

        .item-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 30px;
        }

        .item-table th {
            background: #f8f8f8;
            border-bottom: 1px solid #ddd;
            padding: 10px;
            text-align: left;
            font-size: 12px;
        }

        .item-table td {
            padding: 10px;
            border-bottom: 1px solid #eee;
            vertical-align: top;
        }

        .text-right {
            text-align: right;
        }

        .totals {
            width: 100%;
            margin-top: 20px;
        }

        .totals table {
            width: 250px;
            margin-left: auto;
        }

        .totals td {
            padding: 5px 0;
        }

        .total-row {
            font-size: 18px;
            font-weight: bold;
            color: #2a1206;
            border-top: 2px solid #2a1206;
        }

        .footer {
            margin-top: 50px;
            text-align: center;
            font-size: 11px;
            color: #888;
            border-top: 1px solid #efefef;
            padding-top: 20px;
        }

        .support-details {
            color: #6b3a18;
            font-weight: bold;
            font-size: 13px;
        }
    </style>
</head>

<body>
    <div class="invoice-box">
        <div class="header">
            <table>
                <tr>
                    <td class="logo">
                        Rana Marble
                        <div style="font-size: 10px; color: #6b3a18; font-weight: normal; letter-spacing: 2px;">Marble Singhasan</div>
                    </td>
                    <td class="company-details">
                        <strong>Rana Marble</strong><br>
                        Bagnan, Howrah, West Bengal<br>
                        Phone: +917364957139<br>
                        Email: ruidas82ramesh@gmail.com
                    </td>
                </tr>
            </table>
        </div>

        <div class="customer-details">
            <table>
                <tr>
                    <td width="50%">
                        <div class="section-title">Bill To</div>
                        <strong>{{ $order->customer->name }}</strong><br>
                        {{ $order->shipping_address }}<br>
                        @if($order->shipping_landmark) {{ $order->shipping_landmark }}, @endif
                        {{ $order->shipping_city }}, {{ $order->shipping_state }} - {{ $order->pincode }}<br>
                        Phone: {{ $order->phone }}
                    </td>
                    <td width="50%" style="text-align: right; vertical-align: top;">
                        <div class="section-title">Invoice Details</div>
                        <strong>Invoice #:</strong> {{ $order->order_number }}<br>
                        <strong>Date:</strong> {{ $order->created_at->format('d M, Y') }}<br>
                        <strong>Status:</strong> {{ strtoupper($order->status) }}
                    </td>
                </tr>
            </table>
        </div>

        <table class="item-table">
            <thead>
                <tr>
                    <th>Item Description</th>
                    <th class="text-right">Price</th>
                    <th class="text-right">Qty</th>
                    <th class="text-right">Subtotal</th>
                </tr>
            </thead>
            <tbody>
                @foreach($order->items as $item)
                <tr>
                    <td>
                        <strong>{{ $item->product_name }}</strong><br>
                        <span style="font-size: 11px; color: #666;">
                            @if($item->size) Size: {{ $item->size }} @endif
                            @if($item->color) | Color: {{ $item->color }} @endif
                        </span>
                    </td>
                    <td class="text-right">₹{{ number_format($item->price, 2) }}</td>
                    <td class="text-right">{{ $item->quantity }}</td>
                    <td class="text-right">₹{{ number_format($item->subtotal, 2) }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <div class="totals">
            <table>
                <tr>
                    <td>Subtotal:</td>
                    <td class="text-right">₹{{ number_format($order->subtotal, 2) }}</td>
                </tr>
                <tr>
                    <td>Shipping Fees:</td>
                    <td class="text-right">₹{{ number_format($order->shipping_fees, 2) }}</td>
                </tr>
                <tr class="total-row">
                    <td>Total:</td>
                    <td class="text-right">₹{{ number_format($order->total, 2) }}</td>
                </tr>
            </table>
        </div>

        <div class="footer">
            <p>Thank you for choosing Rana Marble. We appreciate your business!</p>
            <p class="support-details">Need help? Contact our support team at +917364957139</p>
            <p>This is a computer-generated invoice. No signature required.</p>
        </div>
    </div>
</body>

</html>
